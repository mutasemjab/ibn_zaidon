<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\SiteSettingsSchema;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware($this->perm('setting-edit'))->only(['edit', 'update', 'togglePriceDisplay']);
    }

    public function edit()
    {
        $settings = SiteSetting::all()->keyBy('key');
        $tabs     = SiteSettingsSchema::tabs();

        return view('admin.site-settings.edit', compact('settings', 'tabs'));
    }

    public function update(Request $request)
    {
        $request->validate(SiteSettingsSchema::rules());

        foreach (SiteSettingsSchema::fields() as $key => $field) {
            $group = $field['group'];

            if ($field['bilingual']) {
                // Skip fields that were not part of the submitted form so nothing gets wiped by accident.
                if (! $request->exists("{$key}_ar") && ! $request->exists("{$key}_en")) {
                    continue;
                }
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value_ar' => $request->input("{$key}_ar"),
                        'value_en' => $request->input("{$key}_en"),
                        'group'    => $group,
                    ]
                );
                continue;
            }

            if ($field['type'] === 'image') {
                // No new upload → keep the existing file.
                if (! $request->hasFile($key)) {
                    continue;
                }
                $value = uploadImage('assets/uploads/site', $request->file($key));
            } else {
                if (! $request->exists($key)) {
                    continue;
                }
                $value = (string) $request->input($key, '');
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value_ar' => $value, 'value_en' => $value, 'group' => $group]
            );
        }

        SiteSetting::clearCache();

        return redirect()->route('admin.site-settings.edit')
            ->with('success', __('messages.updated_successfully'));
    }

    public function togglePriceDisplay()
    {
        $current = SiteSetting::raw('show_price') ?: '1';
        $new     = $current === '1' ? '2' : '1';

        SiteSetting::set('show_price', $new, $new, 'app');
        SiteSetting::clearCache();

        $label = $new === '1' ? 'مفعّل (يظهر السعر)' : 'معطّل (مخفي في App Store)';

        return back()->with('success', "تم تغيير إعداد السعر: {$label}");
    }

    public function toggleWebsiteMode()
    {
        $raw     = SiteSetting::raw('website_mode');
        $current = ($raw === '0') ? '0' : '1';
        $new     = $current === '1' ? '0' : '1';

        SiteSetting::set('website_mode', $new, $new, 'general');
        SiteSetting::clearCache();

        $label = $new === '1' ? 'الموقع مفتوح للزوار' : 'الموقع في وضع Landing Page';

        return back()->with('success', "تم تغيير وضع الموقع: {$label}");
    }
}

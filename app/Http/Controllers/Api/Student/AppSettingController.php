<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class AppSettingController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $showPrice = (int) (SiteSetting::raw('show_price') ?: '1');

        // Digits only, international format (e.g. 962790000000) — the app
        // builds its own wa.me link from this, same normalization the site's
        // own footer already applies to this setting.
        $whatsapp = preg_replace('/\D/', '', SiteSetting::raw('contact_whatsapp') ?: '');

        return $this->success([
            'show_price'      => $showPrice,
            'whatsapp_number' => $whatsapp !== '' ? $whatsapp : null,
        ]);
    }
}

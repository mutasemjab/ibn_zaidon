<?php

namespace App\Support;

/**
 * Single source of truth for every editable public-site setting.
 *
 * The admin form, request validation and persistence are all generated from this list,
 * so a key can never be shown in the panel without being saved (or vice-versa), and every
 * key the public site reads via SiteSetting::val()/raw() has a field here.
 *
 * Field types: text | textarea | url | email | number | image | icon
 * `bilingual` fields store Arabic in value_ar and English in value_en; the rest store one value in both.
 */
class SiteSettingsSchema
{
    public static function tabs(): array
    {
        return [
            'general' => [
                'icon'  => 'bi-gear',
                'title' => ['ar' => 'عام', 'en' => 'General'],
                'sections' => [
                    [
                        'title'  => ['ar' => 'هوية الموقع', 'en' => 'Site identity'],
                        'fields' => [
                            self::one('site_logo', 'general', 'image', 'شعار الموقع (Logo)', 'Site logo', [
                                'hint' => ['ar' => 'يُعرض في شريط التنقل. PNG أو SVG بخلفية شفافة مُفضَّل.', 'en' => 'Displayed in the navbar. PNG or SVG with transparent background preferred.'],
                            ]),
                            self::bi('site_name', 'general', 'text', 'اسم الموقع', 'Site name'),
                            self::bi('site_tagline', 'general', 'text', 'الشعار النصي', 'Tagline'),
                            self::bi('meta_description', 'general', 'textarea', 'وصف الموقع (SEO)', 'Site description (SEO)', ['rows' => 3]),
                            self::bi('meta_keywords', 'general', 'textarea', 'الكلمات المفتاحية (SEO)', 'Keywords (SEO)', ['rows' => 3]),
                            self::bi('footer_description', 'footer', 'textarea', 'وصف التذييل', 'Footer description', ['rows' => 3]),
                        ],
                    ],
                ],
            ],

            'hero' => [
                'icon'  => 'bi-image',
                'title' => ['ar' => 'البانر الرئيسي', 'en' => 'Hero'],
                'sections' => [
                    [
                        'title'  => ['ar' => 'البانر الرئيسي', 'en' => 'Hero banner'],
                        'fields' => [
                            self::bi('hero_badge', 'hero', 'text', 'نص الشارة', 'Badge text'),
                            self::bi('hero_title_line1', 'hero', 'text', 'العنوان — السطر الأول', 'Title — line 1'),
                            self::bi('hero_title_line2', 'hero', 'text', 'العنوان — السطر الثاني', 'Title — line 2'),
                            self::bi('hero_title_accent', 'hero', 'text', 'الكلمة المميّزة', 'Highlighted word', [
                                'hint' => ['ar' => 'يجب أن تكون جزءاً من نص السطر الثاني.', 'en' => 'Must be a part of the line-2 text.'],
                            ]),
                            self::bi('hero_subtitle', 'hero', 'textarea', 'النص الفرعي', 'Subtitle', ['rows' => 4]),
                            self::bi('hero_cta_primary', 'hero', 'text', 'زر رئيسي', 'Primary button'),
                            self::bi('hero_cta_secondary', 'hero', 'text', 'زر ثانوي', 'Secondary button'),
                            self::one('hero_image', 'hero', 'image', 'صورة البانر', 'Hero image'),
                        ],
                    ],
                    [
                        'title'  => ['ar' => 'الإحصائيات (تُستخدم عند عدم وجود بيانات فعلية)', 'en' => 'Statistics (used when there is no real data yet)'],
                        'fields' => [
                            self::one('stats_students', 'stats', 'number', 'عدد الطلاب', 'Students', ['col' => 3]),
                            self::one('stats_courses', 'stats', 'number', 'عدد الدورات', 'Courses', ['col' => 3]),
                            self::one('stats_teachers', 'stats', 'number', 'عدد المعلمين', 'Teachers', ['col' => 3]),
                            self::one('stats_satisfaction', 'stats', 'number', 'نسبة الرضا %', 'Satisfaction %', ['col' => 3]),
                        ],
                    ],
                ],
            ],

            'about' => [
                'icon'  => 'bi-info-circle',
                'title' => ['ar' => 'من نحن', 'en' => 'About'],
                'sections' => array_merge([
                    [
                        'title'  => ['ar' => 'المحتوى الرئيسي', 'en' => 'Main content'],
                        'fields' => [
                            self::bi('about_title', 'about', 'text', 'عنوان من نحن', 'About title'),
                            self::bi('about_description', 'about', 'textarea', 'وصف من نحن', 'About description', ['rows' => 5]),
                            self::one('about_years', 'about', 'number', 'سنوات الخبرة', 'Years of experience', ['col' => 2]),
                            self::one('about_image_main', 'about', 'image', 'الصورة الرئيسية', 'Main image', ['col' => 5]),
                            self::one('about_image_secondary', 'about', 'image', 'الصورة الثانوية', 'Secondary image', ['col' => 5]),
                        ],
                    ],
                ], array_map(fn ($i) => [
                    'title'  => ['ar' => "الميزة {$i}", 'en' => "Feature {$i}"],
                    'fields' => [
                        self::one("about_feat{$i}_icon", 'about', 'icon', 'الأيقونة (Bootstrap Icons)', 'Icon (Bootstrap Icons)', ['col' => 4, 'placeholder' => 'bi-lightbulb-fill']),
                        self::bi("about_feat{$i}_title", 'about', 'text', 'العنوان', 'Title'),
                        self::bi("about_feat{$i}_desc", 'about', 'textarea', 'الوصف', 'Description', ['rows' => 2]),
                    ],
                ], [1, 2, 3]), [
                    [
                        'title'  => ['ar' => 'لماذا نحن (نقاط)', 'en' => 'Why choose us (bullets)'],
                        'fields' => array_map(
                            fn ($i) => self::bi("why_us_{$i}", 'about', 'text', "النقطة {$i}", "Point {$i}"),
                            [1, 2, 3, 4, 5]
                        ),
                    ],
                ]),
            ],

            'contact' => [
                'icon'  => 'bi-telephone',
                'title' => ['ar' => 'تواصل معنا', 'en' => 'Contact'],
                'sections' => [
                    [
                        'title'  => ['ar' => 'معلومات التواصل', 'en' => 'Contact information'],
                        'fields' => [
                            self::bi('contact_address', 'contact', 'text', 'العنوان', 'Address'),
                            self::bi('contact_hours', 'contact', 'text', 'ساعات العمل', 'Working hours'),
                            self::one('contact_phone', 'contact', 'text', 'رقم الهاتف', 'Phone', ['col' => 4]),
                            self::bi('contact_phone_hours', 'contact', 'text', 'أوقات الرد على الهاتف', 'Phone availability'),
                            self::one('contact_whatsapp', 'contact', 'text', 'واتساب', 'WhatsApp', ['col' => 4, 'placeholder' => '+962791234567']),
                            self::one('contact_email', 'contact', 'email', 'البريد الإلكتروني', 'Email', ['col' => 4]),
                            self::one('contact_email2', 'contact', 'email', 'بريد الدعم', 'Support email', ['col' => 4]),
                        ],
                    ],
                ],
            ],

            'social' => [
                'icon'  => 'bi-share',
                'title' => ['ar' => 'التواصل والتطبيقات', 'en' => 'Social & apps'],
                'sections' => [
                    [
                        'title'  => ['ar' => 'روابط التواصل الاجتماعي', 'en' => 'Social links'],
                        'fields' => [
                            self::one('social_facebook', 'social', 'url', 'Facebook', 'Facebook', ['icon' => 'bi-facebook']),
                            self::one('social_instagram', 'social', 'url', 'Instagram', 'Instagram', ['icon' => 'bi-instagram']),
                            self::one('social_youtube', 'social', 'url', 'YouTube', 'YouTube', ['icon' => 'bi-youtube']),
                            self::one('social_twitter', 'social', 'url', 'Twitter / X', 'Twitter / X', ['icon' => 'bi-twitter-x']),
                            self::one('social_tiktok', 'social', 'url', 'TikTok', 'TikTok', ['icon' => 'bi-tiktok']),
                            self::one('social_snapchat', 'social', 'url', 'Snapchat', 'Snapchat', ['icon' => 'bi-snapchat']),
                            self::one('social_whatsapp', 'social', 'url', 'WhatsApp', 'WhatsApp', ['icon' => 'bi-whatsapp']),
                        ],
                    ],
                    [
                        'title'  => ['ar' => 'روابط التطبيقات', 'en' => 'App links'],
                        'fields' => [
                            self::one('app_google_play', 'apps', 'url', 'Google Play', 'Google Play', ['icon' => 'bi-google-play']),
                            self::one('app_store', 'apps', 'url', 'App Store', 'App Store', ['icon' => 'bi-apple']),
                        ],
                    ],
                ],
            ],

            'payment' => [
                'icon'  => 'bi-credit-card',
                'title' => ['ar' => 'الدفع', 'en' => 'Payment'],
                'sections' => [
                    [
                        'title'  => ['ar' => 'CliQ', 'en' => 'CliQ'],
                        'fields' => [
                            self::one('cliq_alias', 'payment', 'text', 'معرّف CliQ (Alias)', 'CliQ alias', [
                                'col'  => 4,
                                'hint' => ['ar' => 'يظهر للطالب في صفحة إتمام الدفع. اتركه فارغاً لإخفائه.', 'en' => 'Shown to students on the checkout page. Leave empty to hide it.'],
                            ]),
                        ],
                    ],
                ],
            ],
        ];
    }

    /** Flat list of every field, keyed by setting key. */
    public static function fields(): array
    {
        $out = [];
        foreach (self::tabs() as $tab) {
            foreach ($tab['sections'] as $section) {
                foreach ($section['fields'] as $field) {
                    $out[$field['key']] = $field;
                }
            }
        }
        return $out;
    }

    /** Validation rules for the update request, generated from the schema. */
    public static function rules(): array
    {
        $rules = [];
        foreach (self::fields() as $f) {
            $rule = match ($f['type']) {
                'url'      => 'nullable|url|max:500',
                'email'    => 'nullable|email|max:190',
                'number'   => 'nullable|integer|min:0|max:100000000',
                'image'    => 'nullable|image|max:4096',
                'textarea' => 'nullable|string|max:5000',
                default    => 'nullable|string|max:500',
            };
            if ($f['bilingual']) {
                $rules[$f['key'] . '_ar'] = $rule;
                $rules[$f['key'] . '_en'] = $rule;
            } else {
                $rules[$f['key']] = $rule;
            }
        }
        return $rules;
    }

    private static function bi(string $key, string $group, string $type, string $ar, string $en, array $opts = []): array
    {
        return self::field($key, $group, $type, $ar, $en, true, $opts);
    }

    private static function one(string $key, string $group, string $type, string $ar, string $en, array $opts = []): array
    {
        return self::field($key, $group, $type, $ar, $en, false, $opts);
    }

    private static function field(string $key, string $group, string $type, string $ar, string $en, bool $bilingual, array $opts): array
    {
        return array_merge([
            'key'       => $key,
            'group'     => $group,
            'type'      => $type,
            'bilingual' => $bilingual,
            'label'     => ['ar' => $ar, 'en' => $en],
        ], $opts);
    }
}

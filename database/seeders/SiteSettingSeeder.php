<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Site Identity ─────────────────────────────────────────────────
            ['site_name',          'general', 'أكاديمية ابن زيدون التعليمية', 'Ibn Zaidon Educational Academy'],
            ['site_tagline',       'general', 'منصة التميّز التعليمي في الأردن', 'Jordan\'s Premier Educational Platform'],
            ['meta_description',   'general',
                'أكاديمية ابن زيدون التعليمية — منصة تعليم إلكتروني رائدة في الأردن. دورات تفاعلية للمرحلة الأساسية والتوجيهي، امتحانات ذكية، وأوراق عمل احترافية بإشراف نخبة من المعلمين.',
                'Ibn Zaidon Educational Academy — a leading e-learning platform in Jordan. Interactive courses for basic grades and Tawjihi, smart exams, and professional worksheets from top teachers.'],
            ['meta_keywords',      'general',
                'أكاديمية ابن زيدون, دورات تعليمية أردن, منصة تعليمية أردنية, توجيهي, دروس أونلاين, امتحانات التوجيهي',
                'Ibn Zaidon Academy, online courses Jordan, Jordanian e-learning platform, Tawjihi, online lessons, Tawjihi exams'],

            // ── Hero ──────────────────────────────────────────────────────────
            ['hero_badge',         'hero', '🌟 منصة تعليمية رقم 1 في الأردن', '🌟 Jordan\'s #1 Educational Platform'],
            ['hero_title_line1',   'hero', 'تعلّم بلا حدود', 'Learn Without Limits'],
            ['hero_title_line2',   'hero', 'وحقّق نجاحك اليوم', 'Achieve Your Success Today'],
            ['hero_title_accent',  'hero', 'نجاحك', 'Success'],
            ['hero_subtitle',      'hero',
                'دورات تفاعلية وامتحانات ذكية وأوراق عمل احترافية من نخبة المعلمين في الأردن للمرحلة الأساسية والتوجيهي.',
                'Interactive courses, smart exams, and professional worksheets from Jordan\'s top teachers for all grades and Tawjihi.'],
            ['hero_cta_primary',   'hero', 'ابدأ التعلم الآن', 'Start Learning Now'],
            ['hero_cta_secondary', 'hero', 'جرّب الامتحانات', 'Try Exams'],
            ['hero_image',         'hero', '', ''],

            // ── Stats (fallback values when DB is empty) ──────────────────────
            ['stats_students',     'stats', '2400', '2400'],
            ['stats_courses',      'stats', '120', '120'],
            ['stats_teachers',     'stats', '35', '35'],
            ['stats_satisfaction', 'stats', '98', '98'],

            // ── About ─────────────────────────────────────────────────────────
            ['about_title',        'about', 'نبني جيلاً واعياً ومتفوقاً', 'Building an Aware & Outstanding Generation'],
            ['about_description',  'about',
                'أكاديمية ابن زيدون التعليمية منصة أردنية متخصصة في تقديم المحتوى التعليمي الرقمي للطلبة في مختلف المراحل الدراسية. نعمل مع نخبة من المعلمين المتميزين لتقديم محتوى عالي الجودة يُمكّن الطالب من التفوق والنجاح.',
                'Ibn Zaidon Educational Academy is a Jordanian platform specializing in digital educational content for students at all academic stages. We work with elite teachers to deliver high-quality content that empowers students to excel.'],
            ['about_feat1_icon',   'about', 'bi-lightbulb-fill', 'bi-lightbulb-fill'],
            ['about_feat1_title',  'about', 'محتوى تعليمي احترافي', 'Professional Educational Content'],
            ['about_feat1_desc',   'about',
                'دورات مصمّمة بعناية من قِبل معلمين خبراء وفق المنهج الأردني الحديث.',
                'Courses carefully designed by expert teachers following the modern Jordanian curriculum.'],
            ['about_feat2_icon',   'about', 'bi-shield-check-fill', 'bi-shield-check-fill'],
            ['about_feat2_title',  'about', 'امتحانات تفاعلية ذكية', 'Smart Interactive Exams'],
            ['about_feat2_desc',   'about',
                'بنك أسئلة ضخم وامتحانات لأعوام سابقة مع تحليل فوري للنتائج.',
                'A large question bank and previous year exams with instant result analysis.'],
            ['about_feat3_icon',   'about', 'bi-phone-fill', 'bi-phone-fill'],
            ['about_feat3_title',  'about', 'تعلّم في أي وقت ومن أي مكان', 'Learn Anytime, Anywhere'],
            ['about_feat3_desc',   'about',
                'منصة متوافقة مع جميع الأجهزة — هاتف، تابلت، أو حاسوب.',
                'Platform compatible with all devices — phone, tablet, or computer.'],
            ['why_us_1',           'about', 'محتوى مُحدَّث باستمرار', 'Continuously updated content'],
            ['why_us_2',           'about', 'إشراف مباشر من المعلمين', 'Direct teacher supervision'],
            ['why_us_3',           'about', 'نتائج فورية وتحليل تفصيلي', 'Instant results & detailed analysis'],
            ['why_us_4',           'about', 'دعم فني على مدار الساعة', '24/7 technical support'],
            ['why_us_5',           'about', 'أسعار في متناول الجميع', 'Affordable prices for everyone'],

            // ── Contact ───────────────────────────────────────────────────────
            ['contact_address',    'contact', 'الأردن — عمّان، المملكة الأردنية الهاشمية', 'Jordan — Amman, The Hashemite Kingdom of Jordan'],
            ['contact_phone',      'contact', '+962 XX XXXX XXX', '+962 XX XXXX XXX'],
            ['contact_phone_hours','contact', 'أيام العمل 8ص–6م', 'Weekdays 8am–6pm'],
            ['contact_email',      'contact', 'info@ibnzaidon.jo', 'info@ibnzaidon.jo'],
            ['contact_email2',     'contact', 'support@ibnzaidon.jo', 'support@ibnzaidon.jo'],
            ['contact_whatsapp',   'contact', '+962 7X XXX XXXX', '+962 7X XXX XXXX'],
            ['contact_hours',      'contact', 'السبت – الخميس: 8ص – 6م', 'Sat – Thu: 8am – 6pm'],

            // ── Footer ────────────────────────────────────────────────────────
            ['footer_description', 'footer',
                'منصة تعليمية متكاملة تقدم دورات، امتحانات، وأوراق عمل للمرحلة الأساسية والتوجيهي في المملكة الأردنية الهاشمية.',
                'An integrated educational platform offering courses, exams, and worksheets for all grades in Jordan.'],

            // ── Social Media ─────────────────────────────────────────────────
            ['social_facebook',   'social', '', ''],
            ['social_instagram',  'social', '', ''],
            ['social_youtube',    'social', '', ''],
            ['social_twitter',    'social', '', ''],
            ['social_tiktok',     'social', '', ''],
            ['social_whatsapp',   'social', '', ''],
            ['social_snapchat',   'social', '', ''],

            // ── Payment ──────────────────────────────────────────────────────
            ['cliq_alias',        'payment', 'ZAIDON', 'ZAIDON'],

            // ── Mobile Apps ──────────────────────────────────────────────────
            ['app_google_play',   'apps', '', ''],
            ['app_store',         'apps', '', ''],
        ];

        foreach ($settings as [$key, $group, $ar, $en]) {
            // firstOrCreate: re-running the seeder must not overwrite values edited in the admin panel.
            SiteSetting::firstOrCreate(
                ['key' => $key],
                ['value_ar' => $ar, 'value_en' => $en, 'group' => $group]
            );
        }
    }
}

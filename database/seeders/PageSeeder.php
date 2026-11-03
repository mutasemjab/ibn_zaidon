<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'terms',
                'title_ar' => 'الشروط والأحكام',
                'title_en' => 'Terms & Conditions',
                'body_ar' => "مرحباً بك في أكاديمية ابن زيدون التعليمية. باستخدامك للتطبيق والموقع فإنك توافق على الشروط التالية:\n\n"
                    ."1. المحتوى التعليمي (الدورات، الامتحانات، الملفات) مخصص للاستخدام الشخصي فقط، ولا يجوز نسخه أو إعادة توزيعه.\n"
                    ."2. يلتزم المستخدم بتقديم معلومات صحيحة عند التسجيل، وهو مسؤول عن الحفاظ على سرية بيانات حسابه.\n"
                    ."3. الدورات المفعّلة (عبر بطاقة أو شراء) هي وصول شخصي غير قابل للتحويل بين المستخدمين.\n"
                    ."4. تحتفظ الأكاديمية بحق تعديل الأسعار والمحتوى دون إشعار مسبق.\n"
                    ."5. أي إساءة استخدام للمنصة قد يؤدي لإيقاف الحساب دون استرداد.\n\n"
                    ."هذا النص أولي ويجب مراجعته قانونياً قبل الاعتماد النهائي.",
                'body_en' => "Welcome to Ibn Zaidon Educational Academy. By using this app and website, you agree to the following:\n\n"
                    ."1. Educational content (courses, exams, files) is for personal use only and may not be copied or redistributed.\n"
                    ."2. Users must provide accurate registration information and are responsible for keeping their account credentials secure.\n"
                    ."3. Activated courses (via card or purchase) grant personal, non-transferable access.\n"
                    ."4. The Academy reserves the right to change prices and content without prior notice.\n"
                    ."5. Misuse of the platform may result in account suspension without refund.\n\n"
                    ."This is placeholder text and should be reviewed legally before final publication.",
            ],
            [
                'slug' => 'privacy',
                'title_ar' => 'سياسة الخصوصية',
                'title_en' => 'Privacy Policy',
                'body_ar' => "نحترم خصوصيتك ونلتزم بحماية بياناتك الشخصية.\n\n"
                    ."• البيانات التي نجمعها: الاسم، رقم الهاتف، البريد الإلكتروني (اختياري)، والرقم الوطني عند التسجيل.\n"
                    ."• كيف نستخدمها: لتفعيل حسابك، متابعة تقدّمك الدراسي، وإرسال إشعارات متعلقة بدوراتك وامتحاناتك.\n"
                    ."• لا نشارك بياناتك مع أي طرف ثالث لأغراض تسويقية.\n"
                    ."• يمكنك طلب حذف حسابك وبياناتك في أي وقت من داخل التطبيق.\n\n"
                    ."هذا النص أولي ويجب مراجعته قانونياً قبل الاعتماد النهائي.",
                'body_en' => "We respect your privacy and are committed to protecting your personal data.\n\n"
                    ."• Data we collect: name, phone number, email (optional), and national ID at registration.\n"
                    ."• How we use it: to activate your account, track your learning progress, and send notifications about your courses and exams.\n"
                    ."• We do not share your data with third parties for marketing purposes.\n"
                    ."• You can request deletion of your account and data at any time from within the app.\n\n"
                    ."This is placeholder text and should be reviewed legally before final publication.",
            ],
            [
                'slug' => 'about',
                'title_ar' => 'من نحن',
                'title_en' => 'About Us',
                'body_ar' => 'أكاديمية ابن زيدون التعليمية منصة أردنية متخصصة في تقديم المحتوى التعليمي الرقمي للطلبة '
                    .'في مختلف المراحل الدراسية، من خلال دورات تفاعلية وامتحانات ذكية وأوراق عمل احترافية '
                    .'بإشراف نخبة من المعلمين المتميزين.',
                'body_en' => 'Ibn Zaidon Educational Academy is a Jordanian platform specializing in digital educational '
                    .'content for students at all academic stages, through interactive courses, smart exams, and '
                    .'professional worksheets from a select group of outstanding teachers.',
            ],
            [
                'slug' => 'support',
                'title_ar' => 'الدعم الفني',
                'title_en' => 'Support',
                'body_ar' => "بحاجة لمساعدة؟ فريق الدعم جاهز لمساعدتك بأي استفسار يخص حسابك، دوراتك، أو عملية الدفع.\n\n"
                    ."يمكنك التواصل معنا عبر واتساب أو البريد الإلكتروني الموضّحين في صفحة \"تواصل معنا\"، "
                    ."وسيتم الرد خلال 24 ساعة عمل.",
                'body_en' => "Need help? Our support team is ready to assist with anything related to your account, "
                    ."courses, or payments.\n\n"
                    ."Reach us via WhatsApp or email as shown on the \"Contact Us\" page, and we'll respond within "
                    ."24 business hours.",
            ],
        ];

        foreach ($pages as $page) {
            // firstOrCreate: re-running the seeder must not overwrite content edited in the admin panel.
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}

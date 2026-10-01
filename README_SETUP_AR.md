# Daily Dough — تشغيل المشروع على Windows

## المطلوب مرة واحدة
- PHP 8.2 أو أحدث
- Composer
- Node.js 20+ (يأتي معه npm)

## أسهل طريقة
1. فك ضغط المشروع.
2. افتح فولدر `daily-dough`.
3. شغّل `setup.bat`.
4. بعد انتهاء الـsetup شغّل `START_DAILY_DOUGH.bat`.
5. المتصفح سيفتح على:
   `http://127.0.0.1:8000`

## لوحة التحكم
`http://127.0.0.1:8000/admin/login`

كلمة المرور التجريبية:
`change-me`

غيّرها في `.env` قبل أي استخدام حقيقي.

## قاعدة البيانات
النسخة الجاهزة تستخدم SQLite لتجنب إعداد MySQL في البداية.
الملف:
`database/database.sqlite`

لو أردت MySQL لاحقًا، غيّر `DB_CONNECTION` وبيانات الاتصال في `.env` ثم شغّل migrations.

## يدويًا لو لم يعمل setup.bat
```bash
composer install
copy .env.example .env
php artisan key:generate
npm install
php artisan migrate:fresh --seed
php artisan serve
```
وفي Terminal آخر:
```bash
npm run dev
```


## إشعارات الطلبات بالبريد
أضف RESEND_API_KEY في ملف .env. بعد إنشاء الطلب سيُرسل الموقع إشعارًا إلى ORDER_NOTIFICATION_EMAIL. لا تضع المفتاح داخل الكود أو ترفعه إلى Git.

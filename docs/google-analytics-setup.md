# دليل ربط Google Analytics مع الموقع

## نظرة عامة

هذا الدليل يشرح كيفية ربط Google Analytics مع الموقع لعرض التقارير في لوحة التحكم.

---

## المتطلبات الأساسية

- حساب Google Cloud Console
- حساب Google Analytics
- صلاحيات Admin على الموقع

---

## الخطوة 1: إنشاء Google Analytics Property

### 1.1 الدخول إلى Google Analytics

- افتح [analytics.google.com](https://analytics.google.com)
- سجل دخول بحساب Google

### 1.2 إنشاء Account (إذا لم يكن موجوداً)

1. اضغط **Start measuring**
2. **Account name**: `Ishraq` (أو أي اسم)
3. اضغط **Next**

### 1.3 إنشاء Property

1. **Property name**: `ishraq.tech`
2. **Reporting time zone**: `(GMT+02:00) Cairo`
3. **Currency**: `Egyptian Pound (EGP)` أو `US Dollar`
4. اضغط **Next**

### 1.4 معلومات الأعمال

1. **Industry category**: `Technology` أو `Computers and Electronics`
2. **Business size**: اختر حجم الشركة
3. اضغط **Next**

### 1.5 أهداف الاستخدام

1. اختر أي هدف (مثلاً: `Examine user behavior`)
2. اضغط **Create**
3. وافق على الشروط → **I Accept**

### 1.6 إعداد Data Stream

1. اختر **Web**
2. **Website URL**: `https://ishraq.tech`
3. **Stream name**: `ishraq.tech`
4. اضغط **Create stream**

### 1.7 نسخ المعرفات

بعد إنشاء الـ Stream، ستظهر لك:

- **Measurement ID**: `G-XXXXXXXXXX` ← للاستخدام في الموقع
- **Property ID**: رقم (مثل: `123456789`) ← للـ API

---

## الخطوة 2: إنشاء Google Cloud Project

### 2.1 الدخول إلى Google Cloud Console

- افتح [console.cloud.google.com](https://console.cloud.google.com)
- سجل دخول بنفس حساب Google

### 2.2 إنشاء Project

1. اضغط على القائمة المنسدلة للـ Projects في الأعلى
2. اضغط **New Project**
3. **Project name**: `ishraq-analytics` (أو أي اسم)
4. اضغط **Create**
5. انتظر حتى يتم إنشاء الـ Project (30 ثانية تقريباً)

---

## الخطوة 3: تفعيل Google Analytics Data API

### 3.1 فتح مكتبة الـ APIs

1. من القائمة الجانبية → **APIs & Services** → **Library**
2. ابحث عن: `Google Analytics Data API`
3. اضغط على النتيجة الأولى

### 3.2 تفعيل الـ API

1. اضغط **Enable**
2. انتظر 2-3 دقائق حتى يتم التفعيل بالكامل

---

## الخطوة 4: إنشاء Service Account

### 4.1 فتح صفحة Credentials

1. من القائمة الجانبية → **APIs & Services** → **Credentials**
2. اضغط **Create Credentials** → اختر **Service Account**

### 4.2 إعداد Service Account

1. **Service account name**: `ishraq-analytics-reader`
2. **Service account ID**: سيتم ملؤه تلقائياً
3. **Description** (اختياري): `Service account for reading Google Analytics data`
4. اضغط **Create and Continue**

### 4.3 منح الصلاحيات

1. في **Grant this service account access to project**:
    - **Role**: اختر **Viewer** (كافٍ للقراءة فقط)
2. اضغط **Continue**
3. اضغط **Done**

### 4.4 تنزيل ملف JSON

1. ستجد الـ Service Account في القائمة
2. اضغط على **الإيميل** الخاص به (ينتهي بـ `@...iam.gserviceaccount.com`)
3. اضغط تاب **Keys**
4. اضغط **Add Key** → **Create new key**
5. اختر **JSON**
6. اضغط **Create**
7. سيتم تنزيل الملف تلقائياً على جهازك

**مثال على اسم الملف:**

```
ishraq-487623-efc799ead244.json
```

**محتوى الملف يحتوي على:**

```json
{
  "type": "service_account",
  "project_id": "ishraq-487623",
  "private_key_id": "...",
  "private_key": "...",
  "client_email": "ishraq@ishraq-487623.iam.gserviceaccount.com",
  ...
}
```

---

## الخطوة 5: ربط Service Account بـ Google Analytics

### 5.1 فتح Google Analytics

- افتح [analytics.google.com](https://analytics.google.com)
- اختر الـ **Property** الخاص بموقعك (`ishraq.tech`)

### 5.2 إضافة المستخدم

1. من القائمة السفلية اليسار → اضغط **⚙️ Admin**
2. في عمود **Property** (الوسط) → اضغط **Property access management**
3. اضغط الزرار الأزرق **+** في أعلى اليمين
4. اختر **Add users**

### 5.3 إدخال بيانات Service Account

1. في **Email addresses** → الصق إيميل الـ Service Account:

    ```
    ishraq@ishraq-487623.iam.gserviceaccount.com
    ```

    (ستجده في ملف JSON في حقل `client_email`)

2. في **Roles** → اختر:
    - ✅ **Viewer** (للقراءة فقط)
    - أو **Analyst** (إذا كنت تريد صلاحيات أكثر)

3. اضغط **Add** في أعلى اليمين

### 5.4 التحقق

- تأكد من ظهور الإيميل في قائمة المستخدمين
- انتظر دقيقة واحدة حتى تنتشر الصلاحيات

---

## الخطوة 6: رفع الملف للسيرفر

### 6.1 إنشاء المجلد

```bash
mkdir -p /home/ishraq/htdocs/ishraq.tech/storage/app/analytics
```

### 6.2 رفع الملف

- ارفع ملف JSON من جهازك إلى السيرفر
- ضعه في المسار: `/home/ishraq/htdocs/ishraq.tech/storage/app/analytics/`

### 6.3 إعادة تسمية الملف

```bash
cd /home/ishraq/htdocs/ishraq.tech/storage/app/analytics
mv ishraq-487623-efc799ead244.json service-account-credentials.json
```

### 6.4 ضبط الصلاحيات

```bash
chmod 600 service-account-credentials.json
chown ishraq:ishraq service-account-credentials.json
```

---

## الخطوة 7: تحديث ملف `.env`

### 7.1 فتح ملف `.env`

```bash
nano /home/ishraq/htdocs/ishraq.tech/.env
```

### 7.2 إضافة/تحديث المتغيرات

```env
# Google Analytics Measurement ID (للتتبع في الموقع)
GA_MEASUREMENT_ID=G-XXXXXXXXXX

# Google Analytics Property ID (للـ API)
ANALYTICS_PROPERTY_ID=123456789

# Google Search Console Verification (اختياري)
GSC_VERIFICATION_CODE=your-verification-code

# Google Tag Manager (اختياري)
GTM_CONTAINER_ID=GTM-XXXXXXX
```

**ملاحظات مهمة:**

- `GA_MEASUREMENT_ID`: يبدأ بـ `G-` (من Google Analytics → Data Streams)
- `ANALYTICS_PROPERTY_ID`: **رقم فقط** (من Google Analytics → Admin → Property Settings → Property ID)

### 7.3 مسح الـ Cache

```bash
cd /home/ishraq/htdocs/ishraq.tech
php artisan config:clear
php artisan cache:clear
```

---

## الخطوة 8: التحقق من التشغيل

### 8.1 فتح لوحة التحكم

- افتح `https://ishraq.tech/admin`
- سجل دخول
- افتح صفحة Analytics

### 8.2 التحقق من البيانات

- يجب أن تظهر التقارير بدون أخطاء
- إذا ظهرت بيانات فارغة، انتظر 24-48 ساعة حتى تتجمع البيانات

---

## حل المشاكل الشائعة

### خطأ: "SERVICE_DISABLED"

**السبب:** Google Analytics Data API غير مفعل

**الحل:**

1. افتح [console.cloud.google.com](https://console.cloud.google.com)
2. تأكد من اختيار الـ Project الصحيح
3. APIs & Services → Library
4. ابحث عن `Google Analytics Data API`
5. اضغط **Enable**
6. انتظر 2-5 دقائق

### خطأ: "PERMISSION_DENIED"

**السبب:** Service Account ليس لديه صلاحيات على الـ Property

**الحل:**

1. افتح [analytics.google.com](https://analytics.google.com)
2. Admin → Property access management
3. تأكد من وجود إيميل الـ Service Account في القائمة
4. إذا لم يكن موجوداً، أضفه بصلاحية **Viewer**

### خطأ: "Could not find credentials file"

**السبب:** ملف JSON غير موجود في المسار الصحيح

**الحل:**

```bash
# تحقق من وجود الملف
ls -la /home/ishraq/htdocs/ishraq.tech/storage/app/analytics/

# يجب أن يظهر:
# -rw------- 1 ishraq ishraq 2345 Feb 17 01:20 service-account-credentials.json
```

### خطأ: Property ID غير صحيح

**السبب:** استخدام Measurement ID بدلاً من Property ID

**الحل:**

1. افتح Google Analytics
2. Admin → Property Settings
3. انسخ **Property ID** (رقم فقط، مثل: `123456789`)
4. ضعه في `.env` → `ANALYTICS_PROPERTY_ID=123456789`

---

## معلومات إضافية

### مسارات الملفات المهمة

```
/home/ishraq/htdocs/ishraq.tech/
├── .env                                          # متغيرات البيئة
├── config/analytics.php                          # إعدادات Analytics
└── storage/app/analytics/
    └── service-account-credentials.json          # ملف الاعتماد
```

### الأوامر المفيدة

```bash
# مسح الـ Cache
php artisan config:clear
php artisan cache:clear

# التحقق من الإعدادات
php artisan tinker
>>> config('analytics.service_account_credentials_json')
>>> config('analytics.property_id')
```

### روابط مفيدة

- [Google Analytics](https://analytics.google.com)
- [Google Cloud Console](https://console.cloud.google.com)
- [Google Analytics Data API Documentation](https://developers.google.com/analytics/devguides/reporting/data/v1)
- [Laravel Analytics Package](https://github.com/spatie/laravel-analytics)

---

## الخلاصة

بعد اتباع جميع الخطوات أعلاه، يجب أن يعمل Google Analytics بشكل صحيح في لوحة التحكم.

**تذكر:**

- انتظر 24-48 ساعة حتى تظهر البيانات الأولى
- تأكد من تفعيل الـ API وانتظر 2-5 دقائق بعد التفعيل
- تأكد من إضافة Service Account إلى الـ **Property** (وليس Account فقط)
- استخدم **Property ID** (رقم) وليس **Measurement ID** (G-...)

---

**تاريخ الإنشاء:** 2026-02-17  
**آخر تحديث:** 2026-02-17

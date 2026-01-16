<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'كيف تختار إطار العمل المناسب لمشروعك في 2025',
                'excerpt' => 'دليل شامل لاختيار إطار العمل البرمجي الأنسب لمشروعك سواء كان موقع ويب أو تطبيق جوال أو نظام معقد.',
                'content' => '<h2>أهمية اختيار إطار العمل الصحيح</h2>
<p>اختيار إطار العمل (Framework) المناسب هو قرار استراتيجي يؤثر على نجاح مشروعك البرمجي. الاختيار الخاطئ قد يكلفك الوقت والمال ويحد من إمكانيات التوسع.</p>

<h2>أشهر أطر العمل لتطوير الويب</h2>
<h3>1. React.js</h3>
<p>مكتبة JavaScript من Facebook، مثالية لبناء واجهات مستخدم تفاعلية. تتميز بـ Virtual DOM للأداء العالي ومجتمع ضخم.</p>
<ul>
<li><strong>الأفضل لـ:</strong> تطبيقات الصفحة الواحدة (SPA)، لوحات التحكم</li>
<li><strong>منحنى التعلم:</strong> متوسط</li>
</ul>

<h3>2. Next.js</h3>
<p>إطار عمل مبني على React يوفر SSR و SSG للأداء وSEO الممتازين.</p>
<ul>
<li><strong>الأفضل لـ:</strong> مواقع تحتاج SEO، متاجر إلكترونية، مدونات</li>
<li><strong>منحنى التعلم:</strong> متوسط إلى صعب</li>
</ul>

<h3>3. Laravel (PHP)</h3>
<p>إطار PHP الأشهر، يوفر كل ما تحتاجه لبناء تطبيقات ويب متكاملة.</p>
<ul>
<li><strong>الأفضل لـ:</strong> أنظمة إدارة، APIs، تطبيقات معقدة</li>
<li><strong>منحنى التعلم:</strong> سهل إلى متوسط</li>
</ul>

<h3>4. Vue.js</h3>
<p>إطار عمل تدريجي سهل التعلم ومرن جداً.</p>
<ul>
<li><strong>الأفضل لـ:</strong> المشاريع الصغيرة والمتوسطة، المبتدئين</li>
<li><strong>منحنى التعلم:</strong> سهل</li>
</ul>

<h2>كيف تختار؟</h2>
<ol>
<li>حدد متطلبات مشروعك (SEO، أداء، تعقيد)</li>
<li>قيّم خبرة فريقك</li>
<li>فكر في المستقبل والتوسع</li>
<li>راجع المجتمع والدعم</li>
</ol>

<h2>الخلاصة</h2>
<p>لا يوجد إطار عمل "أفضل" بشكل مطلق. الأفضل هو ما يناسب احتياجاتك وفريقك ورؤيتك المستقبلية.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'React vs Vue: مقارنة شاملة لعام 2025',
                'excerpt' => 'مقارنة تفصيلية بين React و Vue.js لمساعدتك في اختيار التقنية المناسبة لمشروعك القادم.',
                'content' => '<h2>مقدمة</h2>
<p>React و Vue هما من أشهر مكتبات/أطر JavaScript لبناء واجهات المستخدم. كلاهما ممتاز، لكن لكل منهما نقاط قوة وضعف.</p>

<h2>React</h2>
<h3>المميزات:</h3>
<ul>
<li><strong>مجتمع ضخم:</strong> آلاف المكتبات والأدوات الجاهزة</li>
<li><strong>فرص العمل:</strong> الأكثر طلباً في سوق العمل</li>
<li><strong>مرونة:</strong> حرية كاملة في اختيار الأدوات</li>
<li><strong>React Native:</strong> نفس المهارات للويب والموبايل</li>
</ul>
<h3>العيوب:</h3>
<ul>
<li>يحتاج قرارات كثيرة (state management, routing)</li>
<li>JSX قد يكون غريباً في البداية</li>
</ul>

<h2>Vue.js</h2>
<h3>المميزات:</h3>
<ul>
<li><strong>سهولة التعلم:</strong> الأسهل للمبتدئين</li>
<li><strong>توثيق ممتاز:</strong> من أفضل التوثيقات</li>
<li><strong>مدمج:</strong> State management و Router مدمجين</li>
<li><strong>أداء:</strong> ممتاز وخفيف</li>
</ul>
<h3>العيوب:</h3>
<ul>
<li>مجتمع أصغر من React</li>
<li>فرص عمل أقل نسبياً</li>
</ul>

<h2>متى تختار React؟</h2>
<ul>
<li>مشاريع كبيرة ومعقدة</li>
<li>فريق لديه خبرة</li>
<li>تحتاج React Native لاحقاً</li>
</ul>

<h2>متى تختار Vue؟</h2>
<ul>
<li>مشاريع صغيرة ومتوسطة</li>
<li>فريق مبتدئ</li>
<li>تريد بداية سريعة</li>
</ul>

<h2>الخلاصة</h2>
<p>كلا الخيارين ممتاز. React للمشاريع الكبيرة والفرق المتمرسة، Vue للبساطة والسرعة.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'أفضل ممارسات تطوير تطبيقات الجوال في 2025',
                'excerpt' => 'تعرف على أهم الممارسات والنصائح لتطوير تطبيقات جوال ناجحة وعالية الجودة.',
                'content' => '<h2>لماذا الممارسات الجيدة مهمة؟</h2>
<p>تطوير تطبيق جوال ناجح يتطلب أكثر من مجرد كتابة كود. الممارسات الجيدة تضمن جودة المنتج ورضا المستخدمين.</p>

<h2>1. التصميم أولاً (Design First)</h2>
<p>ابدأ بالتصميم قبل البرمجة:</p>
<ul>
<li>Wireframes لتخطيط الشاشات</li>
<li>Prototypes تفاعلية للاختبار</li>
<li>UI Kit متناسق لجميع العناصر</li>
</ul>

<h2>2. الأداء هو الملك</h2>
<ul>
<li>تحسين حجم الصور والأصول</li>
<li>استخدام Lazy Loading</li>
<li>تقليل الـ API calls</li>
<li>اختبار على أجهزة حقيقية منخفضة المواصفات</li>
</ul>

<h2>3. تجربة المستخدم (UX)</h2>
<ul>
<li>Onboarding سلس وواضح</li>
<li>تغذية راجعة فورية للإجراءات</li>
<li>رسائل خطأ مفيدة وواضحة</li>
<li>إمكانية الوصول (Accessibility)</li>
</ul>

<h2>4. الأمان</h2>
<ul>
<li>تشفير البيانات الحساسة</li>
<li>استخدام HTTPS دائماً</li>
<li>تخزين آمن للـ Tokens</li>
<li>التحقق من المدخلات</li>
</ul>

<h2>5. الاختبار</h2>
<ul>
<li>Unit Tests للمنطق</li>
<li>Integration Tests للـ APIs</li>
<li>UI Tests للواجهات الحرجة</li>
<li>Beta Testing مع مستخدمين حقيقيين</li>
</ul>

<h2>6. Native vs Cross-platform</h2>
<h3>Native (Swift/Kotlin):</h3>
<p>أفضل أداء وتجربة، لكن تكلفة أعلى.</p>

<h3>Cross-platform (Flutter/React Native):</h3>
<p>كود واحد لمنصتين، أسرع وأوفر.</p>

<h2>الخلاصة</h2>
<p>الممارسات الجيدة ليست ترفاً بل ضرورة. استثمر الوقت في التخطيط والاختبار، وستوفر الكثير لاحقاً.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'دليلك الشامل لبناء موقع صديق لمحركات البحث (SEO)',
                'excerpt' => 'تعلم كيف تبني موقعاً يحقق ترتيباً عالياً في Google من خلال التقنيات الصحيحة.',
                'content' => '<h2>ما هو Technical SEO؟</h2>
<p>SEO التقني يركز على الجوانب البرمجية التي تساعد محركات البحث على فهم وفهرسة موقعك بشكل أفضل.</p>

<h2>1. سرعة الموقع</h2>
<p>السرعة عامل ترتيب مهم:</p>
<ul>
<li>استخدم CDN لتوزيع المحتوى</li>
<li>ضغط الصور (WebP, AVIF)</li>
<li>تصغير CSS و JavaScript</li>
<li>استخدم Lazy Loading</li>
<li>استهدف Core Web Vitals</li>
</ul>

<h2>2. Server-Side Rendering (SSR)</h2>
<p>للمواقع الديناميكية:</p>
<ul>
<li>Next.js لـ React</li>
<li>Nuxt.js لـ Vue</li>
<li>Laravel Blade للـ PHP</li>
</ul>

<h2>3. البنية التقنية</h2>
<ul>
<li>URLs واضحة وقصيرة</li>
<li>Semantic HTML صحيح</li>
<li>Schema Markup للبيانات المنظمة</li>
<li>Sitemap.xml محدث</li>
<li>Robots.txt صحيح</li>
</ul>

<h2>4. التوافق مع الجوال</h2>
<ul>
<li>تصميم Mobile-First</li>
<li>Responsive Design</li>
<li>أزرار كبيرة كافية للمس</li>
<li>نص قابل للقراءة بدون تكبير</li>
</ul>

<h2>5. الأمان (HTTPS)</h2>
<p>HTTPS إلزامي الآن:</p>
<ul>
<li>شهادة SSL صالحة</li>
<li>إعادة توجيه HTTP إلى HTTPS</li>
<li>HSTS للحماية الإضافية</li>
</ul>

<h2>6. Meta Tags</h2>
<ul>
<li>Title فريد لكل صفحة (50-60 حرف)</li>
<li>Meta Description جذاب (150-160 حرف)</li>
<li>Open Graph للشبكات الاجتماعية</li>
<li>Canonical URLs للمحتوى المكرر</li>
</ul>

<h2>الخلاصة</h2>
<p>SEO التقني أساس أي استراتيجية SEO ناجحة. ابدأ بالأساسيات وطور تدريجياً.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'DevOps: مستقبل تطوير وتشغيل البرمجيات',
                'excerpt' => 'تعرف على مفهوم DevOps وكيف يغير طريقة تطوير وإطلاق البرمجيات بشكل جذري.',
                'content' => '<h2>ما هو DevOps؟</h2>
<p>DevOps هو منهجية تجمع بين التطوير (Development) والعمليات (Operations) لتسريع دورة حياة البرمجيات وتحسين جودتها.</p>

<h2>المبادئ الأساسية</h2>
<h3>1. الأتمتة (Automation)</h3>
<p>أتمتة كل ما يمكن أتمتته:</p>
<ul>
<li>الاختبارات التلقائية</li>
<li>النشر التلقائي (CI/CD)</li>
<li>البنية التحتية ككود (IaC)</li>
</ul>

<h3>2. التكامل المستمر (CI)</h3>
<ul>
<li>دمج الكود بشكل متكرر</li>
<li>اختبارات تلقائية لكل تغيير</li>
<li>اكتشاف المشاكل مبكراً</li>
</ul>

<h3>3. النشر المستمر (CD)</h3>
<ul>
<li>نشر التغييرات تلقائياً</li>
<li>بيئات متعددة (dev, staging, prod)</li>
<li>Rollback سريع عند الحاجة</li>
</ul>

<h2>أدوات DevOps الشائعة</h2>
<h3>التحكم بالإصدارات:</h3>
<p>Git, GitHub, GitLab</p>

<h3>CI/CD:</h3>
<p>GitHub Actions, Jenkins, GitLab CI, CircleCI</p>

<h3>الحاويات:</h3>
<p>Docker, Kubernetes</p>

<h3>البنية التحتية:</h3>
<p>Terraform, Ansible, AWS CloudFormation</p>

<h3>المراقبة:</h3>
<p>Prometheus, Grafana, Datadog, New Relic</p>

<h2>فوائد DevOps</h2>
<ul>
<li>إطلاق ميزات أسرع</li>
<li>جودة أعلى وأخطاء أقل</li>
<li>استقرار أفضل</li>
<li>تعاون أقوى بين الفرق</li>
<li>توفير في التكاليف</li>
</ul>

<h2>كيف تبدأ؟</h2>
<ol>
<li>ابدأ بـ Git إن لم تستخدمه</li>
<li>أضف CI بسيط (GitHub Actions)</li>
<li>أتمت النشر تدريجياً</li>
<li>أضف مراقبة وتنبيهات</li>
</ol>

<h2>الخلاصة</h2>
<p>DevOps ليس مجرد أدوات، بل ثقافة وطريقة تفكير. ابدأ صغيراً وتطور تدريجياً.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'أهمية تجربة المستخدم (UX) في نجاح المنتجات الرقمية',
                'excerpt' => 'لماذا تجربة المستخدم الجيدة هي مفتاح نجاح أي تطبيق أو موقع، وكيف تحققها.',
                'content' => '<h2>ما هي تجربة المستخدم (UX)؟</h2>
<p>تجربة المستخدم هي الانطباع الكلي الذي يحصل عليه المستخدم عند التفاعل مع منتجك الرقمي. تشمل سهولة الاستخدام، الجمال، والشعور العام.</p>

<h2>لماذا UX مهمة؟</h2>
<ul>
<li><strong>زيادة التحويلات:</strong> UX جيدة = مبيعات أكثر</li>
<li><strong>تقليل التكاليف:</strong> مشاكل أقل = دعم أقل</li>
<li><strong>ولاء العملاء:</strong> تجربة ممتازة = عملاء دائمين</li>
<li><strong>التميز:</strong> تجربة فريدة تميزك عن المنافسين</li>
</ul>

<h2>مبادئ UX الأساسية</h2>

<h3>1. البساطة</h3>
<p>لا تُعقّد الأمور. المستخدم يريد إنجاز مهمته بأسرع وقت.</p>

<h3>2. الاتساق</h3>
<p>نفس العناصر تعمل بنفس الطريقة في كل مكان.</p>

<h3>3. التغذية الراجعة</h3>
<p>أخبر المستخدم بما يحدث دائماً:</p>
<ul>
<li>Loading indicators</li>
<li>Success/Error messages</li>
<li>Progress bars</li>
</ul>

<h3>4. منع الأخطاء</h3>
<p>الأفضل من معالجة الأخطاء هو منعها:</p>
<ul>
<li>تأكيد قبل الحذف</li>
<li>تقييد المدخلات غير الصالحة</li>
<li>اقتراحات ذكية</li>
</ul>

<h3>5. إمكانية الوصول (Accessibility)</h3>
<p>منتجك يجب أن يعمل للجميع:</p>
<ul>
<li>تباين ألوان كافٍ</li>
<li>نص بديل للصور</li>
<li>تصفح بلوحة المفاتيح</li>
</ul>

<h2>عملية تصميم UX</h2>
<ol>
<li><strong>البحث:</strong> فهم المستخدمين واحتياجاتهم</li>
<li><strong>التخطيط:</strong> رسم Wireframes</li>
<li><strong>التصميم:</strong> إنشاء Mockups</li>
<li><strong>النموذج:</strong> بناء Prototype تفاعلي</li>
<li><strong>الاختبار:</strong> اختبار مع مستخدمين حقيقيين</li>
<li><strong>التكرار:</strong> تحسين بناءً على الملاحظات</li>
</ol>

<h2>الخلاصة</h2>
<p>UX استثمار وليس تكلفة. كل ريال تنفقه على UX يعود عليك أضعافاً.</p>',
                'author' => 'فريق إشراق',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create([
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'excerpt' => $articleData['excerpt'],
                'content' => $articleData['content'],
                'author' => $articleData['author'],
                'is_featured' => $articleData['is_featured'],
                'is_published' => $articleData['is_published'],
                'published_at' => $articleData['published_at'],
                'views_count' => rand(50, 500),
            ]);
        }
    }
}

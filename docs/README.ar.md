# الأسئلة الشائعة / الأسئلة والأجوبة لـ REDAXO 5.x & YForm 4.x

باستخدام مناطق الأسئلة الشائعة هذه بالإضافة إلى الأسئلة العامة ، يمكن إدخال & إجابة وإدارتها. مجانًا للمشاريع غير التجارية (CC BY-NC-SA 4.0). إذا كان لديك أي أسئلة حول الترخيص والاستخدام ، فيرجى الاتصال بـ qanda@alexplus.de.

![شعار GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## الميزات

* تم التنفيذ بالكامل مع **YForm** : جميع الميزات وخيارات التخصيص الخاصة بـ YForm متاحة
* بسيط: الإخراج عبر [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) أو كائني التوجه عبر [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* مرن: تصفية الأسئلة والإجابات حسب الفئات
* مفيد: تم تحديد **فقط من الأدوار**/ يمكن للمحررين الوصول
* محرك بحث محسن: جاهز للتنسيق [JSON + LD](https://jsonld.com/question-and-answer/) والبيانات المنظمة بناءً على schema.org
* جاهز للمزيد: متوافق مع [URL2 الملحق](https://github.com/tbaddade/redaxo_url)

> **نصيحة:** يعمل الملحق بشكل رائع مع الإضافات [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **ساهم في تحسيناتك الخاصة** في مستودع [qanda](https://github.com/alexplusde/qanda) GitHub. أو **يدعم هذا الملحق:** مع أمر [، فإنك تدعم التطوير الإضافي لهذه الوظيفة الإضافية](https://github.com/sponsors/alexplusde)

## تثبيت

قم بتنزيل وتثبيت الملحق `qanda` في مثبت REDAXO. يظهر عنصر قائمة جديد `أسئلة & إجابات`.

## استخدم في الواجهة الأمامية

### نموذج وحدة

```php
<h1>الأسئلة الشائعة page</h1>
<؟ php

echo qanda :: showFAQPage (qanda :: getAll ())؛ // Json + ld

foreach (qanda :: getAll () as $question) {
    echo '<details><summary>'.$questionاحصل على سؤال>). '</summary>'؛
    صدى "<div class="answer">".$question->getAnswer (). '</div></details>'؛
}
؟>
```

```php
<h3>أهم الأسئلة</h3>
<؟ php
foreach (qanda :: getAll () as $question) {
    echo '<details><summary>'.$questionاحصل>سؤال (). '</summary>'؛
    صدى "<div class="answer">".$question->getAnswer (). '</div></details>'؛
    صدى قاندا :: showJsonLd ($question) ؛
}
؟>
```

### الصنف `قنده`

اكتب `rex_yform_manager_dataset`. يصل إلى الجدول `rex_qanda` بأسئلة وأجوبة.

#### إخراج العينة

```php
$question = qanda :: get (3) ؛ // question with id = 3

// question and answer
dump ($question->getQuestion ())؛ // Question
dump ($question>()) ؛ // مؤلف السؤال
تفريغ ($question>()) ؛ // الإجابة بصيغة HTML (إذا تم إعطاء محرر)
dump ($question>()) ؛ // Response كنص بدلاً من HTML

// Category
dump ($question>())؛ // فئة السؤال / الإجابة بالمعرف = 3
تفريغ ($question>()) ؛ // فئات السؤال / الإجابة بالمعرف = 3

// طرق أخرى
تفريغ ($question>()) ؛ // عنوان URL للصفحة الحالية بالتسمية `سؤال-{id}
```

المزيد من الطرق على https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### الصنف `qanda_category`

اكتب `rex_yform_manager_dataset`. الوصول إلى الجدول `rex_qanda_category`.

#### عينة إخراج من فئة

```php
تفريغ (qanda_category :: get (3)) ؛ // فئة بالمعرف = 3
تفريغ (qanda_category :: get (3) ->getAllQuestions ()) ؛ // كل أزواج الأسئلة والأجوبة من معرف الفئة = 3
```

المزيد من الطرق على https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## استخدم في الخلفية: إدخال الأسئلة والأجوبة.

### جدول QUESTIONS

يتم تسجيل مجموعات الأسئلة والأجوبة الفردية في الجدول `rex_qanda`. بعد تثبيت `qanda` ، تتوفر الحقول التالية:

| يكتب          | أكتب اسم              | اسم العائلة         | تعيين            |
| ------------- | --------------------- | ------------------- | ---------------- |
| القيمة        | نص                    | سؤال                | سؤال             |
| التحقق من صحة | فارغة                 | سؤال                |                  |
| القيمة        | منطقة النص            | إجابه               | إجابه            |
| القيمة        | be_manager_relation | qanda_category_id | الفئة            |
| القيمة        | ملصق التاريخ          | تاريخ الإنشاء       | تاريخ الإنشاء    |
| القيمة        | be_user               | المُحدِّث           | آخر تغيير بواسطة |
| القيمة        | be_user               | الخالق              | مؤلف             |
| القيمة        | أولوية                | أولوية              | ترتيب            |

تم بالفعل إدراج أهم عمليات التحقق من الصحة.

### جدول الفئات

يمكن تعديل جدول الفئات بحرية لتجميع الأسئلة / الإجابات أو للكلمات الرئيسية (كعلامات).

| يكتب          | أكتب اسم       | اسم العائلة | تعيين  |
| ------------- | -------------- | ----------- | ------ |
| القيمة        | نص             | اسم العائلة | لقب    |
| التحقق من صحة | فريدة من نوعها | اسم العائلة |        |
| التحقق من صحة | فارغة          | اسم العائلة |        |
| القيمة        | خيار           | الحالة      | الحالة |

## رخصة

رخصة معهد ماساتشوستس للتكنولوجيا

## مؤلف

**الكسندر والثر**  
http://www.alexplus.de  
https://github.com/alexplusde

**قيادة المشروع**  
[Alexander Walther](https://github.com/alexplusde)

## الاعتمادات

يعتمد نظام qanda على: [YForm](https://github.com/yakamara/redaxo_yform)  

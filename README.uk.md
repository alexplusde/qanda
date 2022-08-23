# FAQ / Запитання та відповіді для REDAXO 5.x & YForm 4.x

За допомогою цього аддона можна вводити та керувати розділами поширених запитань, а також загальними запитаннями. & відповідей. Безкоштовно для некомерційних проектів (CC BY-NC-SA 4.0). Якщо у вас є запитання щодо ліцензії та використання, будь ласка, зв’яжіться з qanda@alexplus.de.

![Логотип GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## особливості

* Повністю реалізовано з **YForm** : доступні всі функції та параметри налаштування YForm
* Простий: вихід здійснюється через [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) або об’єктно-орієнтований через [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Гнучкий: фільтруйте запитання та відповіді за категоріями
* Корисно: лише вибрані **ролей**/редактори мають доступ
* Оптимізовано для пошукової системи: готовий до [формату JSON+LD](https://jsonld.com/question-and-answer/) і структурованих даних на основі schema.org
* Готовий до набагато більшого: сумісний із [URL2 addon](https://github.com/tbaddade/redaxo_url)

> **Порада:** Аддон чудово працює разом із аддонами [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Внесіть власні вдосконалення** до [qanda](https://github.com/alexplusde/qanda) сховища GitHub. Або **підтримайте цей аддон:** Замовленням [ви підтримуєте подальший розвиток цього аддона](https://github.com/sponsors/alexplusde)

## установка

Завантажте та встановіть аддон `qanda` у програмі встановлення REDAXO. Потім з’являється новий пункт меню `Запитання & Відповіді`.

## Використовуйте в інтерфейсі

### приклад модуля

```php
<h1>Сторінка поширених запитань</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Найважливіші запитання</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Клас `і`

Тип `rex_yform_manager_dataset`. Доступ до таблиці `rex_qanda` із запитаннями та відповідями.

#### вихідний зразок

```php
$question = qanda::get(3); // запитання з id=3

// запитання та відповідь
dump($question->getQuestion()); // Запитання
dump($question->getAuthor()); // автор запитання
dump($question->getAnswer()); // Відповідь як HTML (якщо вказано редактор)
dump($question->getAnswerAsPlaintext()); // Відповідь як текст замість HTML

// Категорія
dump($question->getCategory()); // Категорія для питання/відповіді з id=3
dump($question->getCategories()); // Категорії для запитання/відповіді з id=3

// Інші методи
dump($question->getUrl()); // URL поточної сторінки з міткою `question-header-{id}
```

Більше методів на https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Клас `qanda_category`

Тип `rex_yform_manager_dataset`. Отримує доступ до таблиці `rex_qanda_category`.

#### Зразок виведення категорії

```php
dump(qanda_category::get(3)); // категорія з id=3
dump(qanda_category::get(3)->getAllQuestions()); // Усі пари запитання-відповідь категорії id=3
```

Більше методів на https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Використання у бекенді: введення питань і відповідей.

### Таблиця ПИТАННЯ

Окремі комбінації питання-відповідь записуються в таблицю `rex_qanda`. Після встановлення `qanda` доступні такі поля:

| Тип        | назву типу            | Прізвище            | позначення        |
| ---------- | --------------------- | ------------------- | ----------------- |
| значення   | текст                 | запитання           | запитання         |
| перевірити | порожній              | запитання           |                   |
| значення   | текстове поле         | відповідь           | відповідь         |
| значення   | be_manager_relation | qanda_category_id | категорія         |
| значення   | штамп дати            | створена дата       | дата створення    |
| значення   | be_user               | updateuser          | Остання зміна від |
| значення   | be_user               | createuser          | автор             |
| значення   | пріоритет             | пріоритет           | Серія             |

Найважливіші перевірки вже вставлено.

### Таблиця КАТЕГОРІЇ

Таблицю категорій можна вільно змінювати, щоб групувати запитання/відповіді або ключові слова (як теги).

| Тип        | назву типу | Прізвище | позначення |
| ---------- | ---------- | -------- | ---------- |
| значення   | текст      | Прізвище | назва      |
| перевірити | унікальний | Прізвище |            |
| перевірити | порожній   | Прізвище |            |
| значення   | вибір      | статус   | статус     |

## ліцензія

Ліцензія MIT

## автор

**Олександр Вальтер**  
http://www.alexplus.de  
https://github.com/alexplusde

**Керівник проекту**  
[Олександр Вальтер](https://github.com/alexplusde)

## кредити

qanda базується на: [YForm](https://github.com/yakamara/redaxo_yform)  

# FAQ / Вопросы и ответы по REDAXO 5.x & YForm 4.x

С помощью этого дополнения можно вводить и управлять областями часто задаваемых вопросов, а также & вопросами. Бесплатно для некоммерческих проектов (CC BY-NC-SA 4.0). Если у вас есть какие-либо вопросы о лицензии и использовании, пожалуйста, свяжитесь с qanda@alexplus.de.

![Логотип GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## Особенности

* Полностью реализовано с **YForm** : доступны все функции и параметры настройки YForm
* Простой: вывод через [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) или объектно-ориентированный через [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Гибкость: фильтрация вопросов и ответов по категориям
* Полезно: Доступ имеют только выбранные **ролей**/редакторы
* Оптимизирован для поисковых систем: готов к формату [JSON+LD](https://jsonld.com/question-and-answer/) и структурированным данным на основе schema.org
* Готов к большему: совместим с [надстройкой URL2](https://github.com/tbaddade/redaxo_url)

> **Совет:** Аддон отлично работает вместе с аддонами [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Внесите свои собственные улучшения** в репозиторий [qanda](https://github.com/alexplusde/qanda) GitHub. Или **поддержите этот аддон:** Заказом [вы поддержите дальнейшее развитие этого аддона](https://github.com/sponsors/alexplusde)

## монтаж

Скачайте и установите аддон `qanda` в установщике REDAXO. Затем появится новый пункт меню `Вопросы & Ответы`.

## Использование во внешнем интерфейсе

### пример модуля

```php
<h1>Страница часто задаваемых вопросов</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->получитьВопрос().'</summary>';
    эхо '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Самые важные вопросы</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->получитьВопрос().'</summary>';
    эхо '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Класс `канда`

Введите `rex_yform_manager_dataset`. Доступ к таблице `rex_qanda` с вопросами и ответами.

#### образец вывода

```php
$question = qanda::get(3); // вопрос с id=3

// вопрос и ответ
dump($question->getQuestion()); // Вопрос
дамп($question->getAuthor()); // автор вопроса
dump($question->getAnswer()); // Ответ в формате HTML (если был задан редактор)
dump($question->getAnswerAsPlaintext()); // Ответ в виде текста вместо HTML

// Дамп категории
($question->getCategory()); // Категория для вопроса/ответа с id=3
dump($question->getCategories()); // Категории для вопроса/ответа с id=3

// Другие методы
dump($question->getUrl()); // URL текущей страницы с меткой `question-header-{id}
```

Дополнительные методы на https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Класс `qanda_category`

Введите `rex_yform_manager_dataset`. Доступ к таблице `rex_qanda_category`.

#### Пример вывода категории

```php
дамп(qanda_category::get(3)); // категория с id=3
dump(qanda_category::get(3)->getAllQuestions()); // Все пары вопрос-ответ категории id=3
```

Дополнительные методы на https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Использование в бэкенде: ввод вопросов и ответов.

### Таблица ВОПРОСОВ

Отдельные комбинации вопросов и ответов записываются в таблицу `rex_qanda`. После установки `qanda` доступны следующие поля:

| Тип          | имя типа              | Фамилия                 | обозначение         |
| ------------ | --------------------- | ----------------------- | ------------------- |
| ценность     | текст                 | вопрос                  | вопрос              |
| подтверждать | пустой                | вопрос                  |                     |
| ценность     | текстовая область     | отвечать                | отвечать            |
| ценность     | be_manager_relation | qanda_category_id     | категория           |
| ценность     | штамп с датой         | Дата создания           | Дата создания       |
| ценность     | be_user               | пользователь обновления | Последнее изменение |
| ценность     | be_user               | Создать пользователя    | автор               |
| ценность     | приоритет             | приоритет               | Серии               |

Самые важные валидации уже вставлены.

### Таблица КАТЕГОРИИ

Таблицу категорий можно свободно модифицировать для группировки вопросов/ответов или ключевых слов (в виде тегов).

| Тип          | имя типа   | Фамилия | обозначение |
| ------------ | ---------- | ------- | ----------- |
| ценность     | текст      | Фамилия | заглавие    |
| подтверждать | уникальный | Фамилия |             |
| подтверждать | пустой     | Фамилия |             |
| ценность     | выбор      | статус  | статус      |

## лицензия

лицензия Массачусетского технологического института

## автор

**Александр Вальтер**  
http://www.alexplus.de  
https://github.com/alexplusde

**Руководитель проекта**  
[Александр Вальтер](https://github.com/alexplusde)

## кредиты

канда основана на: [YForm](https://github.com/yakamara/redaxo_yform)  

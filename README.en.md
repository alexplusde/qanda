# FAQ / Questions and Answers for REDAXO 5.x & YForm 4.x

With this addon FAQ areas as well as general questions & answers can be entered and managed. Free for non-commercial projects (CC BY-NC-SA 4.0). If you have any questions about the license and use, please contact qanda@alexplus.de.

![GitHub logo](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## features

* Fully implemented with **YForm** : All features and customization options of YForm available
* Simple: The output is via [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) or object-oriented via [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexible: Filter questions and answers by categories
* Useful: Only selected **roles**/editors have access
* Search engine optimized: Ready for [JSON+LD format](https://jsonld.com/question-and-answer/) and structured data based on schema.org
* Ready for much more: Compatible with [URL2 addon](https://github.com/tbaddade/redaxo_url)

> **Tip:** The addon works great together with the addons [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Contribute your own improvements** to the [qanda](https://github.com/alexplusde/qanda) GitHub repository. Or **support this addon:** With a [order you support the further development of this addon](https://github.com/sponsors/alexplusde)

## installation

Download and install the addon `qanda` in the REDAXO installer. A new menu item `Questions & Answers`then appears.

## Use in the frontend

### example module

```php
<h1>FAQ page</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>The most important questions</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### The class `qanda`

Type `rex_yform_manager_dataset`. Accesses the table `rex_qanda` with questions and answers.

#### sample output

```php
$question = qanda::get(3); // question with id=3

// question and answer
dump($question->getQuestion()); // Question
dump($question->getAuthor()); // author of question
dump($question->getAnswer()); // Answer as HTML (if an editor was specified)
dump($question->getAnswerAsPlaintext()); // Response as text instead of HTML

// Category
dump($question->getCategory()); // Category for question/answer with id=3
dump($question->getCategories()); // Categories for the question/answer with id=3

// Other methods
dump($question->getUrl()); // URL to current page with label `question-header-{id}
```

More methods at https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### The class `qanda_category`

Type `rex_yform_manager_dataset`. Accesses table `rex_qanda_category`.

#### Sample output of a category

```php
dump(qanda_category::get(3)); // category with id=3
dump(qanda_category::get(3)->getAllQuestions()); // All question-answer pairs of category id=3
```

More methods at https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Use in the backend: input of questions and answers.

### The QUESTIONS table

Individual question-answer combinations are recorded in the table `rex_qanda`. After installing `qanda` , the following fields are available:

| Type     | type name             | Surname             | designation    |
| -------- | --------------------- | ------------------- | -------------- |
| value    | text                  | question            | question       |
| validate | empty                 | question            |                |
| value    | textarea              | answer              | answer         |
| value    | be_manager_relation | qanda_category_id | category       |
| value    | datestamp             | createddate         | creation date  |
| value    | be_user               | updateuser          | Last change by |
| value    | be_user               | createuser          | author         |
| value    | priority              | priority            | Series         |

The most important validations have already been inserted.

### The CATEGORIES table

The table for categories can be freely modified to group questions/answers or to keywords (as tags).

| Type     | type name | Surname | designation |
| -------- | --------- | ------- | ----------- |
| value    | text      | Surname | title       |
| validate | unique    | Surname |             |
| validate | empty     | Surname |             |
| value    | choice    | status  | status      |

## license

MIT license

## author

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Project lead**  
[Alexander Walther](https://github.com/alexplusde)

## credits

qanda is based on: [YForm](https://github.com/yakamara/redaxo_yform)  

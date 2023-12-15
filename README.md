# FAQ / Fragen und Antworten für REDAXO 5.x & YForm 4.x

![GitHub Logo](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)

## Features

* Vollständig mit **YForm** umgesetzt: Alle Features und Anpassungsmöglichkeiten von YForm verfügbar
* Einfach: Die Ausgabe erfolgt über [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) oder objektorientiert über [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexibel: Filtere Fragen und Antworten nach Kategorien
* Sinnvoll: Nur ausgewählte **Rollen**/Redakteure haben Zugriff
* Suchmaschinenoptimiert: Bereit für das [JSON+LD-Format](https://jsonld.com/question-and-answer/) und Strucured Data auf Basis von schema.org
* Bereit für viel mehr: Kompatibel zum [URL2-Addon](https://github.com/tbaddade/redaxo_url)

> **Tipp:** Das Addon arbeitet hervorragend zusammen mit den Addons [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Steuere eigene Verbesserungen** dem [GitHub-Repository von qanda](https://github.com/alexplusde/qanda) bei. Oder **unterstütze dieses Addon:** Mit einer [Beauftragung unterstützt du die Weiterentwicklung dieses AddOns](https://github.com/sponsors/alexplusde)

## Installation

Im REDAXO-Installer das Addon `qanda` herunterladen und installieren. Anschließend erscheint ein neuer Menüpunkt `Fragen & Antworten`.

## Nutzung im Frontend

### Beispiel-Modul

```php
<h1>FAQ-Seite</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Die wichtigsten Fragen</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Die Klasse `qanda`

Typ `rex_yform_manager_dataset`. Greift auf die Tabelle `rex_qanda` mit Fragen und Antworten zu.

#### Beispiel-Ausgabe

```php
$question = qanda::get(3); // Frage mit der id=3

// Frage und Antwort
dump($question->getQuestion()); // Frage
dump($question->getAuthor()); // Autor der Frage
dump($question->getAnswer()); // Antwort als HTML (sofern ein Editor angegeben wurde)
dump($question->getAnswerAsPlaintext()); // Antwort als Text, statt als HTML

// Kategorie
dump($question->getCategory()); // Kategorie zur Frage/Antwort mit der id=3
dump($question->getCategories()); // Kategorien zur Frage/Antwort mit der id=3

// Weitere Methoden
dump($question->getUrl()); // URL zur aktuellen Seite mit Sprungmarke `question-header-{id}`
```

Weitere Methoden unter <https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md>

### Die Klasse `qanda_category`

Typ `rex_yform_manager_dataset`. Greift auf die Tabelle `rex_qanda_category` zu.

#### Beispiel-Ausgabe einer Kategorie

```php
dump(qanda_category::get(3)); // Kategorie mit der id=3
dump(qanda_category::get(3)->getAllQuestions()); // Alle Frage-Antwort-Paare der Kategorie id=3
```

Weitere Methoden unter <https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md>

## Nutzung im Backend: Eingabe von Fragen und Antworten

### Die Tabelle "FRAGEN"

In der Tabelle `rex_qanda` werden einzelne Frage-Antwort-Kombinationen festgehalten.

GitHub Copilot: Hier sind die deutschen PHP-Docs in dieser Klasse mit Beispielen als Markdown:

#### `getCategory()`

Gibt die erste Kategorie zurück.

```php
$firstCategory = $question->getCategory();
```

#### `getCategories()`

Gibt alle Kategorien zurück.

```php
$categories = $question->getCategories();
```

#### `getQuestion(string|null $lang = null)`

Gibt die Frage in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.

```php
$question = $question->getQuestion('de');
```

#### `findByIds(array $ids, float $status = 1)`

Findet Datensätze anhand ihrer IDs.

```php
$records = qanda::findByIds([1, 2, 3], 1.0);
```

#### `findByCategoryIds(array $category_ids, float $status = 1)`

Findet Datensätze anhand ihrer Kategorie-IDs.

```php
$records = qanda::findByCategoryIds([1, 2, 3], 1.0);
```

#### `getAnswer(string|null $lang = null)`

Gibt die Antwort in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.

```php
$answer = $question->getAnswer('de');
```

GitHub Copilot: Hier sind die deutschen PHP-Docs in dieser Klasse mit Beispielen als Markdown:

#### `getAnswerAsPlaintext(string|null $lang = null)`

Gibt die Antwort als reinen Text (ohne HTML-Tags) in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.

```php
$plaintextAnswer = $question->getAnswerAsPlaintext('de');
```

#### `getTranslation(string|null $lang = null)`

Gibt die Übersetzung in der angegebenen Sprache zurück, falls vorhanden, sonst die Sammlung aller Übersetzungen.

```php
$translation = $question->getTranslation('de');
```

#### `getAuthor()`

Gibt den Autor zurück.

```php
$author = $question->getAuthor();
```

#### `getUrl(string $param = 'question-header-')`

Gibt die URL zurück, optional mit einem spezifischen Parameter.

```php
$url = $question->getUrl('question-header-');
```

#### `showJsonLd(int|rex_yform_manager_dataset $question)`

Gibt die JSON-LD-Darstellung einer Frage zurück.

```php
$jsonLd = MyClass::showJsonLd($question);
```

#### `showFAQPage(array|rex_yform_manager_collection $questions)`

Gibt die JSON-LD-Darstellung einer FAQ-Seite zurück.

```php
$jsonLd = MyClass::showFAQPage($questions);
```

### Die Tabelle "KATEGORIEN"

Die Tabelle für Kategorien kann frei verändert werden, um Fragen / Antworten zu gruppieren oder zu Verschlagworten (als Tags).

GitHub Copilot: Hier sind die deutschen PHP-Docs in dieser Klasse mit Beispielen als Markdown:

#### `getName()`

Gibt den Namen der Kategorie zurück.

```php
$name = $category->getName();
```

#### `findByIds(array|string $ids, int $status = 1)`

Findet Kategorien anhand ihrer IDs.

```php
$categories = qanda_category::findByIds([1, 2, 3], 1);
```

#### `find(int $status = 1)`

Findet Fragen, die zu dieser Kategorie gehören.

```php
$questions = $category->find(1);
```

### Die Tabelle "ÜBERSETZUNGEN"

GitHub Copilot: Hier sind alle deutschen PHP-Docs in dieser Klasse mit Beispielen als Markdown:

#### `getAnswerAsPlaintext()`

Gibt die Antwort als reinen Text (ohne HTML-Tags) zurück.

```php
$plaintextAnswer = $qanda_lang->getAnswerAsPlaintext();
```

#### `getQuestion()`

Gibt die Frage zurück.

```php
$question = $qanda_lang->getQuestion();
```

#### `getAnswer()`

Gibt die Antwort zurück.

```php
$answer = $qanda_lang->getAnswer();
```

#### `setAnswer(string $answer)`

Setzt den Wert für die Antwort.

```php
$qanda_lang->setAnswer('This is the answer.');
```

#### `setQuestion(string $question)`

Setzt den Wert für die Frage.

```php
$qanda_lang->setQuestion('What is the question?');
```

#### `getTranslation(int $question, string $lang)`

Gibt die Übersetzung für eine bestimmte Frage und Sprache zurück.

```php
$translation = qanda_lang::getTranslation(1, 'de');
```

## Lizenz

MIT-Lizenz

## Autor

**Alexander Walther**  
<http://www.alexplus.de>  
<https://github.com/alexplusde>  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)

## Credits

qanda basiert auf: [YForm](https://github.com/yakamara/redaxo_yform)  

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

Weitere Methoden unter https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Die Klasse `qanda_category`

Typ `rex_yform_manager_dataset`. Greift auf die Tabelle `rex_qanda_category` zu.

#### Beispiel-Ausgabe einer Kategorie

```php
dump(qanda_category::get(3)); // Kategorie mit der id=3
dump(qanda_category::get(3)->getAllQuestions()); // Alle Frage-Antwort-Paare der Kategorie id=3
```

Weitere Methoden unter https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Nutzung im Backend: Eingabe von Fragen und Antworten.

### Die Tabelle "FRAGEN"

In der Tabelle `rex_qanda` werden einzelne Frage-Antwort-Kombinationen festgehalten. Nach der Installation von `qanda` stehen folgende Felder zur Verfügung:

| Typ      | Typname             | Name              | Bezeichnung         |
| -------- | ------------------- | ----------------- | ------------------- |
| value    | text                | question          | Frage               |
| validate | empty               | question          |                     |
| value    | textarea            | answer            | Antwort             |
| value    | be_manager_relation | qanda_category_id | Kategorie           |
| value    | datestamp           | createdate        | Erstelldatum        |
| value    | be_user             | updateuser        | Letzte Änderung von |
| value    | be_user             | createuser        | Autor               |
| value    | prio                | prio              | Reihenfolge         |

Die wichtigsten Validierungen wurden bereits eingefügt.

### Die Tabelle "KATEGORIEN"

Die Tabelle für Kategorien kann frei verändert werden, um Fragen / Antworten zu gruppieren oder zu Verschlagworten (als Tags).

| Typ      | Typname | Name   | Bezeichnung |
| -------- | ------- | ------ | ----------- |
| value    | text    | name   | Titel       |
| validate | unique  | name   |             |
| validate | empty   | name   |             |
| value    | choice  | status | Status      |

## Lizenz

MIT-Lizenz

## Autor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)

## Credits

qanda basiert auf: [YForm](https://github.com/yakamara/redaxo_yform)  

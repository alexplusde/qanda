# FAQ / Froen an Äntwerten fir REDAXO 5.x & YForm 4.x

Mat dësem Addon FAQ Beräicher souwéi allgemeng Froen & Äntwerten kënnen aginn a geréiert ginn. Gratis fir net-kommerziell Projeten (CC BY-NC-SA 4.0). Wann Dir Froen iwwer d'Lizenz an d'Benotzung hutt, kontaktéiert w.e.g. qanda@alexplus.de.

![GitHub logo](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## Eegeschaften

* Voll implementéiert mat **YForm** : All Features an Personnalisatiounsoptioune vun YForm verfügbar
* Einfach: D'Ausgab ass iwwer [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) oder objektorientéiert iwwer [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexibel: Filter Froen an Äntwerten no Kategorien
* Nëtzlech: Nëmmen ausgewielt **Rollen**/ Redaktoren hunn Zougang
* Sichmotor optimiséiert: Bereet fir [JSON+LD Format](https://jsonld.com/question-and-answer/) a strukturéiert Daten baséiert op schema.org
* Prett fir vill méi: Kompatibel mat [URL2 Addon](https://github.com/tbaddade/redaxo_url)

> **Tipp:** Den Addon funktionnéiert super zesumme mat den Addons [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Bäitrag Är eege Verbesserungen** zum [qanda](https://github.com/alexplusde/qanda) GitHub Repository. Oder **ënnerstëtzt dësen Addon:** Mat enger [Bestellung ënnerstëtzt Dir d'Weiderentwécklung vun dësem Addon](https://github.com/sponsors/alexplusde)

## Installatioun

Eroflueden an installéieren den Addon `qanda` am REDAXO Installer. En neit Menüpunkt `Froen & Äntwerten`erschéngt dann.

## Benotzt am Frontend

### Beispill Modul

```php
<h1>FAQ Säit</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Déi wichtegst Froen</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda ::showJsonLd($question);
}
?>
```

### Klass `qanda`

Typ `rex_yform_manager_dataset`. Zougrëff op den Dësch `rex_qanda` mat Froen an Äntwerten.

#### Beispill Ausgang

```php
$question = qanda::get(3); // Fro mat ID = 3

// Fro an Äntwert
dump ($question->getQuestion ()); // Fro
dump($question->getAuthor()); // Auteur vun Fro
dump ($question->getAnswer ()); // Äntwert als HTML (wann en Editeur spezifizéiert gouf)
dump ($question->getAnswerAsPlaintext ()); // Äntwert als Text amplaz HTML

// Kategorie
dump($question->getCategory()); // Kategorie fir Fro / Äntwert mat id = 3
dump ($question->getCategories ()); // Kategorien fir d'Fro/Äntwert mat id=3

// Aner Methoden
dump($question->getUrl()); // URL op déi aktuell Säit mam Label `Question-Header-{id}
```

Méi Methoden op https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Klass `qanda_category`

Typ `rex_yform_manager_dataset`. Zougrëff op den Dësch `rex_qanda_category`.

#### Probe Ausgang vun enger Kategorie

```php
dump(qanda_category::get(3)); // Kategorie mat ID = 3
dump (qanda_category :: get (3) ->getAllQuestions ()); // All Fro-Äntwert Pairen vun der Kategorie id=3
```

Méi Methoden op https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Benotzt am Backend: Input vu Froen an Äntwerten.

### D'QUESTIONS Dësch

Individuell Fro-Äntwert Kombinatioune sinn an der Tabell `rex_qanda` opgeholl. Nodeems Dir `qanda` installéiert hutt, sinn déi folgend Felder verfügbar:

| Typ         | Typ Numm              | Familljennumm       | Bezeechnung             |
| ----------- | --------------------- | ------------------- | ----------------------- |
| Wäert       | Text                  | Fro                 | Fro                     |
| validéieren | eidel                 | Fro                 |                         |
| Wäert       | Textberäich           | äntweren            | äntweren                |
| Wäert       | be_manager_relation | qanda_category_id | Kategorie               |
| Wäert       | datestempel           | erstallt Datum      | Kreatioun Datum         |
| Wäert       | be_user               | Update Benotzer     | Déi lescht Ännerung vum |
| Wäert       | be_user               | Benotzer erstellen  | Auteur                  |
| Wäert       | Prioritéit            | Prioritéit          | Serie                   |

Déi wichtegst Validatioune si scho agebaut ginn.

### D'Kategorien Dësch

D'Tabell fir Kategorien ka fräi geännert ginn fir Froen / Äntwerten ze gruppéieren oder op Schlësselwieder (als Tags).

| Typ         | Typ Numm     | Familljennumm | Bezeechnung |
| ----------- | ------------ | ------------- | ----------- |
| Wäert       | Text         | Familljennumm | Titel       |
| validéieren | eenzegaarteg | Familljennumm |             |
| validéieren | eidel        | Familljennumm |             |
| Wäert       | Choix        | Status        | Status      |

## Lizenz

MIT Lizenz

## Auteur

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Projektleit**  
[Alexander Walther](https://github.com/alexplusde)

## Kreditter

qanda baséiert op: [YForm](https://github.com/yakamara/redaxo_yform)  

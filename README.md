# FAQ / Fragen und Antworten für REDAXO 5.10 & YForm 3.4

Mit diesem Addon können FAQ-Bereiche sowie generelle Fragen & Antworten eingegeben und verwaltet werden. Kostenlos für nicht-kommerzielle Projekte (CC BY-NC-SA 4.0). Lizenz bei qanda-addon@alexplus.de anfragen.

## Features

* Vollständig mit **YForm** umgesetzt: Alle Features und Anpassungsmöglichkeiten von YForm verfügbar
* Einfach: Die Ausgabe erfolgt über [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) oder objektorientiert über [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexibel: Module 
* Sinnvoll: Nur ausgewählte **Rollen**/Redakteure haben Zugriff
* Bereit für **mehrsprachige** Websites: Fragen & Antworten können Sprachen zugeordnet werden.
* Bereit für mehr: Vorbereitet für das [JSON+LD-Format](https://jsonld.com/question-and-answer//)
* Bereit für viel mehr: Kompatibel zum [URL2-Addon](https://github.com/tbaddade/redaxo_url)

> **Tipp:** Das Addon arbeitet hervorragend zusammen mit den Addons [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Steuere eigene Verbesserungen** dem [GitHub-Repository von qanda](https://github.com/alexplusde/qanda) bei. Oder **unterstütze dieses Addon:** Mit einer [Spende oder Beauftragung unterstützt du die Weiterentwicklung dieses AddOns](https://github.com/sponsors/alexplusde)

## Installation

Im REDAXO-Installer das Addon `qanda` herunterladen und installieren. Anschließend erscheint ein neuer Menüpunkt `Fragen & Antworten`.

## Nutzung im Frontend

### Die Klasse `qanda`

Typ `rex_yform_manager_dataset`. Greift auf die Tabelle `rex_qanda` mit Fragen und Antworten zu.

#### Beispiel-Ausgabe

```php
dump(qanda::get(3)); // Frage mit der id=3
dump(qanda::get(3)->getCategory()); // Kategorie zur Frage/Antwort mit der id=3
```

### Die Klasse `qanda_category`

Typ `rex_yform_manager_dataset`. Greift auf die Tabelle `rex_qanda_category` zu.

#### Beispiel-Ausgabe einer Kategorie

```php
dump(qanda_category::get(3)); // Kategorie mit der id=3
```

## Nutzung im Backend: Die Terminverwaltung.

### Die Tabelle "FRAGEN"

In der Termin-Tabelle werden einzelne Frage-Antwort-Kombinationen festgehalten. Nach der Installation von `qanda` stehen folgende Felder zur Verfügung:

| Typ      | Typname             | Name                | Bezeichnung         |
|----------|---------------------|---------------------|---------------------|
| value    | text                | question            | Frage               |
| validate | empty               | question            |                     |
| value    | textarea            | answer              | Antwort             |
| value    | be_manager_relation | qanda_category_id   | Kategorie           |
| value    | datestamp           | createdate          | Erstelldatum        |
| value    | be_user             | updateuser          | Letzte Änderung von |
| value    | be_user             | createuser          | Autor               |
| value    | prio                | prio                | Reihenfolge         |

Die wichtigsten Validierungen wurden bereits eingefügt.

### Die Tabelle "KATEGORIEN"

Die Tabelle Kategorien kann frei verändert werden, um Fragen / Antworten zu gruppieren oder zu Verschlagworten (als Tags).

| Typ      | Typname             | Name    | Bezeichnung |
|----------|---------------------|---------|-------------|
| value    | text                | name    | Titel       |
| validate | unique              | name    |             |
| validate | empty               | name    |             |
| value    | choice              | status  | Status      |

## Lizenz

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />Dieses Werk ist lizenziert unter einer <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Namensnennung - Nicht-kommerziell - Weitergabe unter gleichen Bedingungen 4.0 International Lizenz</a>, siehe [LICENSE.md](https://github.com/alexplusde/qanda/blob/master/LICENSE.md)  

## Autor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)

## Credits

qanda basiert auf: [YForm](https://github.com/yakamara/redaxo_yform)  
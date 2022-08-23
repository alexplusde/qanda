# FAQ / Pytania i odpowiedzi dotyczące REDAXO 5.x & YForm 4.x

Za pomocą tego dodatku można wprowadzać i zarządzać obszarami najczęściej zadawanych pytań oraz pytaniami &. Bezpłatnie dla projektów niekomercyjnych (CC BY-NC-SA 4.0). Jeśli masz jakiekolwiek pytania dotyczące licencji i użytkowania, prosimy o kontakt pod adresem qanda@alexplus.de.

![Logo GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## cechy

* W pełni zaimplementowany z **YForm** : Dostępne wszystkie funkcje i opcje dostosowywania YForm
* Proste: wyjście jest przez [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) lub obiektowo przez [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Elastyczny: filtruj pytania i odpowiedzi według kategorii
* Przydatne: Tylko wybrane **ról**/edytorzy mają dostęp
* Zoptymalizowana pod kątem wyszukiwarek: Gotowa na [format JSON+LD](https://jsonld.com/question-and-answer/) i uporządkowane dane oparte na schema.org
* Gotowy na wiele więcej: kompatybilny z dodatkiem [URL2](https://github.com/tbaddade/redaxo_url)

> **Wskazówka:** Dodatek świetnie współpracuje z dodatkami [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Wnieś własne ulepszenia** do repozytorium [qanda](https://github.com/alexplusde/qanda) GitHub. Lub **obsługuje ten dodatek:** Zamówieniem [wspierasz dalszy rozwój tego dodatku](https://github.com/sponsors/alexplusde)

## instalacja

Pobierz i zainstaluj dodatek `qanda` w instalatorze REDAXO. Pojawia się nowa pozycja menu `Pytania & Odpowiedzi`.

## Użyj w interfejsie

### przykładowy moduł

```php
<h1>Strona FAQ</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Najważniejsze pytania</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    echo '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Klasa `qanda`

Wpisz `rex_yform_manager_dataset`. Uzyskuje dostęp do tabeli `rex_qanda` z pytaniami i odpowiedziami.

#### przykładowe wyjście

```php
$question = qanda::get(3); // pytanie o id=3

// pytanie i odpowiedź
dump($question->getQuestion()); // Pytanie
dump($question->getAuthor()); // autor pytania
dump($question->getAnswer()); // Odpowiedz jako HTML (jeśli podano edytor)
dump($question->getAnswerAsPlaintext()); // Odpowiedź jako tekst zamiast HTML

// Kategoria
dump($question->getCategory()); // Kategoria pytania/odpowiedzi z id=3
dump($question->getCategories()); // Kategorie dla pytania/odpowiedzi z id=3

// Inne metody
dump($question->getUrl()); // URL do bieżącej strony z etykietą `question-header-{id}
```

Więcej metod na https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Klasa `qanda_category`

Wpisz `rex_yform_manager_dataset`. Dostęp do tabeli `rex_qanda_category`.

#### Przykładowe wyjście kategorii

```php
dump(qanda_category::get(3)); // kategoria o id=3
dump(qanda_category::get(3)->getAllQuestions()); // Wszystkie pary pytanie-odpowiedź z kategorii id=3
```

Więcej metod na https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Użyj w backendzie: wprowadzanie pytań i odpowiedzi.

### Tabela PYTANIA

Poszczególne kombinacje pytanie-odpowiedź są zapisane w tabeli `rex_qanda`. Po zainstalowaniu `qanda` dostępne są następujące pola:

| Rodzaj       | Wpisz imię            | Nazwisko                | Przeznaczenie      |
| ------------ | --------------------- | ----------------------- | ------------------ |
| wartość      | tekst                 | pytanie                 | pytanie            |
| uprawomocnić | pusty                 | pytanie                 |                    |
| wartość      | obszar tekstowy       | odpowiadać              | odpowiadać         |
| wartość      | be_manager_relation | qanda_category_id     | Kategoria          |
| wartość      | Data stempla          | stworz Date             | Data utworzenia    |
| wartość      | być_użytkownikiem     | użytkownik aktualizacji | Ostatnia zmiana do |
| wartość      | być_użytkownikiem     | Stwórz użytkownika      | autor              |
| wartość      | priorytet             | priorytet               | Seria              |

Najważniejsze walidacje zostały już wstawione.

### Tabela KATEGORIE

Tabelę dla kategorii można dowolnie modyfikować w celu grupowania pytań/odpowiedzi lub słów kluczowych (jako tagów).

| Rodzaj       | Wpisz imię | Nazwisko | Przeznaczenie |
| ------------ | ---------- | -------- | ------------- |
| wartość      | tekst      | Nazwisko | tytuł         |
| uprawomocnić | unikalny   | Nazwisko |               |
| uprawomocnić | pusty      | Nazwisko |               |
| wartość      | wybór      | status   | status        |

## licencja

Licencja MIT

## autor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Kierownik projektu**  
[Alexander Walther](https://github.com/alexplusde)

## kredyty

qanda bazuje na: [YForm](https://github.com/yakamara/redaxo_yform)  

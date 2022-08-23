# Pogosta vprašanja / vprašanja in odgovori za REDAXO 5.x & YForm 4.x

S tem dodatkom lahko vnesete in upravljate področja pogostih vprašanj in splošnih vprašanj. & odgovorov. Brezplačno za nekomercialne projekte (CC BY-NC-SA 4.0). Če imate kakršna koli vprašanja o licenci in uporabi, se obrnite na qanda@alexplus.de.

![Logotip GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## Lastnosti

* V celoti implementirano z **YForm** : na voljo so vse funkcije in možnosti prilagajanja YForm
* Preprosto: izhod je prek [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) ali objektno usmerjen prek [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Prilagodljivo: filtrirajte vprašanja in odgovore po kategorijah
* Uporabno: Samo izbranih **vlog**/ uredniki imajo dostop
* Optimizirano za iskalnik: pripravljeno za [JSON+LD format](https://jsonld.com/question-and-answer/) in strukturirane podatke na podlagi schema.org
* Pripravljen na veliko več: združljiv z [dodatkom URL2](https://github.com/tbaddade/redaxo_url)

> **Nasvet:** Dodatek odlično deluje skupaj z dodatki [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Prispevajte svoje izboljšave** v [qanda](https://github.com/alexplusde/qanda) repozitorij GitHub. Ali **podprite ta dodatek:** Z naročilom [podprite nadaljnji razvoj tega dodatka](https://github.com/sponsors/alexplusde)

## namestitev

Prenesite in namestite dodatek `qanda` v namestitvenem programu REDAXO. Nato se prikaže nov menijski element `Vprašanja & Odgovori`.

## Uporabite v sprednjem delu

### primer modula

```php
<h1>stran s pogostimi vprašanji</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question>().'</summary>';
    odmev '<div class="answer">'.$question>().'</div></details>';
}
?>
```

```php
<h3>Najpomembnejša vprašanja</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question>().'</summary>';
    odmev '<div class="answer">'.$question>().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Razred `in`

Vnesite `rex_yform_manager_dataset`. Dostop do tabele `rex_qanda` z vprašanji in odgovori.

#### vzorčni izhod

```php
$question = qanda::get(3); // vprašanje z id=3

// vprašanje in odgovor
dump($question->getQuestion()); // Vprašanje
dump($question->getAuthor()); // avtor vprašanja
dump($question->getAnswer()); // Odgovor kot HTML (če je bil naveden urejevalnik)
dump($question->getAnswerAsPlaintext()); // Odgovor kot besedilo namesto HTML

// Kategorija
dump($question->getCategory()); // Kategorija za vprašanje/odgovor z id=3
dump($question->getCategories()); // Kategorije za vprašanje/odgovor z id=3

// Druge metode
dump($question->getUrl()); // URL do trenutne strani z oznako `question-header-{id}
```

Več metod na https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Razred `qanda_category`

Vnesite `rex_yform_manager_dataset`. Dostopa do tabele `rex_qanda_category`.

#### Vzorec izpisa kategorije

```php
dump(qanda_category::get(3)); // kategorija z id=3
dump(qanda_category::get(3)->getAllQuestions()); // Vsi pari vprašanje-odgovor kategorije id=3
```

Več metod na https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Uporaba v ozadju: vnos vprašanj in odgovorov.

### Tabela VPRAŠANJA

Posamezne kombinacije vprašanj in odgovorov so zapisane v tabeli `rex_qanda`. Po namestitvi `qanda` so na voljo naslednja polja:

| Vrsta    | ime tipa              | Priimek             | imenovanje          |
| -------- | --------------------- | ------------------- | ------------------- |
| vrednost | besedilo              | vprašanje           | vprašanje           |
| potrditi | prazno                | vprašanje           |                     |
| vrednost | textarea              | odgovor             | odgovor             |
| vrednost | be_manager_relation | qanda_category_id | kategorijo          |
| vrednost | datumski žig          | createddate         | Datum nastanka      |
| vrednost | be_user               | updateuser          | Zadnja sprememba do |
| vrednost | be_user               | createuser          | avtor               |
| vrednost | prioriteta            | prioriteta          | serija              |

Najpomembnejše potrditve so že vstavljene.

### Tabela CATEGORIES

Tabelo za kategorije je mogoče poljubno spreminjati tako, da združuje vprašanja/odgovore ali ključne besede (kot oznake).

| Vrsta    | ime tipa   | Priimek | imenovanje |
| -------- | ---------- | ------- | ---------- |
| vrednost | besedilo   | Priimek | naslov     |
| potrditi | edinstveno | Priimek |            |
| potrditi | prazno     | Priimek |            |
| vrednost | izbira     | stanje  | stanje     |

## dovoljenje

Licenca MIT

## avtor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Vodja projekta**  
[Alexander Walther](https://github.com/alexplusde)

## krediti

qanda temelji na: [YForm](https://github.com/yakamara/redaxo_yform)  

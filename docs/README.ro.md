# Întrebări frecvente / Întrebări și răspunsuri pentru REDAXO 5.x & YForm 4.x

Cu acest supliment, zonele de întrebări frecvente, precum și întrebările generale, pot fi introduse și gestionate & răspunsuri. Gratuit pentru proiecte necomerciale (CC BY-NC-SA 4.0). Dacă aveți întrebări despre licență și utilizare, vă rugăm să contactați qanda@alexplus.de.

![Sigla GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## Caracteristici

* Implementat complet cu **YForm** : Toate caracteristicile și opțiunile de personalizare ale YForm sunt disponibile
* Simplu: ieșirea este prin [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) sau orientată pe obiecte prin [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexibil: filtrați întrebările și răspunsurile pe categorii
* Util: doar **roluri selectate**/editori au acces
* Motor de căutare optimizat: gata pentru formatul [JSON+LD](https://jsonld.com/question-and-answer/) și date structurate bazate pe schema.org
* Gata pentru mult mai mult: compatibil cu suplimentul [URL2](https://github.com/tbaddade/redaxo_url)

> **Sfat:** Suplimentul funcționează excelent împreună cu suplimentele [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Contribuiți cu propriile îmbunătățiri** la depozitul GitHub [qanda](https://github.com/alexplusde/qanda). Sau **susțin acest supliment:** Cu o comandă [sprijiniți dezvoltarea ulterioară a acestui supliment](https://github.com/sponsors/alexplusde)

## instalare

Descărcați și instalați addon-ul `qanda` în programul de instalare REDAXO. Apare apoi un nou element de meniu `Întrebări & Răspunsuri`.

## Utilizați în frontend

### exemplu de modul

```php
<h1>FAQ pagina</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    ecou '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Cele mai importante întrebări</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    ecou '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Clasa `qanda`

Tastați `rex_yform_manager_dataset`. Accesează tabelul `rex_qanda` cu întrebări și răspunsuri.

#### eșantion de ieșire

```php
$question = qanda::get(3); // întrebare cu id=3

// întrebare și răspuns
dump($question->getQuestion()); // Întrebarea
dump($question->getAuthor()); // autorul întrebării
dump($question->getAnswer()); // Răspuns ca HTML (dacă a fost specificat un editor)
dump($question->getAnswerAsPlaintext()); // Răspuns ca text în loc de HTML

// Categoria
dump($question->getCategory()); // Categorie pentru întrebare/răspuns cu id=3
dump($question->getCategories()); // Categorii pentru întrebare/răspuns cu id=3

// Alte metode
dump($question->getUrl()); // URL la pagina curentă cu eticheta `question-header-{id}
```

Mai multe metode la https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Clasa `qanda_category`

Tastați `rex_yform_manager_dataset`. Accesează tabelul `rex_qanda_category`.

#### Exemplu de ieșire dintr-o categorie

```php
dump(qanda_category::get(3)); // categorie cu id=3
dump(qanda_category::get(3)->getAllQuestions()); // Toate perechile întrebare-răspuns din categoria id=3
```

Mai multe metode la https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Utilizare în backend: introducerea de întrebări și răspunsuri.

### Tabelul ÎNTREBĂRI

Combinațiile individuale întrebare-răspuns sunt înregistrate în tabelul `rex_qanda`. După instalarea `qanda` , sunt disponibile următoarele câmpuri:

| Tip     | nume de tip          | Nume de familie     | desemnare                 |
| ------- | -------------------- | ------------------- | ------------------------- |
| valoare | text                 | întrebare           | întrebare                 |
| valida  | gol                  | întrebare           |                           |
| valoare | zona textului        | Răspuns             | Răspuns                   |
| valoare | fi_manager_relatie | qanda_category_id | categorie                 |
| valoare | Data stampilei       | data creata         | data crearii              |
| valoare | fi_utilizator        | updateuser          | Ultima modificare până la |
| valoare | fi_utilizator        | creaza utilizator   | autor                     |
| valoare | prioritate           | prioritate          | Serie                     |

Cele mai importante validări au fost deja introduse.

### Tabelul CATEGORII

Tabelul pentru categorii poate fi modificat liber pentru a grupa întrebări/răspunsuri sau la cuvinte cheie (ca etichete).

| Tip     | nume de tip | Nume de familie | desemnare |
| ------- | ----------- | --------------- | --------- |
| valoare | text        | Nume de familie | titlu     |
| valida  | unic        | Nume de familie |           |
| valida  | gol         | Nume de familie |           |
| valoare | alegere     | stare           | stare     |

## licență

Licență MIT

## autor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Conducător de proiect**  
[Alexander Walther](https://github.com/alexplusde)

## credite

qanda se bazează pe: [YForm](https://github.com/yakamara/redaxo_yform)  

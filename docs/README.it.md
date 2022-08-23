# FAQ / Domande e risposte per REDAXO 5.x & YForm 4.x

Con questo componente aggiuntivo è possibile inserire e gestire le aree delle FAQ e le domande generali & risposte. Gratuito per progetti non commerciali (CC BY-NC-SA 4.0). In caso di domande sulla licenza e sull'utilizzo, contattare qanda@alexplus.de.

![Logo GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## caratteristiche

* Completamente implementato con **YForm** : tutte le funzionalità e le opzioni di personalizzazione di YForm disponibili
* Semplice: l'uscita è tramite [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) o orientata agli oggetti tramite [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flessibile: filtra domande e risposte per categoria
* Utile: solo **ruoli selezionati**/editor hanno accesso
* Ottimizzato per i motori di ricerca: pronto per [JSON+LD formato](https://jsonld.com/question-and-answer/) e dati strutturati basati su schema.org
* Pronto per molto di più: compatibile con [URL2 addon](https://github.com/tbaddade/redaxo_url)

> **Suggerimento:** L'addon funziona benissimo insieme agli addon [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Contribuisci con i tuoi miglioramenti** al repository [qanda](https://github.com/alexplusde/qanda) GitHub. Oppure **supporta questo componente aggiuntivo:** Con un ordine [sostieni l'ulteriore sviluppo di questo componente aggiuntivo](https://github.com/sponsors/alexplusde)

## installazione

Scarica e installa l'addon `qanda` nel programma di installazione di REDAXO. Viene quindi visualizzata una nuova voce di menu `Domande & Risposte`.

## Utilizzare nel front-end

### modulo di esempio

```php
<h1>FAQ pagina</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    eco '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Le domande più importanti</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    eco '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### La classe `qanda`

Digitare `rex_yform_manager_dataset`. Accede alla tabella `rex_qanda` con domande e risposte.

#### uscita del campione

```php
$question = qanda::get(3); // domanda con id=3

// domanda e risposta
dump($question->getQuestion()); // Domanda
dump($question->getAuthor()); // autore della domanda
dump($question->getAnswer()); // Rispondi come HTML (se è stato fornito un editor)
dump($question->getAnswerAsPlaintext()); // Risposta come testo invece di HTML

// Categoria
dump($question->getCategory()); // Categoria per domanda/risposta con id=3
dump($question->getCategories()); // Categorie per la domanda/risposta con id=3

// Altri metodi
dump($question->getUrl()); // URL alla pagina corrente con etichetta `question-header-{id}
```

Altri metodi su https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### La classe `qanda_categoria`

Digitare `rex_yform_manager_dataset`. Accede alla tabella `rex_qanda_category`.

#### Esempio di output di una categoria

```php
dump(qanda_categoria::get(3)); // categoria con id=3
dump(qanda_category::get(3)->getAllQuestions()); // Tutte le coppie domanda-risposta della categoria id=3
```

Altri metodi su https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Utilizzo nel back-end: immissione di domande e risposte.

### La tabella DOMANDE

Le singole combinazioni domanda-risposta sono registrate nella tabella `rex_qanda`. Dopo aver installato `qanda` , sono disponibili i seguenti campi:

| Tipo        | digitare il nome          | Cognome              | designazione          |
| ----------- | ------------------------- | -------------------- | --------------------- |
| valore      | testo                     | domanda              | domanda               |
| convalidare | vuoto                     | domanda              |                       |
| valore      | area di testo             | Rispondere           | Rispondere            |
| valore      | essere_manager_relation | qanda_categoria_id | categoria             |
| valore      | il timbro della data      | Data di Creazione    | data di creazione     |
| valore      | essere_utente             | updateuser           | Ultima modifica entro |
| valore      | essere_utente             | creare un utente     | autore                |
| valore      | priorità                  | priorità             | Serie                 |

Le convalide più importanti sono già state inserite.

### La tabella CATEGORIE

La tabella per categorie può essere liberamente modificata per raggruppare domande/risposte o per parole chiave (come tag).

| Tipo        | digitare il nome | Cognome | designazione |
| ----------- | ---------------- | ------- | ------------ |
| valore      | testo            | Cognome | titolo       |
| convalidare | unico            | Cognome |              |
| convalidare | vuoto            | Cognome |              |
| valore      | scelta           | stato   | stato        |

## licenza

Licenza MIT

## autore

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Responsabile del progetto**  
[Alexander Walther](https://github.com/alexplusde)

## crediti

qanda si basa su: [YForm](https://github.com/yakamara/redaxo_yform)  

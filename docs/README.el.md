# FAQ / Ερωτήσεις και απαντήσεις για το REDAXO 5.x & YForm 4.x

Με αυτό το πρόσθετο, οι περιοχές συχνών ερωτήσεων καθώς και οι γενικές ερωτήσεις μπορούν να εισαχθούν και να διαχειριστούν & απαντήσεις. Δωρεάν για μη εμπορικά έργα (CC BY-NC-SA 4.0). Εάν έχετε οποιεσδήποτε ερωτήσεις σχετικά με την άδεια και τη χρήση, επικοινωνήστε με το qanda@alexplus.de.

![Λογότυπο GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## χαρακτηριστικά

* Πλήρως υλοποιημένο με **YForm** : Όλες οι δυνατότητες και οι επιλογές προσαρμογής του YForm είναι διαθέσιμες
* Απλό: Η έξοδος είναι μέσω [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) ή αντικειμενοστραφής μέσω [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Ευέλικτο: Φιλτράρετε ερωτήσεις και απαντήσεις ανά κατηγορία
* Χρήσιμο: Μόνο επιλεγμένοι **ρόλοι**/συντάκτες έχουν πρόσβαση
* Βελτιστοποιημένη μηχανή αναζήτησης: Έτοιμο για [JSON+LD μορφή](https://jsonld.com/question-and-answer/) και δομημένα δεδομένα με βάση το schema.org
* Έτοιμοι για πολλά περισσότερα: Συμβατό με το πρόσθετο [URL2](https://github.com/tbaddade/redaxo_url)

> **Συμβουλή:** Το πρόσθετο λειτουργεί τέλεια μαζί με τα πρόσθετα [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Συνεισφέρετε τις δικές σας βελτιώσεις** στο αποθετήριο [qanda](https://github.com/alexplusde/qanda) GitHub. Ή **υποστηρίζει αυτό το πρόσθετο:** Με μια παραγγελία [υποστηρίζετε την περαιτέρω ανάπτυξη αυτού του πρόσθετου](https://github.com/sponsors/alexplusde)

## εγκατάσταση

Κατεβάστε και εγκαταστήστε το πρόσθετο `qanda` στο πρόγραμμα εγκατάστασης REDAXO. Στη συνέχεια εμφανίζεται ένα νέο στοιχείο μενού `Ερωτήσεις & Απαντήσεις`.

## Χρήση στο μπροστινό μέρος

### παράδειγμα ενότητας

```php
<h1>Συχνές ερωτήσεις σελίδα</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() ως $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    ηχώ '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>Οι πιο σημαντικές ερωτήσεις</h3>
<?php
foreach (qanda::getAll() ως $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    ηχώ '<div class="answer">'.$question->getAnswer().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### Η κλάση `qanda`

Πληκτρολογήστε `rex_yform_manager_dataset`. Πρόσβαση στον πίνακα `rex_qanda` με ερωτήσεις και απαντήσεις.

#### εξόδου δείγματος

```php
$question = qanda::get(3); // ερώτηση με id=3

// ερώτηση και απάντηση
dump($question->getQuestion()); // Ερώτηση
dump($question->getAuthor()); // συγγραφέας της ερώτησης
dump($question->getAnswer()); // Απάντηση ως HTML (αν είχε καθοριστεί πρόγραμμα επεξεργασίας)
dump($question->getAnswerAsPlaintext()); // Απάντηση ως κείμενο αντί για HTML

// Κατηγορία
dump($question->getCategory()); // Κατηγορία για ερώτηση/απάντηση με id=3
dump($question->getCategories()); // Κατηγορίες για την ερώτηση/απάντηση με id=3

// Άλλες μέθοδοι
dump($question->getUrl()); // URL στην τρέχουσα σελίδα με την ετικέτα "question-{id}25".
```

Περισσότερες μέθοδοι στη διεύθυνση https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### Η κλάση `qanda_κατηγορία`

Πληκτρολογήστε `rex_yform_manager_dataset`. Πρόσβαση στον πίνακα `rex_qanda_category`.

#### Δείγμα εξόδου μιας κατηγορίας

```php
dump(qanda_category::get(3)); // κατηγορία με id=3
dump(qanda_category::get(3)->getAllQuestions()); // Όλα τα ζεύγη ερωτήσεων-απαντήσεων κατηγορίας id=3
```

Περισσότερες μέθοδοι στη διεύθυνση https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Χρήση στο backend: εισαγωγή ερωτήσεων και απαντήσεων.

### Ο πίνακας ΕΡΩΤΗΣΕΙΣ

Οι μεμονωμένοι συνδυασμοί ερωτήσεων και απαντήσεων καταγράφονται στον πίνακα `rex_qanda`. Μετά την εγκατάσταση του `qanda` , είναι διαθέσιμα τα ακόλουθα πεδία:

| Τύπος     | πληκτρολογήστε όνομα  | Επώνυμο                | ονομασία               |
| --------- | --------------------- | ---------------------- | ---------------------- |
| αξία      | κείμενο               | ερώτηση                | ερώτηση                |
| επικυρώνω | αδειάζω               | ερώτηση                |                        |
| αξία      | textarea              | απάντηση               | απάντηση               |
| αξία      | be_manager_relation | qanda_category_id    | κατηγορία              |
| αξία      | σφραγίδα ημερομηνίας  | ημερομηνία δημιουργίας | ημερομηνία δημιουργίας |
| αξία      | be_user               | χρήστη ενημέρωσης      | Τελευταία αλλαγή από   |
| αξία      | be_user               | Δημιουργός χρήστη      | συγγραφέας             |
| αξία      | προτεραιότητα         | προτεραιότητα          | Σειρά                  |

Οι πιο σημαντικές επικυρώσεις έχουν ήδη εισαχθεί.

### Ο πίνακας ΚΑΤΗΓΟΡΙΕΣ

Ο πίνακας για τις κατηγορίες μπορεί να τροποποιηθεί ελεύθερα σε ομαδικές ερωτήσεις/απαντήσεις ή σε λέξεις-κλειδιά (ως ετικέτες).

| Τύπος     | πληκτρολογήστε όνομα | Επώνυμο   | ονομασία  |
| --------- | -------------------- | --------- | --------- |
| αξία      | κείμενο              | Επώνυμο   | τίτλος    |
| επικυρώνω | μοναδικός            | Επώνυμο   |           |
| επικυρώνω | αδειάζω              | Επώνυμο   |           |
| αξία      | επιλογή              | κατάσταση | κατάσταση |

## άδεια

Άδεια MIT

## συγγραφέας

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Υπεύθυνος έργου**  
[Alexander Walther](https://github.com/alexplusde)

## πιστώσεις

Το qanda βασίζεται στο: [YForm](https://github.com/yakamara/redaxo_yform)  

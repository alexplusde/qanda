# FAQ / Questions et réponses pour REDAXO 5.x & YForm 4.x

Avec cet addon, les zones FAQ ainsi que les questions générales & réponses peuvent être saisies et gérées. Gratuit pour les projets non commerciaux (CC BY-NC-SA 4.0). Si vous avez des questions sur la licence et l'utilisation, veuillez contacter qanda@alexplus.de.

![Logo GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## Caractéristiques

* Entièrement implémenté avec **YForm** : Toutes les fonctionnalités et options de personnalisation de YForm disponibles
* Simple : la sortie est via [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) ou orientée objet via [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexible : filtrer les questions et les réponses par catégorie
* Utile : Seuls les rôles **sélectionnés**/éditeurs ont accès
* Optimisé pour les moteurs de recherche : Prêt pour le format [JSON+LD](https://jsonld.com/question-and-answer/) et les données structurées basées sur schema.org
* Prêt pour bien plus : Compatible avec [addon URL2](https://github.com/tbaddade/redaxo_url)

> **Astuce :** L'addon fonctionne très bien avec les addons [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Apportez vos propres améliorations** au référentiel [qanda](https://github.com/alexplusde/qanda) GitHub. Ou **soutenir cet addon :** Avec une commande [vous soutenez le développement ultérieur de cet addon](https://github.com/sponsors/alexplusde)

## installation

Téléchargez et installez l'addon `qanda` dans le programme d'installation de REDAXO. Un nouveau point de menu `Questions & Réponses`apparaît alors.

## Utilisation dans le frontend

### module d'exemple

```php
<h1>Page FAQ</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>' ;
    écho '<div class="answer">'.$question->getRéponse().'</div></details>' ;
}
?>
```

```php
<h3>Les questions les plus importantes</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>' ;
    écho '<div class="answer">'.$question->obtenirRéponse().'</div></details>' ;
    echo qanda::showJsonLd($question);
}
?>
```

### La classe `qanda`

Saisissez `rex_yform_manager_dataset`. Accède au tableau `rex_qanda` avec questions et réponses.

#### exemple de sortie

```php
$question = qanda::get(3); // question avec id=3

// question et réponse
dump($question->getQuestion()); // Question
dump($question->getAuthor()); // auteur de la question
dump($question->getAnswer()); // Réponse en HTML (si un éditeur a été spécifié)
dump($question->getAnswerAsPlaintext()); // Réponse sous forme de texte au lieu de HTML

// Catégorie
dump($question->getCategory()); // Catégorie pour question/réponse avec id=3
dump($question->getCategories()); // Catégories pour la question/réponse avec id=3

// Autres méthodes
dump($question->getUrl()); // URL vers la page actuelle avec le libellé `question-header-{id}
```

Plus de méthodes sur https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### La classe `qanda_category`

Saisissez `rex_yform_manager_dataset`. Accède à la table `rex_qanda_category`.

#### Exemple de sortie d'une catégorie

```php
dump(qanda_category::get(3)); // catégorie avec id=3
dump(qanda_category::get(3)->getAllQuestions()); // Toutes les paires question-réponse de catégorie id=3
```

Plus de méthodes sur https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Utilisation dans le backend : saisie des questions et réponses.

### Le tableau QUESTIONS

Les combinaisons question-réponse individuelles sont enregistrées dans le tableau `rex_qanda`. Après avoir installé `qanda` , les champs suivants sont disponibles :

| Taper   | tapez le nom            | Nom de famille              | la désignation            |
| ------- | ----------------------- | --------------------------- | ------------------------- |
| évaluer | texte                   | question                    | question                  |
| valider | vide                    | question                    |                           |
| évaluer | zone de texte           | réponse                     | réponse                   |
| évaluer | être_manager_relation | qanda_category_id         | Catégorie                 |
| évaluer | horodatage              | date de création            | date de création          |
| évaluer | be_user                 | mettre à jour l'utilisateur | Dernière modification par |
| évaluer | be_user                 | Créer un utilisateur        | auteur                    |
| évaluer | priorité                | priorité                    | Série                     |

Les validations les plus importantes ont déjà été insérées.

### Le tableau CATÉGORIES

Le tableau des catégories peut être librement modifié pour regrouper des questions/réponses ou des mots clés (comme des tags).

| Taper   | tapez le nom | Nom de famille | la désignation |
| ------- | ------------ | -------------- | -------------- |
| évaluer | texte        | Nom de famille | Titre          |
| valider | unique       | Nom de famille |                |
| valider | vide         | Nom de famille |                |
| évaluer | choix        | statut         | statut         |

## Licence

Licence MIT

## auteur

**Alexandre Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Chef de projet**  
[Alexander Walther](https://github.com/alexplusde)

## crédits

qanda est basé sur : [YForm](https://github.com/yakamara/redaxo_yform)  

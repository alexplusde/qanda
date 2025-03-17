<?php

class qanda extends rex_yform_manager_dataset
{
    /**
     * Gibt die erste Kategorie zurück.
     * Returns the first category.
     *
     * @return qanda_category|null
     *
     * Beispiel / Example:
     * $firstCategory = $question->getCategory();
     */
    public function getCategory(): ?qanda_category
    {
        return $this->getCategories()->first();
    }

    /**
     * Gibt alle Kategorien zurück.
     * Returns all categories.
     *
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $categories = $question->getCategories();
     */
    public function getCategories(): ?rex_yform_manager_collection
    {
        return $this->getRelatedCollection('category_ids');
    }

    /**
     * Gibt die Frage in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.
     * Returns the question in the specified language if available, otherwise in the default language.
     *
     * @param string|null $lang Die Sprache, in der die Frage zurückgegeben werden soll. / The language in which the question should be returned.
     * @return string
     *
     * Beispiel / Example:
     * $question = $question->getQuestion('de');
     */
    public function getQuestion(?string $lang = null): string
    {
        if ($lang) {
            return $this->getTranslation($lang)->getValue('question');
        }
        return $this->getValue('question');
    }

    /**
     * Findet Datensätze anhand ihrer IDs.
     * Finds records by their IDs.
     *
     * @param array $ids Ein Array von IDs. / An array of IDs.
     * @param float $status Der minimale Status der Datensätze. / The minimum status of the records.
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $records = MyClass::findByIds([1, 2, 3], 1.0);
     */
    public static function findByIds(array $ids, float $status = 1): ?rex_yform_manager_collection
    {
        $ids = implode(',', $ids);
        return self::query()->whereRaw('status >= ' . $status . ' AND FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    /**
     * Findet Datensätze anhand ihrer Kategorie-IDs.
     * Finds records by their category IDs.
     *
     * @param array $category_ids Ein Array von Kategorie-IDs. / An array of category IDs.
     * @param float $status Der minimale Status der Datensätze. / The minimum status of the records.
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $records = MyClass::findByCategoryIds([1, 2, 3], 1.0);
     */
    public static function findByCategoryIds(array $category_ids, float $status = 1): ?rex_yform_manager_collection
    {
        $ids = implode(',', $category_ids);
        return self::query()->whereRAW('status >= ' . $status . ' AND FIND_IN_SET(category_ids, "' . $ids . '")')->find();
    }

    /**
     * Gibt die Antwort in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.
     * Returns the answer in the specified language if available, otherwise in the default language.
     *
     * @param string|null $lang Die Sprache, in der die Antwort zurückgegeben werden soll. / The language in which the answer should be returned.
     * @return string
     *
     * Beispiel / Example:
     * $answer = $question->getAnswer('de');
     */
    public function getAnswer(?string $lang = null): string
    {
        if ($lang) {
            return $this->getTranslation($lang)->getValue('answer');
        }
        return $this->getValue('answer');
    }

    /**
     * Gibt die Antwort als reinen Text (ohne HTML-Tags) in der angegebenen Sprache zurück, falls vorhanden, sonst in der Standardsprache.
     * Returns the answer as plain text (without HTML tags) in the specified language if available, otherwise in the default language.
     *
     * @param string|null $lang Die Sprache, in der die Antwort zurückgegeben werden soll. / The language in which the answer should be returned.
     * @return string
     *
     * Beispiel / Example:
     * $plaintextAnswer = $question->getAnswerAsPlaintext('de');
     */
    public function getAnswerAsPlaintext(?string $lang = null): string
    {
        if ($lang) {
            return strip_tags($this->getTranslation($lang)->getValue('answer'));
        }
        return strip_tags($this->getValue('answer'));
    }

    /**
     * Gibt die Übersetzung in der angegebenen Sprache zurück, falls vorhanden, sonst die Sammlung aller Übersetzungen.
     * Returns the translation in the specified language if available, otherwise the collection of all translations.
     *
     * @param string|null $lang Die Sprache, in der die Übersetzung zurückgegeben werden soll. / The language in which the translation should be returned.
     * @return mixed
     *
     * Beispiel / Example:
     * $translation = $question->getTranslation('de');
     */
    public function getTranslation(?string $lang = null): mixed
    {
        if ($lang) {
            return qanda_lang::getTranslation($this->getId(), $lang);
        }
        return $this->getRelatedCollection('lang');
    }

    /**
     * Gibt den Autor zurück.
     * Returns the author.
     *
     * @return string
     *
     * Beispiel / Example:
     * $author = $question->getAuthor();
     */
    public function getAuthor(): string
    {
        return $this->getValue('author');
    }

    /**
     * Gibt die URL zurück, optional mit einem spezifischen Parameter.
     * Returns the URL, optionally with a specific parameter.
     *
     * @param string $param Der Parameter, der an die URL angehängt werden soll. / The parameter to be appended to the URL.
     * @return string
     *
     * Beispiel / Example:
     * $url = $question->getUrl('question-header-');
     */
    public function getUrl(string $param = 'question-header-'): string
    {
        if (rex_addon::get('yrewrite') && rex_addon::get('yrewrite')->isAvailable()) {
            $host = rex_yrewrite::getFullUrlByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId());
        } else {
            $host = rtrim(rex::getServer(), '/') . rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId());
        }

        return rtrim($host, '/') . '#' . $param . $this->getId();
    }

    /**
     * Gibt die JSON-LD-Darstellung einer Frage zurück.
     * Returns the JSON-LD representation of a question.
     *
     * @param int|rex_yform_manager_dataset $question Die Frage, die dargestellt werden soll. / The question to be represented.
     * @return string
     *
     * Beispiel / Example:
     * $jsonLd = MyClass::showJsonLd($question);
     */
    public static function showJsonLd(int|rex_yform_manager_dataset $question): string
    {
        $fragment = new rex_fragment();
        $fragment->setVar('question', $question);
        return $fragment->parse('qanda.json-ld.php');
    }

    /**
     * Gibt die JSON-LD-Darstellung einer FAQ-Seite zurück.
     * Returns the JSON-LD representation of an FAQ page.
     *
     * @param array|rex_yform_manager_collection $questions Die Fragen, die auf der Seite dargestellt werden sollen. / The questions to be represented on the page.
     * @return string
     *
     * Beispiel / Example:
     * $jsonLd = MyClass::showFAQPage($questions);
     */
    public static function showFAQPage(array|rex_yform_manager_collection $questions): string
    {
        $fragment = new rex_fragment();
        $fragment->setVar('questions', $questions);
        return $fragment->parse('FAQPage.json-ld.php');
    }

    /* Hilfsklasse für JSON-LD Fragmente */
    public static function htmlEncode($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    /* Hilfsklasse für JSON-LD Fragmente */
    public static function getJsonAuthor($question, $jsonOptions = 0)
    {
        return [
            '@type' => 'Person',
            'name' => json_encode($question->getAuthor(), $jsonOptions),
        ];
    }
}

<?php

class qanda extends \rex_yform_manager_dataset
{
    public function getCategory(): ?rex_yform_manager_dataset
    {
        return $this->getCategories()->first();
    }

    public function getCategories(): ?rex_yform_manager_collection
    {
        return $this->getRelatedCollection('category_ids');
    }

    public function getQuestion(string $lang = null): string
    {
        if ($lang) {
            return $this->getTranslation($lang)->getValue('question');
        }
        return $this->getValue('question');
    }

    public static function findByIds(array $ids, float $status = 1): ?rex_yform_manager_collection
    {
        $ids = implode(',', $ids);
        return self::query()->whereRaw('status >= ' . $status . ' AND FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    public static function findByCategoryIds(array $category_ids, float $status = 1):  ?rex_yform_manager_collection
    {
        $ids = implode(',', $category_ids);
        return self::query()->whereRAW('status >= ' . $status . ' AND FIND_IN_SET(category_ids, "' . $ids . '")')->find();
    }

    public function getAnswer(string $lang = null): string
    {
        if ($lang) {
            return $this->getTranslation($lang)->getValue('answer');
        }
        return $this->getValue('answer');
    }

    public function getAnswerAsPlaintext(string $lang = null): string
    {
        if ($lang) {
            return strip_tags($this->getTranslation($lang)->getValue('answer'));
        }
        return strip_tags($this->getValue('answer'));
    }

    public function getTranslation(string $lang = null): mixed
    {
        if ($lang) {
            return qanda_lang::getTranslation($this->getId(), $lang);
        }
        return $this->getRelatedCollection('lang');
    }

    public function getAuthor(): string
    {
        return $this->getValue('author');
    }

    public function getUrl(string $param = 'question-header-')  :string
    {
        if (rex_addon::get('yrewrite') && rex_addon::get('yrewrite')->isAvailable()) {
            $host = rex_yrewrite::getFullUrlByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId());
        } else {
            $host = rtrim(rex::getServer(), '/') . rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId());
        }

        return rtrim($host, '/') . '#' . $param . $this->getId();
    }

    public static function showJsonLd(int|rex_yform_manager_dataset $question) :string
    {
        $fragment = new rex_fragment();
        $fragment->setVar('question', $question);
        return $fragment->parse('qanda.json-ld.php');
    }

    public static function showFAQPage(array|rex_yform_manager_collection $questions) :string
    {
        $fragment = new rex_fragment();
        $fragment->setVar('questions', $questions);
        return $fragment->parse('FAQPage.json-ld.php');
    }
}

<?php

class qanda extends \rex_yform_manager_dataset
{
    public function getCategory()
    {
        return $this->getCategories()[0];
    }

    public function getCategories()
    {
        return $this->getRelatedCollection('category_ids');
    }

    public function getAnswerAsPlaintext(): string
    {
        return strip_tags($this->getValue('answer'));
    }

    public function getQuestion()
    {
        return $this->getValue('question');
    }

    public static function findByIds(array $ids, float $status = 1)
    {
        $ids = implode(',', $ids);
        return self::query()->whereRAW('FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    public static function findByCategoryIds(array $category_ids, float $status = 1)
    {
        $ids = implode(',', $category_ids);
        return self::query()->whereRAW('status >= ' . $status . ' AND FIND_IN_SET(category_ids, "' . $ids . '")')->find();
    }

    public function getAnswer()
    {
        return $this->getValue('answer');
    }

    public function getAuthor()
    {
        return $this->getValue('author');
    }

    public function getUrl($param = 'question-header-')
    {
        if (rex_addon::get('yrewrite') && rex_addon::get('yrewrite')->isAvailable()) {
            $host = rex_yrewrite::getFullUrlByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId());
        } else {
            $host = rtrim(rex::getServer(), '/') . rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId());
        }

        return rtrim($host, '/') . '#' . $param . $this->getId();
    }

    public static function showJsonLd($question)
    {
        $fragment = new rex_fragment();
        $fragment->setVar('question', $question);
        return $fragment->parse('qanda.json-ld.php');
    }

    public static function showFAQPage($questions)
    {
        $fragment = new rex_fragment();
        $fragment->setVar('questions', $questions);
        return $fragment->parse('FAQPage.json-ld.php');
    }
}

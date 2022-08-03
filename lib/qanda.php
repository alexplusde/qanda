<?php


class qanda extends \rex_yform_manager_dataset
{
    public function getCategory()
    {
        $this->category = $this->getRelatedDataset('category_ids');
        return $this->category;
    }
    public function getCategories()
    {
        return $this->getRelatedCollection('category_ids');
    }

    public function getAnswerAsPlaintext() :string
    {
        return strip_tags($this->getValue("answer"));
    }
    
    public function getQuestion()
    {
        return $this->getValue("question");
    }
    public function getAnswer()
    {
        return $this->getValue("answer");
    }
    public function getAuthor()
    {
        return $this->getValue("author");
    }
    public function getUrl($param = "question-header-")
    {
        if (rex_addon::get("yrewrite") && rex_addon::get("yrewrite")->isAvailable()) {
            $host = rex_yrewrite::getFullUrlByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId());
        } else {
            $host = rtrim(rex::getServer(),'/').rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId());
        }

        return rtrim($host,'/').'#'.$param. $this->getId();
    }
    public static function showJsonLd($question)
    {
        $fragment = new rex_fragment;
        $fragment->setVar("question", $question);
        return $fragment->parse('qanda.json-ld.php');
    }
    public static function showFAQPage($questions)
    {
        $fragment = new rex_fragment;
        $fragment->setVar("questions", $questions);
        return $fragment->parse('FAQPage.json-ld.php');
    }
}

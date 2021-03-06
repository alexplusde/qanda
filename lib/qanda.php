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
    public function getUrl()
    {
        return $this->getValue("url");
    }
    public function showJsonLd($question)
    {
        $fragment = new rex_fragment;
        $fragment->setVar("question", $question);
        return $fragment->parse('qanda.json-ld.php');
    }
}

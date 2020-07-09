<?php


class qanda extends \rex_yform_manager_dataset
{
    public function getCategory()
    {
        $this->category = $this->getRelatedDataset('qanda_category_id');
        return $this->category;
    }

    public function getAnswerAsPlaintext() :string
    {
        return strip_tags($this->getValue("question"));
    }
    
    public function getQuestion()
    {
        return $this->getValue("question");
    }
    public function getAnswer()
    {
        return $this->getValue("answer");
    }
}

<?php
class qanda_category extends \rex_yform_manager_dataset
{
    public function getName()
    {
        return $this->getValue("name");
    }

    public function getAllQuestions()
    {
        return qanda::query()->whereListContains('category_ids',$this->id)
            ->find();
    }
}

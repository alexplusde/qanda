<?php

class qanda_lang extends \rex_yform_manager_dataset
{
    public function getAnswerAsPlaintext(): string
    {
        return strip_tags($this->getValue('answer'));
    }

    public function getQuestion(): string
    {
        return $this->getValue('question');
    }

    public function getAnswer(): string
    {
        return $this->getValue('answer');
    }

    public static function getTranslation(int $question, string $lang): ?self
    {
        return self::query()->where('qanda_id', $question)->where('clang_id', $lang)->findOne();
    }
}

<?php

class qanda_lang extends \rex_yform_manager_dataset
{
    /**
     * Gibt die Antwort als reinen Text (ohne HTML-Tags) zurück.
     * Returns the answer as plain text (without HTML tags).
     *
     * @return string
     *
     * Beispiel / Example:
     * $plaintextAnswer = $qanda_lang->getAnswerAsPlaintext();
     */
    public function getAnswerAsPlaintext(): string
    {
        return strip_tags($this->getValue('answer'));
    }

    /**
     * Gibt die Frage zurück.
     * Returns the question.
     *
     * @return string
     *
     * Beispiel / Example:
     * $question = $qanda_lang->getQuestion();
     */
    public function getQuestion(): string
    {
        return $this->getValue('question');
    }

    /**
     * Gibt die Antwort zurück.
     * Returns the answer.
     *
     * @return string
     *
     * Beispiel / Example:
     * $answer = $qanda_lang->getAnswer();
     */
    public function getAnswer(): string
    {
        return $this->getValue('answer');
    }

    /**
     * Setzt den Wert für die Antwort.
     * Sets the value for the answer.
     *
     * @param string $answer Die Antwort, die gesetzt werden soll. / The answer to be set.
     *
     * Beispiel / Example:
     * $qanda_lang->setAnswer('This is the answer.');
     */
    public function setAnswer(string $answer): self
    {
        $this->setValue('answer', $answer);
        return $this;
    }

    /**
     * Setzt den Wert für die Frage.
     * Sets the value for the question.
     *
     * @param string $question Die Frage, die gesetzt werden soll. / The question to be set.
     *
     * Beispiel / Example:
     * $qanda_lang->setQuestion('What is the question?');
     */
    public function setQuestion(string $question): self
    {
        $this->setValue('question', $question);
        return $this;
    }

    /**
     * Gibt die Übersetzung für eine bestimmte Frage und Sprache zurück.
     * Returns the translation for a specific question and language.
     *
     * @param int $question Die ID der Frage. / The ID of the question.
     * @param string $lang Die ID der Sprache. / The ID of the language.
     * @return self|null
     *
     * Beispiel / Example:
     * $translation = qanda_lang::getTranslation(1, 'de');
     */
    public static function getTranslation(int $question, string $lang): ?self
    {
        return self::query()->where('qanda_id', $question)->where('clang_id', $lang)->findOne();
    }
}

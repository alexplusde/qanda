<?php

class qanda_category extends rex_yform_manager_dataset
{
    /**
     * Gibt den Namen der Kategorie zurück.
     * Returns the name of the category.
     *
     * @return string
     *
     * Beispiel / Example:
     * $name = $category->getName();
     */
    public function getName(): string
    {
        return $this->getValue('name');
    }

    /**
     * Findet Kategorien anhand ihrer IDs.
     * Finds categories by their IDs.
     *
     * @param array|string $ids Ein Array oder ein String von IDs. / An array or a string of IDs.
     * @param int $status Der minimale Status der Kategorien. / The minimum status of the categories.
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $categories = qanda_category::findByIds([1, 2, 3], 1);
     */
    public static function findByIds(array|string $ids, int $status = 1): ?rex_yform_manager_collection
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        return self::query()->whereRaw('status >= ' . $status . ' AND FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    /**
     * Findet Fragen, die zu dieser Kategorie gehören.
     * Finds questions that belong to this category.
     *
     * @param int $status Der minimale Status der Fragen. / The minimum status of the questions.
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $questions = $category->find(1);
     */
    public function find(int $status = 1): ?rex_yform_manager_collection
    {
        return qanda::query()->where('status', $status, '>=')->whereListContains('category_ids', $this->getId())->find();
    }

	
    /**
     * Findet alle Fragen, die zu dieser Kategorie gehören.
     * Finds all questions that belong to this category.
     *
     * @return rex_yform_manager_collection|null
     *
     * Beispiel / Example:
     * $questions = $category->getAllQuestions();
     */
	public function getAllQuestions()
    {
        return qanda::query()->where('status', 0, ">")->whereListContains('category_ids',$this->id)
            ->find();
    }
}

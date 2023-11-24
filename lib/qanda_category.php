<?php

class qanda_category extends \rex_yform_manager_dataset
{
    public function getName(): string
    {
        return $this->getValue('name');
    }

    public static function findByIds(array|string $ids, int $status = 1): ?rex_yform_manager_collection
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        return self::query()->whereRaw('status >= ' . $status . ' AND FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    public function find(int $status = 1): ?rex_yform_manager_collection
    {
        return qanda::query()->where('status', $status, '>=')->whereListContains('category_ids', $this->getId())->find();
    }
}

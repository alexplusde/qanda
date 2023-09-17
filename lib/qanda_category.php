<?php

class qanda_category extends \rex_yform_manager_dataset
{
    public function getName()
    {
        return $this->getValue('name');
    }

    public static function findByIds($ids, $status = 1)
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        return self::query()->whereRaw('status >= ' . $status . ' AND FIND_IN_SET(id, "' . $ids . '")')->find();
    }

    public function find($status = 1)
    {
        return qanda::query()->where('status', $status, '>=')->whereListContains('category_ids', $this->id)->find();
    }
}

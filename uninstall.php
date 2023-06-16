<?php

rex_config::removeNamespace('qanda');

if (rex_addon::get('yform')->isAvailable() && !rex::isSafeMode()) {
    rex_yform_manager_table_api::removeTable('rex_qanda');
    rex_yform_manager_table_api::removeTable('rex_qanda_category');
}

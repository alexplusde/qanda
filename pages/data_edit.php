<?php

$currentPage = rex_be_controller::getCurrentPageObject();
$wrapper = '';
if ($table_name = $currentPage->getItemAttr('table_name', '')) {
    if (!rex_request('table_name', 'string', '')) {
        $_REQUEST['table_name'] = $table_name;
    }

    if (true !== $currentPage->getItemAttr('show_title')) {
        rex_extension::register('YFORM_MANAGER_DATA_PAGE_HEADER', static function ($ep) {
            if ($ep->getParam('yform')->table->getTableName() !== $ep->getParam('table_name')) {
                return;
            }
            return '';
        }, rex_extension::EARLY, ['table_name' => $table_name]);
    }

    if ($wrapper = $currentPage->getItemAttr('wrapper_class', '')) {
        echo "<div class=\"$wrapper\">";
    }
}

include rex_path::plugin('yform', 'manager', 'pages/data_edit.php');

if ($wrapper) {
    echo '</div>';
}

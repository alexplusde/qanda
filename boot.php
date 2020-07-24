<?php

rex_yform_manager_dataset::setModelClass(
    'rex_qanda',
    qanda::class
);
rex_yform_manager_dataset::setModelClass(
    'rex_qanda_category',
    qanda_category::class
);

if (rex::isBackend() && rex_be_controller::getCurrentPage() == "qanda/qanda") {

    rex_extension::register('OUTPUT_FILTER', function(rex_extension_point $ep){
        $suchmuster = 'class="###qanda-settings-editor###"';
        $ersetzen = rex_config::get("qanda", "editor");
        $ep->setSubject(str_replace($suchmuster, $ersetzen, $ep->getSubject()));
    });
}
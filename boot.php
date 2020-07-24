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

// class="form-control cke5-editor" name="FORM[data_edit-rex_qanda][1]" id="yform-data_edit-rex_qanda-field-1" rows="10" data-lang="de" data-profile="across_inline"
// {"class":"form-control cke5-editor","data-lang":"de","data-profile":"across_inline"}
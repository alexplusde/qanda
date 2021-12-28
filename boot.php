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


    rex_extension::register('YFORM_DATA_LIST', function ($ep) {
        if ($ep->getParam('table')->getTableName()=="rex_qanda") {
            $list = $ep->getSubject();

            $list->setColumnFormat(
                'question', // Spalte, für die eine custom function aktiviert wird
                'custom', // festes Keyword

                function ($a) {

                    // Generierung des auszugebenden Werts unter Einbeziehung beliebiger anderer Spalten
                    // $a['value'] enthält den tatsächlichen Wert der Spalte
                    // $a['list']->getValue('xyz') gibt den Wert einer anderen Spalte ("xyz) zurück.
                    $_csrf_key = rex_yform_manager_table::get('rex_qanda')->getCSRFKey();
                    $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

                    $params = array();
                    $params['table_name'] = 'rex_qanda';
                    $params['rex_yform_manager_popup'] = '0';
                    $params['_csrf_token'] = $token['_csrf_token'];
                    $params['data_id'] = $a['list']->getValue('id');
                    $params['func'] = 'edit';
        
                    return '<a href="'.rex_url::backendPage('qanda/qanda', $params) .'">'. $a['value'].'</a>';
                }
            );
        }
    });

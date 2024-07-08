<?php

rex_yform_manager_dataset::setModelClass(
    'rex_qanda',
    qanda::class,
);
rex_yform_manager_dataset::setModelClass(
    'rex_qanda_category',
    qanda_category::class,
);
rex_yform_manager_dataset::setModelClass(
    'rex_qanda_lang',
    qanda_lang::class,
);

if (rex::isBackend() && 'qanda/qanda' == rex_be_controller::getCurrentPage()) {
    rex_extension::register('OUTPUT_FILTER', static function (rex_extension_point $ep) {
        $suchmuster = 'class="###qanda-settings-editor###"';
        $ersetzen = rex_config::get('qanda', 'editor');
        $ep->setSubject(str_replace($suchmuster, $ersetzen, $ep->getSubject()));
    });
}

rex_extension::register('YFORM_DATA_LIST', static function ($ep) {
    if ('rex_qanda' == $ep->getParam('table')->getTableName()) {
        $list = $ep->getSubject();

        $list->setColumnFormat(
            'question', // Spalte, für die eine custom function aktiviert wird
            'custom', // festes Keyword

            static function ($a) {
                // Generierung des auszugebenden Werts unter Einbeziehung beliebiger anderer Spalten
                // $a['value'] enthält den tatsächlichen Wert der Spalte
                // $a['list']->getValue('xyz') gibt den Wert einer anderen Spalte ("xyz") zurück.
                $_csrf_key = rex_yform_manager_table::get('rex_qanda')->getCSRFKey();
                $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

                $params = [];
                $params['table_name'] = 'rex_qanda';
                $params['rex_yform_manager_popup'] = '0';
                $params['_csrf_token'] = $token['_csrf_token'];
                $params['data_id'] = $a['list']->getValue('id');
                $params['func'] = 'edit';

                return '<a href="' . rex_url::backendPage('qanda/qanda', $params) . '">' . $a['value'] . '</a>';
            },
        );
    }
});

if (rex::isBackend()) {
    $addon = rex_addon::get('qanda');
    $pages = $addon->getProperty('pages');

    $_csrf_key = rex_yform_manager_table::get('rex_qanda')->getCSRFKey();
    $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

    $params = [];
    $params['table_name'] = 'rex_qanda'; // Tabellenname anpassen
    $params['rex_yform_manager_popup'] = '0';
    $params['_csrf_token'] = $token['_csrf_token'];
    $params['func'] = 'add';

    $pages['qanda']['title'] .= ' <a style="position: absolute; top: 0; right: 0; padding: 5px; margin: 8px 19px 8px 8px" href="' . rex_url::backendPage('qanda/qanda', $params) . '" class="label label-default pull-right">+</a>';
    $addon->setProperty('pages', $pages);
}

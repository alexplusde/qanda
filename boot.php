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

if (rex::isBackend() && rex_addon::get('qanda') && rex_addon::get('qanda')->isAvailable() && !rex::isSafeMode()) {
    $addon = rex_addon::get('qanda');
    $pages = $addon->getProperty('pages');

    if (!rex::getConsole()) {
        $_csrf_key = rex_yform_manager_table::get('rex_qanda')->getCSRFKey();

        $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

        $params = [];
        $params['table_name'] = 'rex_qanda'; // Tabellenname anpassen
        $params['rex_yform_manager_popup'] = '0';
        $params['_csrf_token'] = $token['_csrf_token'];
        $params['func'] = 'add';

        $href = rex_url::backendPage('qanda/entry', $params);

        $pages['qanda']['title'] .= ' <a class="label label-primary tex-primary" style="position: absolute; right: 18px; top: 10px; padding: 0.2em 0.6em 0.3em; border-radius: 3px; color: white; display: inline; width: auto;" href="' . $href . '">+</a>';
        $addon->setProperty('pages', $pages);
    }
}

<?php

$addon = rex_addon::get('qanda');
echo rex_view::title($addon->getProperty('page')['title']);
rex_be_controller::includeCurrentPageSubPath();

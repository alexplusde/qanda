<?php

$addon = rex_addon::get('qanda');

$form = rex_config_form::factory($addon->name);

$field = $form->addInputField('text', 'editor', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('qanda_editor'));
$field->setNotice('z.B. <code>class="form-control cke5-editor" data-lang="de" data-profile="default"</code>');

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('events_settings'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');

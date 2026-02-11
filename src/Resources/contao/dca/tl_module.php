<?php

declare(strict_types=1);

// Palette das modul type "ml_popup"

$GLOBALS['TL_DCA']['tl_module']['palettes']['ml_popup'] =
    '{title_legend},name,type;{config_legend},ml_popup_article,ml_popup_delay,ml_popup_cookie_name,ml_popup_cookie_days;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;';

// felder
$GLOBALS['TL_DCA']['tl_module']['fields']['ml_popup_article'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['ml_popup_article'],
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_article.title',
    'eval' => ['mandatory' => true, 'chosen' => true, 'tl_class' => 'w50'],
    'sql' => "int(10) unsigned NOT NULL default 0",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['ml_popup_delay'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['ml_popup_delay'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['rgxp' => 'natural', 'maxlength' => 5, 'tl_class' => 'w50'],
    'sql' => "int(10) unsigned NOT NULL default 0",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['ml_popup_cookie_name'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['ml_popup_cookie_name'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default 'ml_popup_seen'",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['ml_popup_cookie_days'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['ml_popup_cookie_days'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['rgxp' => 'natural', 'maxlength' => 5, 'tl_class' => 'w50'],
    'sql' => "int(10) unsigned NOT NULL default 30",
];

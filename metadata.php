<?php
/**
 * Metadata version
 */

use De\Swebhosting\Createorder\Controller\Admin\UserMain as UserMainExtended;
use OxidEsales\Eshop\Application\Controller\Admin\UserMain;

$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id' => 'swh-createorder',
    'title' => 'Admin order creation',
    'version' => '1.0.0.',
    'author' => 'Alexander Stehlik',
    'extend' => [UserMain::class => UserMainExtended::class],
    'controllers' => [],
    'templates' => [],
    'events' => [],
    'blocks' => [
        [
            'template' => 'user_main.tpl',
            'block' => 'admin_user_main_assign_groups',
            'file' => '/views/blocks/admin_user_main_assign_groups.tpl',
        ],
        [
            'template' => 'order_main.tpl',
            'block' => 'admin_order_main_form_details',
            'file' => '/views/blocks/admin_order_main_form_details.tpl',
        ],
    ],
    'settings' => [],
];

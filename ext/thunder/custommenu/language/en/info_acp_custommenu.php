<?php
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = [];
}

$lang = array_merge($lang, [
    'ACP_THUNDER_CUSTOMMENU_TITLE' => 'Thunder Custom Menu',
    'ACP_THUNDER_CUSTOMMENU_SETTINGS' => 'Menu settings',
    'ACP_THUNDER_CUSTOMMENU_EXPLAIN' => 'Configure the menu displayed below the prosilver header. This extension does not modify phpBB core files.',
    'ACP_THUNDER_CUSTOMMENU_ENABLED' => 'Enable menu',
    'ACP_THUNDER_CUSTOMMENU_BG' => 'Background color',
    'ACP_THUNDER_CUSTOMMENU_HOVER' => 'Hover color',
    'ACP_THUNDER_CUSTOMMENU_TEXT' => 'Text color',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_BG' => 'Dropdown background',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_HOVER' => 'Dropdown hover',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_TEXT' => 'Dropdown text',
    'ACP_THUNDER_CUSTOMMENU_SHOW_SEARCH' => 'Show Search in the bar',

    'ACP_THUNDER_CUSTOMMENU_HIDE_INDEX' => 'Hide the original forum index link',
    'ACP_THUNDER_CUSTOMMENU_SHOW_QUICK_LINKS' => 'Show Quick Links in the bar',
    'ACP_THUNDER_CUSTOMMENU_FA_ICONS' => 'Font Awesome icons',
    'ACP_THUNDER_CUSTOMMENU_MOVE_UP' => 'Move up',
    'ACP_THUNDER_CUSTOMMENU_MOVE_DOWN' => 'Move down',
    'ACP_THUNDER_CUSTOMMENU_REMOVE_MENU' => 'Remove menu',
    'ACP_THUNDER_CUSTOMMENU_ADD_SUBMENU' => 'Add submenu',
    'ACP_THUNDER_CUSTOMMENU_REMOVE_ITEM' => 'Remove item',
    'ACP_THUNDER_CUSTOMMENU_ADD_LINK_TO_MENU' => 'Add link to menu',
    'ACP_THUNDER_CUSTOMMENU_QUICK_LINKS_AUTO' => 'Original Quick Links • phpBB permissions preserved',
    'ACP_THUNDER_CUSTOMMENU_WIDTH' => 'Content width',
    'ACP_THUNDER_CUSTOMMENU_WIDTH_EXPLAIN' => 'Width of the menu bar.',
'ACP_THUNDER_CUSTOMMENU_HEIGHT' => 'Menu height',
'ACP_THUNDER_CUSTOMMENU_HEIGHT_EXPLAIN' => 'Height of the menu bar.',
    'ACP_THUNDER_CUSTOMMENU_MENU' => 'Menu JSON',
    'ACP_THUNDER_CUSTOMMENU_MENU_EXPLAIN' => 'Edit the JSON to add or remove links and dropdowns. Supported placeholders: {U_INDEX}, {U_SEARCH}, {U_SEARCH_NEW}, {U_SEARCH_UNANSWERED}.',
    'ACP_THUNDER_CUSTOMMENU_SAVED' => 'Thunder Custom Menu settings have been saved.',
    'ACP_THUNDER_CUSTOMMENU_INVALID_JSON' => 'The menu JSON is invalid. No changes were saved.',
    'ACP_THUNDER_CUSTOMMENU_POSITION' => 'Menu position',
    'ACP_THUNDER_CUSTOMMENU_POSITION_INTEGRATED' => 'Integrated at the bottom of the header/logo',
    'ACP_THUNDER_CUSTOMMENU_POSITION_SEPARATE' => 'Separate below the header',
    'ACP_THUNDER_CUSTOMMENU_COLORS' => 'Colors',
    'ACP_THUNDER_CUSTOMMENU_ITEMS' => 'Menu items',
    'ACP_THUNDER_CUSTOMMENU_ITEMS_EXPLAIN' => 'Add individual links or dropdown menus. Add as many links as you need without editing JSON.',
    'ACP_THUNDER_CUSTOMMENU_ADD_LINK' => '+ Create link',
    'ACP_THUNDER_CUSTOMMENU_ADD_MENU' => '+ Create dropdown menu',
    'ACP_THUNDER_CUSTOMMENU_TITLE_FIELD' => 'Item title',
]);

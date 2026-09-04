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
    'ACP_THUNDER_CUSTOMMENU_SETTINGS' => 'Impostazioni menu',
    'ACP_THUNDER_CUSTOMMENU_EXPLAIN' => 'Configura il menu visualizzato sotto l’header di prosilver. Questa estensione non modifica i file core di phpBB.',
    'ACP_THUNDER_CUSTOMMENU_ENABLED' => 'Abilita menu',
    'ACP_THUNDER_CUSTOMMENU_BG' => 'Colore sfondo',
    'ACP_THUNDER_CUSTOMMENU_HOVER' => 'Colore al passaggio',
    'ACP_THUNDER_CUSTOMMENU_TEXT' => 'Colore testo',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_BG' => 'Sfondo menu a tendina',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_HOVER' => 'Hover menu a tendina',
    'ACP_THUNDER_CUSTOMMENU_DROPDOWN_TEXT' => 'Testo menu a tendina',
    'ACP_THUNDER_CUSTOMMENU_SHOW_SEARCH' => 'Mostra Cerca nella barra',

    'ACP_THUNDER_CUSTOMMENU_SHOW_QUICK_LINKS' => 'Mostra i Collegamenti rapidi nella barra',
    'ACP_THUNDER_CUSTOMMENU_HIDE_INDEX' => 'Nascondi l’Indice originale del forum',
    'ACP_THUNDER_CUSTOMMENU_FA_ICONS' => 'Icone Font Awesome',
    'ACP_THUNDER_CUSTOMMENU_MOVE_UP' => 'Sposta su',
    'ACP_THUNDER_CUSTOMMENU_MOVE_DOWN' => 'Sposta giù',
    'ACP_THUNDER_CUSTOMMENU_REMOVE_MENU' => 'Rimuovi menu',
    'ACP_THUNDER_CUSTOMMENU_ADD_SUBMENU' => 'Aggiungi sottomenu',
    'ACP_THUNDER_CUSTOMMENU_REMOVE_ITEM' => 'Elimina voce',
    'ACP_THUNDER_CUSTOMMENU_ADD_LINK_TO_MENU' => 'Aggiungi link al menu',
    'ACP_THUNDER_CUSTOMMENU_QUICK_LINKS_AUTO' => 'Collegamenti rapidi originali • permessi phpBB mantenuti',
    'ACP_THUNDER_CUSTOMMENU_WIDTH' => 'Larghezza contenuto',
    'ACP_THUNDER_CUSTOMMENU_WIDTH_EXPLAIN' => 'Larghezza della barra del menu.',
'ACP_THUNDER_CUSTOMMENU_HEIGHT' => 'Altezza menu',
'ACP_THUNDER_CUSTOMMENU_HEIGHT_EXPLAIN' => 'Altezza della barra del menu.',
    'ACP_THUNDER_CUSTOMMENU_MENU' => 'JSON del menu',
    'ACP_THUNDER_CUSTOMMENU_MENU_EXPLAIN' => 'Modifica il JSON per aggiungere o rimuovere link e menu a tendina. Segnaposto: {U_INDEX}, {U_SEARCH}, {U_SEARCH_NEW}, {U_SEARCH_UNANSWERED}.',
    'ACP_THUNDER_CUSTOMMENU_SAVED' => 'Le impostazioni di Thunder Custom Menu sono state salvate.',
    'ACP_THUNDER_CUSTOMMENU_INVALID_JSON' => 'Il JSON del menu non è valido. Nessuna modifica è stata salvata.',
    'ACP_THUNDER_CUSTOMMENU_POSITION' => 'Posizione menu',
    'ACP_THUNDER_CUSTOMMENU_POSITION_INTEGRATED' => 'Integrato nella parte inferiore dell’header/logo',
    'ACP_THUNDER_CUSTOMMENU_POSITION_SEPARATE' => 'Separato sotto l’header',
    'ACP_THUNDER_CUSTOMMENU_COLORS' => 'Colori',
    'ACP_THUNDER_CUSTOMMENU_ITEMS' => 'Voci del menu',
    'ACP_THUNDER_CUSTOMMENU_ITEMS_EXPLAIN' => 'Aggiungi link singoli oppure menu a tendina. Puoi aggiungere tutti i link che vuoi senza modificare JSON.',
    'ACP_THUNDER_CUSTOMMENU_ADD_LINK' => '+ Crea link',
    'ACP_THUNDER_CUSTOMMENU_ADD_MENU' => '+ Crea menu a tendina',
    'ACP_THUNDER_CUSTOMMENU_TITLE_FIELD' => 'Titolo voce',
]);

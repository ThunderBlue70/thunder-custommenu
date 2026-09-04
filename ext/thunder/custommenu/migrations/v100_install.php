<?php
namespace thunder\custommenu\migrations;

class v100_install extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_enabled']);
    }

    public function update_data()
    {
        return [
            ['config.add', ['thunder_custommenu_enabled', 0]],
            ['config.add', ['thunder_custommenu_bg', '#222222']],
            ['config.add', ['thunder_custommenu_hover', '#444444']],
            ['config.add', ['thunder_custommenu_text', '#FFFFFF']],
            ['config.add', ['thunder_custommenu_width', 1100]],
            ['config_text.add', ['thunder_custommenu_menu', json_encode([
                ['title' => 'Home', 'url' => 'index.php', 'icon' => 'fa-home', 'target' => '_self'],
                ['title' => 'Forum', 'url' => '', 'icon' => 'fa-comments', 'target' => '_self', 'children' => [
                    ['title' => 'Cerca nel forum', 'url' => 'search.php', 'icon' => 'fa-search', 'target' => '_self'],
                    ['title' => 'Lista utenti', 'url' => 'memberlist.php', 'icon' => 'fa-users', 'target' => '_self'],
                    ['title' => 'phpBB', 'url' => 'https://www.phpbb.com/', 'icon' => 'fa-external-link', 'target' => '_blank'],
                ]],
                ['title' => 'Community', 'url' => '', 'icon' => 'fa-users', 'target' => '_self', 'children' => [
                    ['title' => 'Community', 'url' => 'memberlist.php', 'icon' => 'fa-users', 'target' => '_self'],
                    ['title' => 'phpBB', 'url' => 'https://www.phpbb.com/', 'icon' => 'fa-external-link', 'target' => '_blank'],
                ]],
            ], JSON_UNESCAPED_SLASHES)]],
            ['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_THUNDER_CUSTOMMENU_TITLE']],
            ['module.add', ['acp', 'ACP_THUNDER_CUSTOMMENU_TITLE', [
                'module_basename' => '\\thunder\\custommenu\\acp\\main_module',
                'modes' => ['settings'],
            ]]],
        ];
    }

    public function revert_data()
    {
        return [
            ['config_text.remove', ['thunder_custommenu_menu']],
            ['config.remove', ['thunder_custommenu_width']],
            ['config.remove', ['thunder_custommenu_text']],
            ['config.remove', ['thunder_custommenu_hover']],
            ['config.remove', ['thunder_custommenu_bg']],
            ['config.remove', ['thunder_custommenu_enabled']],
            ['module.remove', ['acp', 'ACP_THUNDER_CUSTOMMENU_TITLE', [
                'module_basename' => '\\thunder\\custommenu\\acp\\main_module',
                'modes' => ['settings'],
            ]]],
            ['module.remove', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_THUNDER_CUSTOMMENU_TITLE']],
        ];
    }
}
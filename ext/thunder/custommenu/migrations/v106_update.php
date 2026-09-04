<?php
namespace thunder\custommenu\migrations;

class v106_update extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_dropdown_bg']);
    }

    public function update_data()
    {
        return [
            ['config.add', ['thunder_custommenu_dropdown_bg', '#FFFFFF']],
            ['config.add', ['thunder_custommenu_dropdown_hover', '#EEF1F5']],
            ['config.add', ['thunder_custommenu_dropdown_text', '#333333']],
            ['config.add', ['thunder_custommenu_show_search', 0]],
        ];
    }

    public function revert_data()
    {
        return [
            ['config.remove', ['thunder_custommenu_show_search']],
            ['config.remove', ['thunder_custommenu_dropdown_text']],
            ['config.remove', ['thunder_custommenu_dropdown_hover']],
            ['config.remove', ['thunder_custommenu_dropdown_bg']],
        ];
    }
}

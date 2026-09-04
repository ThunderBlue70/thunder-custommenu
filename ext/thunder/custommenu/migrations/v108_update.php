<?php
namespace thunder\custommenu\migrations;

class v108_update extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_hide_index']);
    }

    public function update_data()
    {
        return [
            ['config.add', ['thunder_custommenu_hide_index', 0]],
        ];
    }

    public function revert_data()
    {
        return [
            ['config.remove', ['thunder_custommenu_hide_index']],
        ];
    }
}

<?php
namespace thunder\custommenu\migrations;

class v104_update extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_position']);
    }

    public function update_data()
    {
        return [
            ['config.add', ['thunder_custommenu_position', 'integrated']],
        ];
    }

    public function revert_data()
    {
        return [
            ['config.remove', ['thunder_custommenu_position']],
        ];
    }
}

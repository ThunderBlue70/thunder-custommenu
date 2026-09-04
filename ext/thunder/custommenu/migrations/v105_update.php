<?php
namespace thunder\custommenu\migrations;

class v105_update extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_height']);
    }

    public function update_data()
    {
        return [
            ['config.add', ['thunder_custommenu_height', 44]],
        ];
    }

    public function revert_data()
    {
        return [
            ['config.remove', ['thunder_custommenu_height']],
        ];
    }
}

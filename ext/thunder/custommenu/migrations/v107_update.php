<?php
namespace thunder\custommenu\migrations;

class v107_update extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['thunder_custommenu_show_quick_links']);
    }

    public function update_data()
    {
        return [
            ['custom', [[$this, 'ensure_search_config']]],
            ['config.add', ['thunder_custommenu_show_quick_links', 0]],
        ];
    }

    public function ensure_search_config()
    {
        if (!isset($this->config['thunder_custommenu_show_search']))
        {
            $this->config->set('thunder_custommenu_show_search', 0);
        }
    }

    public function revert_data()
    {
        return [
            ['config.remove', ['thunder_custommenu_show_quick_links']],
        ];
    }
}

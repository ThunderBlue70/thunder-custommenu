<?php
namespace thunder\custommenu\acp;

class main_info
{
    public function module()
    {
        return [
            'filename' => '\thunder\custommenu\acp\main_module',
            'title' => 'ACP_THUNDER_CUSTOMMENU_TITLE',
            'modes' => [
                'settings' => [
                    'title' => 'ACP_THUNDER_CUSTOMMENU_SETTINGS',
                    'auth' => 'ext_thunder/custommenu && acl_a_board',
                    'cat' => ['ACP_THUNDER_CUSTOMMENU_TITLE'],
                ],
            ],
        ];
    }
}

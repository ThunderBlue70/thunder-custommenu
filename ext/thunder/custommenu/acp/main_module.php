<?php
namespace thunder\custommenu\acp;

class main_module
{
    public $u_action;
    public $tpl_name;
    public $page_title;

    protected function normalize_menu_urls(array $menu)
    {
        $map = [
            '{U_INDEX}' => 'index.php',
            '{U_SEARCH}' => 'search.php',
            '{U_SEARCH_NEW}' => 'search.php?search_id=newposts',
            '{U_SEARCH_UNREAD}' => 'search.php?search_id=unreadposts',
            '{U_SEARCH_UNANSWERED}' => 'search.php?search_id=unanswered',
            '{U_SEARCH_ACTIVE_TOPICS}' => 'search.php?search_id=active_topics',
            '{U_SEARCH_SELF}' => 'search.php?search_id=egosearch',
            '{U_MEMBERLIST}' => 'memberlist.php',
            '{U_TEAM}' => 'memberlist.php?mode=team',
            '{U_MARK_FORUMS}' => 'index.php?mark=forums',
        ];

        $normalize = function ($items) use (&$normalize, $map) {
            $result = [];
            foreach ((array) $items as $item)
            {
                if (!is_array($item))
                {
                    continue;
                }
                if (isset($item['url']) && isset($map[$item['url']]))
                {
                    $item['url'] = $map[$item['url']];
                }
                if (!empty($item['children']) && is_array($item['children']))
                {
                    $item['children'] = $normalize($item['children']);
                }
                $result[] = $item;
            }
            return $result;
        };

        return $normalize($menu);
    }

    protected function default_menu()
    {
        return [
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
        ];
    }

    protected function quick_links($language)
    {
        return [
            ['id' => 'search_self', 'title' => $language->lang('SEARCH_SELF'), 'url' => 'search.php?search_id=egosearch', 'icon' => 'fa-file-o'],
            ['id' => 'search_new', 'title' => $language->lang('SEARCH_NEW'), 'url' => 'search.php?search_id=newposts', 'icon' => 'fa-file-o'],
            ['id' => 'search_unread', 'title' => $language->lang('SEARCH_UNREAD'), 'url' => 'search.php?search_id=unreadposts', 'icon' => 'fa-file-o'],
            ['id' => 'search_unanswered', 'title' => $language->lang('SEARCH_UNANSWERED'), 'url' => 'search.php?search_id=unanswered', 'icon' => 'fa-file-o'],
            ['id' => 'search_active', 'title' => $language->lang('SEARCH_ACTIVE_TOPICS'), 'url' => 'search.php?search_id=active_topics', 'icon' => 'fa-file-o'],
            ['id' => 'memberlist', 'title' => $language->lang('MEMBERLIST'), 'url' => 'memberlist.php', 'icon' => 'fa-users'],
            ['id' => 'team', 'title' => $language->lang('THE_TEAM'), 'url' => 'memberlist.php?mode=team', 'icon' => 'fa-shield'],
            ['id' => 'mark_forums', 'title' => $language->lang('MARK_FORUMS_READ'), 'url' => 'index.php?mark=forums', 'icon' => 'fa-check-square-o'],
        ];
    }

    protected function remove_quick_links(array $menu)
    {
        $clean = [];
        foreach ($menu as $item)
        {
            if (is_array($item) && ($item['type'] ?? '') === 'quicklinks')
            {
                continue;
            }
            $clean[] = $item;
        }
        return $clean;
    }

    protected function ensure_quick_links(array $menu, $language)
    {
        $quick = $this->quick_links($language);
        $quick_item = null;
        $quick_index = null;

        foreach ($menu as $index => $item)
        {
            if (is_array($item) && ($item['type'] ?? '') === 'quicklinks')
            {
                $quick_item = $item;
                $quick_index = $index;
                break;
            }
        }

        if ($quick_item === null)
        {
            $quick_item = [
                'type' => 'quicklinks',
                'title' => $language->lang('QUICK_LINKS'),
                'url' => '',
                'icon' => 'fa-bars',
                'target' => '_self',
                'children' => array_map(function ($link) { return array_merge($link, ['quicklink_id' => $link['id']]); }, $quick),
            ];
            $menu[] = $quick_item;
            return $menu;
        }

        $existing = [];
        foreach (($quick_item['children'] ?? []) as $child)
        {
            $id = $child['quicklink_id'] ?? $child['id'] ?? '';
            if ($id)
            {
                $existing[$id] = $child;
            }
        }

        $children = [];
        foreach (($quick_item['children'] ?? []) as $saved_child)
        {
            $id = $saved_child['quicklink_id'] ?? $saved_child['id'] ?? '';
            if ($id && isset($existing[$id]))
            {
                foreach ($quick as $link)
                {
                    if ($link['id'] === $id)
                    {
                        $children[] = array_merge($link, ['quicklink_id' => $id]);
                        break;
                    }
                }
                unset($existing[$id]);
            }
        }

        foreach ($quick as $link)
        {
            if (isset($existing[$link['id']]))
            {
                $children[] = array_merge($link, ['quicklink_id' => $link['id']]);
                unset($existing[$link['id']]);
            }
        }

        $quick_item['children'] = $children;
        $quick_item['title'] = $language->lang('QUICK_LINKS');
        $quick_item['type'] = 'quicklinks';
        $quick_item['icon'] = 'fa-bars';
        $menu[$quick_index] = $quick_item;

        return $menu;
    }

    protected function clean_menu_items(array $items)
    {
        $clean = [];
        foreach ($items as $item)
        {
            if (!is_array($item) || empty(trim((string) ($item['title'] ?? ''))))
            {
                continue;
            }

            $entry = [
                'title' => trim((string) $item['title']),
                'url' => trim((string) ($item['url'] ?? '')),
                'icon' => $this->icon($item['icon'] ?? ''),
                'target' => (($item['target'] ?? '_self') === '_blank') ? '_blank' : '_self',
            ];

            if (($item['type'] ?? '') === 'quicklinks')
            {
                $entry['type'] = 'quicklinks';
            }

            if (!empty($item['quicklink_id']))
            {
                $entry['quicklink_id'] = preg_replace('/[^a-z0-9_-]/i', '', (string) $item['quicklink_id']);
            }

            if (!empty($item['children']) && is_array($item['children']))
            {
                $entry['children'] = $this->clean_menu_items($item['children']);
                if (!$entry['children'])
                {
                    unset($entry['children']);
                }
            }

            $clean[] = $entry;
        }
        return $clean;
    }

    public function main($id, $mode)
    {
        global $config, $language, $request, $template, $phpbb_container;

        $config_text = $phpbb_container->get('config_text');
        $language->add_lang('info_acp_custommenu', 'thunder/custommenu');
        $this->tpl_name = 'acp_thunder_custommenu';
        $this->page_title = $language->lang('ACP_THUNDER_CUSTOMMENU_TITLE');

        add_form_key('thunder_custommenu_settings');

        if ($request->is_set_post('submit'))
        {
            if (!check_form_key('thunder_custommenu_settings'))
            {
                trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $posted_menu = $request->variable('thunder_custommenu_items', [], true);
            $menu_json = $request->variable('thunder_custommenu_menu', '', true);
            $menu = [];

            if (is_array($posted_menu) && $posted_menu)
            {
                $menu = $posted_menu;
            }
            elseif ($menu_json !== '')
            {
                $decoded = json_decode(stripslashes(html_entity_decode($menu_json, ENT_QUOTES, 'UTF-8')), true);
                if (is_array($decoded))
                {
                    $menu = $decoded;
                }
            }

            $menu = $this->normalize_menu_urls($menu);
            $clean_menu = $this->clean_menu_items($menu);

            $show_quick_links = $request->variable('thunder_custommenu_show_quick_links', 0);
            if ($show_quick_links)
            {
                $clean_menu = $this->ensure_quick_links($clean_menu, $language);
            }
            else
            {
                $clean_menu = $this->remove_quick_links($clean_menu);
            }

            $config->set('thunder_custommenu_enabled', $request->variable('thunder_custommenu_enabled', 0));
            $config->set('thunder_custommenu_bg', $this->color($request->variable('thunder_custommenu_bg', '#222222')));
            $config->set('thunder_custommenu_hover', $this->color($request->variable('thunder_custommenu_hover', '#444444')));
            $config->set('thunder_custommenu_text', $this->color($request->variable('thunder_custommenu_text', '#FFFFFF')));
            $config->set('thunder_custommenu_dropdown_bg', $this->color($request->variable('thunder_custommenu_dropdown_bg', '#FFFFFF')));
            $config->set('thunder_custommenu_dropdown_hover', $this->color($request->variable('thunder_custommenu_dropdown_hover', '#EEF1F5')));
            $config->set('thunder_custommenu_dropdown_text', $this->color($request->variable('thunder_custommenu_dropdown_text', '#333333')));
            $config->set('thunder_custommenu_show_search', $request->variable('thunder_custommenu_show_search', 0));
            $config->set('thunder_custommenu_show_quick_links', $show_quick_links);
            $config->set('thunder_custommenu_hide_index', $request->variable('thunder_custommenu_hide_index', 0));
            $config->set('thunder_custommenu_width', max(700, min(1600, $request->variable('thunder_custommenu_width', 1100))));
            $config->set('thunder_custommenu_height', max(32, min(80, $request->variable('thunder_custommenu_height', 44))));
            $position = $request->variable('thunder_custommenu_position', 'integrated');
            $config->set('thunder_custommenu_position', in_array($position, ['integrated', 'separate'], true) ? $position : 'integrated');
            $config_text->set('thunder_custommenu_menu', json_encode($clean_menu, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            trigger_error($language->lang('ACP_THUNDER_CUSTOMMENU_SAVED') . adm_back_link($this->u_action));
        }

        $menu = $config_text->get('thunder_custommenu_menu');
        $menu_array = json_decode($menu, true);
        if (!is_array($menu_array) || !$menu_array)
        {
            $menu_array = $this->default_menu();
        }
        else
        {
            $menu_array = $this->normalize_menu_urls($menu_array);
        }

        if (!empty($config['thunder_custommenu_show_quick_links']))
        {
            $menu_array = $this->ensure_quick_links($menu_array, $language);
        }
        else
        {
            $menu_array = $this->remove_quick_links($menu_array);
        }

        $template->assign_vars([
            'THUNDER_CUSTOMMENU_ENABLED' => (bool) $config['thunder_custommenu_enabled'],
            'THUNDER_CUSTOMMENU_BG' => $config['thunder_custommenu_bg'],
            'THUNDER_CUSTOMMENU_HOVER' => $config['thunder_custommenu_hover'],
            'THUNDER_CUSTOMMENU_TEXT' => $config['thunder_custommenu_text'],
            'THUNDER_CUSTOMMENU_DROPDOWN_BG' => $config['thunder_custommenu_dropdown_bg'] ?? '#FFFFFF',
            'THUNDER_CUSTOMMENU_DROPDOWN_HOVER' => $config['thunder_custommenu_dropdown_hover'] ?? '#EEF1F5',
            'THUNDER_CUSTOMMENU_DROPDOWN_TEXT' => $config['thunder_custommenu_dropdown_text'] ?? '#333333',
            'THUNDER_CUSTOMMENU_SHOW_SEARCH' => !empty($config['thunder_custommenu_show_search']),
            'THUNDER_CUSTOMMENU_SHOW_QUICK_LINKS' => !empty($config['thunder_custommenu_show_quick_links']),
            'THUNDER_CUSTOMMENU_HIDE_INDEX' => !empty($config['thunder_custommenu_hide_index']),
            'THUNDER_CUSTOMMENU_WIDTH' => (int) $config['thunder_custommenu_width'],
            'THUNDER_CUSTOMMENU_HEIGHT' => (int) ($config['thunder_custommenu_height'] ?? 44),
            'THUNDER_CUSTOMMENU_POSITION' => $config['thunder_custommenu_position'] ?? 'integrated',
            'THUNDER_CUSTOMMENU_MENU_JSON' => json_encode($menu_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),
            'U_ACTION' => $this->u_action,
        ]);
    }

    protected function icon($value)
    {
        $value = trim((string) $value);
        return preg_match('/^[a-z0-9_-]+(?:\s+[a-z0-9_-]+)*$/i', $value) ? $value : '';
    }

    protected function color($value)
    {
        return preg_match('/^#[0-9a-fA-F]{6}$/', $value) ? strtoupper($value) : '#222222';
    }
}

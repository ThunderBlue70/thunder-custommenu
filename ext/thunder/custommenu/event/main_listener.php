<?php
namespace thunder\custommenu\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\template\template;
use phpbb\user;
use phpbb\auth\auth;

class main_listener implements EventSubscriberInterface
{
    protected $config;
    protected $config_text;
    protected $template;
    protected $user;
    protected $auth;

    public function __construct(config $config, db_text $config_text, template $template, user $user, auth $auth)
    {
        $this->config = $config;
        $this->config_text = $config_text;
        $this->template = $template;
        $this->user = $user;
        $this->auth = $auth;
    }

    public static function getSubscribedEvents()
    {
        return ['core.page_header_after' => 'assign_menu_data'];
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

    protected function quick_links()
    {
        return [
            ['id' => 'search_self', 'title' => $this->user->lang('SEARCH_SELF'), 'icon' => 'fa-file-o'],
            ['id' => 'search_new', 'title' => $this->user->lang('SEARCH_NEW'), 'icon' => 'fa-file-o'],
            ['id' => 'search_unread', 'title' => $this->user->lang('SEARCH_UNREAD'), 'icon' => 'fa-file-o'],
            ['id' => 'search_unanswered', 'title' => $this->user->lang('SEARCH_UNANSWERED'), 'icon' => 'fa-file-o'],
            ['id' => 'search_active', 'title' => $this->user->lang('SEARCH_ACTIVE_TOPICS'), 'icon' => 'fa-file-o'],
            ['id' => 'memberlist', 'title' => $this->user->lang('MEMBERLIST'), 'icon' => 'fa-users'],
            ['id' => 'team', 'title' => $this->user->lang('THE_TEAM'), 'icon' => 'fa-shield'],
            ['id' => 'mark_forums', 'title' => $this->user->lang('MARK_FORUMS_READ'), 'icon' => 'fa-check-square-o'],
        ];
    }

    protected function quick_link_url($id)
    {
        global $phpbb_root_path, $phpEx;

        switch ($id)
        {
            case 'search_self':
                return append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch');
            case 'search_new':
                return append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts');
            case 'search_unread':
                return append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unreadposts');
            case 'search_unanswered':
                return append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unanswered');
            case 'search_active':
                return append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=active_topics');
            case 'memberlist':
                return append_sid("{$phpbb_root_path}memberlist.$phpEx");
            case 'team':
                return append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=team');
            case 'mark_forums':
                return append_sid("{$phpbb_root_path}index.$phpEx", 'hash=' . generate_link_hash('global') . '&mark=forums&mark_time=' . time());
        }

        return '';
    }

    protected function quick_link_allowed($id)
    {
        $search_enabled = !empty($this->config['load_search']) && $this->auth->acl_get('u_search') && $this->auth->acl_getf_global('f_search');

        switch ($id)
        {
            case 'search_self':
                return $search_enabled && !empty($this->user->data['is_registered']);
            case 'search_new':
                return $search_enabled && !empty($this->user->data['is_registered']);
            case 'search_unread':
                return $search_enabled && !empty($this->config['load_unreads_search']) && (!empty($this->config['load_anon_lastread']) || !empty($this->user->data['is_registered']));
            case 'search_unanswered':
            case 'search_active':
                return $search_enabled;
            case 'memberlist':
                return $this->auth->acl_get('u_viewprofile');
            case 'team':
                return $this->auth->acl_get('u_viewprofile');
            case 'mark_forums':
                return !empty($this->user->data['is_registered']) || !empty($this->config['load_anon_lastread']);
        }

        return false;
    }

    protected function build_quick_links($saved)
    {
        $available = [];
        foreach ($this->quick_links() as $link)
        {
            if (!$this->quick_link_allowed($link['id']))
            {
                continue;
            }

            $link['url'] = $this->quick_link_url($link['id']);
            if ($link['url'] === '')
            {
                continue;
            }
            $link['target'] = '_self';
            $available[$link['id']] = $link;
        }

        $ordered = [];
        if (is_array($saved))
        {
            foreach ($saved as $child)
            {
                $id = $child['quicklink_id'] ?? '';
                if ($id && isset($available[$id]) && !isset($ordered[$id]))
                {
                    $ordered[$id] = array_merge($available[$id], ['quicklink_id' => $id]);
                }
            }
        }

        foreach ($available as $id => $link)
        {
            if (!isset($ordered[$id]))
            {
                $ordered[$id] = array_merge($link, ['quicklink_id' => $id]);
            }
        }

        return array_values($ordered);
    }
    /*inizio test forum invisibili a ospiti e link non visibili*/
    protected function menu_link_allowed($url)
{
    $url = html_entity_decode((string) $url, ENT_QUOTES, 'UTF-8');

    if (strpos($url, 'viewforum.php?') !== false)
    {
        $query = [];
        parse_str(substr($url, strpos($url, '?') + 1), $query);

        if (isset($query['f']) && ctype_digit((string) $query['f']))
        {
            $forum_id = (int) $query['f'];

            return $forum_id > 0 && $this->auth->acl_get('f_list', $forum_id);
        }
    }

    return true;
}
/*fine test link menu invisibile ad utenti e ospiti*/
protected function filter_menu_permissions($menu)
{
    $filtered = [];

    foreach ($menu as $item)
    {
        if (!is_array($item))
        {
            continue;
        }

        if (!empty($item['children']) && is_array($item['children']))
        {
            $item['children'] = $this->filter_menu_permissions($item['children']);
        }

        if (!empty($item['url']) && !$this->menu_link_allowed($item['url']))
        {
            continue;
        }

        if (($item['url'] ?? '') === '' && isset($item['children']) && !$item['children'])
        {
            continue;
        }

        $filtered[] = $item;
    }

    return $filtered;
}

    public function assign_menu_data($event)
    {
        if (empty($this->config['thunder_custommenu_enabled']))
        {
            $this->template->assign_var('THUNDER_CUSTOMMENU_ENABLED', false);
            return;
        }

        $menu = json_decode($this->config_text->get('thunder_custommenu_menu'), true);
        if (!is_array($menu) || !$menu)
        {
            $menu = $this->default_menu();
        }

        if (!empty($this->config['thunder_custommenu_show_quick_links']))
        {
            $quick_index = null;
            $quick_saved = [];
            foreach ($menu as $index => $item)
            {
                if (is_array($item) && ($item['type'] ?? '') === 'quicklinks')
                {
                    $quick_index = $index;
                    $quick_saved = $item['children'] ?? [];
                    break;
                }
            }

            $quick_item = [
                'type' => 'quicklinks',
                'title' => $this->user->lang('QUICK_LINKS'),
                'url' => '',
                'icon' => 'fa-bars',
                'target' => '_self',
                'children' => $this->build_quick_links($quick_saved),
            ];

            if (!empty($quick_item['children']))
            {
                if ($quick_index === null)
                {
                    $menu[] = $quick_item;
                }
                else
                {
                    $menu[$quick_index] = $quick_item;
                }
            }
            elseif ($quick_index !== null)
            {
                array_splice($menu, $quick_index, 1);
            }
        }
        /*modifica link invisibile ad utenti*/
        $menu = $this->filter_menu_permissions($menu);
        /*fine modifica*/
        $this->template->assign_vars([
            'THUNDER_CUSTOMMENU_ENABLED' => true,
            'THUNDER_CUSTOMMENU_MENU' => $menu,
            'THUNDER_CUSTOMMENU_BG' => $this->safe_color($this->config['thunder_custommenu_bg']),
            'THUNDER_CUSTOMMENU_HOVER' => $this->safe_color($this->config['thunder_custommenu_hover']),
            'THUNDER_CUSTOMMENU_TEXT' => $this->safe_color($this->config['thunder_custommenu_text']),
            'THUNDER_CUSTOMMENU_DROPDOWN_BG' => $this->safe_color($this->config['thunder_custommenu_dropdown_bg'] ?? '#FFFFFF'),
            'THUNDER_CUSTOMMENU_DROPDOWN_HOVER' => $this->safe_color($this->config['thunder_custommenu_dropdown_hover'] ?? '#EEF1F5'),
            'THUNDER_CUSTOMMENU_DROPDOWN_TEXT' => $this->safe_color($this->config['thunder_custommenu_dropdown_text'] ?? '#333333'),
            'THUNDER_CUSTOMMENU_SHOW_SEARCH' => !empty($this->config['thunder_custommenu_show_search']),
            'THUNDER_CUSTOMMENU_SHOW_QUICK_LINKS' => !empty($this->config['thunder_custommenu_show_quick_links']),
            'THUNDER_CUSTOMMENU_WIDTH' => (int) $this->config['thunder_custommenu_width'],
            'THUNDER_CUSTOMMENU_HEIGHT' => (int) ($this->config['thunder_custommenu_height'] ?? 44),
            'THUNDER_CUSTOMMENU_POSITION' => $this->config['thunder_custommenu_position'] ?? 'integrated',
            'THUNDER_CUSTOMMENU_HIDE_INDEX' => !empty($this->config['thunder_custommenu_hide_index']),
        ]);
    }

    protected function safe_color($value)
    {
        $value = trim((string) $value);
        return preg_match('/^#[0-9a-fA-F]{6}$/', $value) ? $value : '#222222';
    }
}

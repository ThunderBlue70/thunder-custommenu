<?php
namespace thunder\custommenu;

class ext extends \phpbb\extension\base
{
    public function is_enableable()
    {
        return version_compare(PHP_VERSION, '7.2.0', '>=') &&
            defined('PHPBB_VERSION') &&
            phpbb_version_compare(PHPBB_VERSION, '3.3.0', '>=') &&
            phpbb_version_compare(PHPBB_VERSION, '3.4.0', '<');
    }
}
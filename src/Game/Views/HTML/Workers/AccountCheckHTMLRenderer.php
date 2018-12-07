<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace Game\Views\HTML\Workers;

use ArchFW\Controllers\Storage\SessionStorage;
use ArchFW\Views\Renderers\HTMLRenderer;
use Game\Controllers\Account;

/**
 * Class AccountCheckHTMLRenderer
 *
 * @package Game\Views\HTML\Workers
 */
abstract class AccountCheckHTMLRenderer extends HTMLRenderer
{

    /**
     * @return bool
     */
    protected function logged(): bool
    {
        if (SessionStorage::exist('User') and SessionStorage::get('User') instanceof Account) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array actual logged user data
     */
    protected function data(): array
    {
        return SessionStorage::get('User')->getUserData();
    }
}

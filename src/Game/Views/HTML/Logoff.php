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

namespace Game\Views\HTML;

use ArchFW\Controllers\Storage\SessionStorage;
use ArchFW\Views\Renderers\HTMLRenderer;
use function header;

/**
 * Class DefaultRenderer
 *
 * @package Game\Views\HTML
 */
final class Logoff extends HTMLRenderer
{
    public function __construct()
    {
        if (SessionStorage::exist('User')) {
            SessionStorage::set('User', null);
        }
        header('Location: /');
    }
}
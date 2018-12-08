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

/**
 * Created by PhpStorm.
 * User: Oskar Barcz
 * Date: 08.12.2018
 * Time: 10:55
 */

namespace Game\Controllers;


use ArchFW\Models\DatabaseFactory;

class Act
{
    private $database;

    public function __construct()
    {
        $this->database = DatabaseFactory::getInstance();
    }

    /**
     * @param int $actID
     * @return array
     */
    public function getActDetails(int $actID): array
    {
        $res = $this->database->get(
            'acts',
            [
                'actID',
                'name',
                'logoPath',
            ],
            [
                'actID[=]' => $actID,
            ]
        );
        return ($res) ? $res : [];
    }
}

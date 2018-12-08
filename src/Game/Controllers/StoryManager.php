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
 * Time: 08:50
 */

namespace Game\Controllers;

use ArchFW\Models\DatabaseFactory;

/**
 * Class StoryManager
 *
 * @package Game\Controllers
 */
class StoryManager
{
    private $Database;
    private $accountID;
    private $Choices;

    public function __construct(string $accountID)
    {
        $this->Database = DatabaseFactory::getInstance();
        $this->accountID = $accountID;
        $this->Choices = new Choices($this->accountID);
    }

    public function detectLink(): string
    {
        $progress = $this->Choices->getActualStep();

        if ($progress === null) {
            return '/startAct/1';
        } elseif ($progress === 'prolog') {

        } elseif ($progress === 'act1') {

        } elseif ($progress === 'act2') {

        } elseif ($progress === 'act3') {

        } elseif ($progress === 'epilog') {

        }
    }
}

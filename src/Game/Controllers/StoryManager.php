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

    /**
     * StoryManager constructor.
     *
     * @param string $accountID
     */
    public function __construct(string $accountID)
    {
        $this->Database = DatabaseFactory::getInstance();
        $this->accountID = $accountID;
        $this->Choices = new Choices($this->accountID);
    }

    /**
     * @param int $actID
     * @return string
     */
    public function initAct(int $actID): string
    {
        $this->Choices->setCurrentActID($actID);
        return $this->detectEndingFall($actID);
    }

    /**
     * @return string
     */
    public function detectLink(): string
    {
        $progress = $this->Choices->getCurrentActID();

        if ($progress === null) {
            return '/startAct/1';
        } elseif ($progress < 6 and $progress > 0) {
            return '/card/' . $this->Choices->getCurrentCardID();
        }
    }

    /**
     * @param int $actID
     * @return int|string
     */
    public function detectEndingFall(int $actID)
    {
        if ($actID === 1) {
            return '/card/10001';
        } elseif ($actID === 2) {
            return '/card/11001';
        } elseif ($actID === 3) {
            return '/card/12001';
        } elseif ($actID === 4) {
            return '/card/13001';
        } elseif ($actID === 5) {
            return '/card/14001';
        }
        return 1;
    }
}

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
 * Time: 10:17
 */

namespace Game\Controllers;


use ArchFW\Models\DatabaseFactory;

/**
 * Class Choices
 *
 * @package Game\Controllers
 */
class Choices
{
    private $database;

    private $relatedAccountID;

    public function __construct(int $accountID)
    {
        $this->database = DatabaseFactory::getInstance();
        $this->relatedAccountID = $accountID;
    }

    /**
     * @param int $cardID
     */
    public function updateLC(int $cardID): void
    {
        $this->database->update(
            'choices',
            [
                'currentCardID' => $cardID,
                'lastUpdate'    => date('Y-m-d H:i:s'),
            ],
            [
                'accountID[=]' => $this->relatedAccountID,
            ]
        );
    }

    /**
     * @return string
     */
    public function getActualStep(): ?string
    {
        return $this->database->get(
            'choices',
            [
                'actualStep',
            ],
            [
                'accountID[=]' => $this->relatedAccountID,
            ]
        )['actualStep'];
    }

    /**
     * @param string $stepName
     */
    public function setActualStep(string $stepName): void
    {
        $this->database->update(
            'choices',
            [
                'actualStep' => $stepName,
                'lastUpdate' => date('Y-m-d H:i:s'),
            ],
            [
                'accountID[=]' => $this->relatedAccountID,
            ]
        );
    }
}
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

namespace Game\Controllers;

use ArchFW\Models\DatabaseFactory;
use Game\Exceptions\CardNotFoundException;

/**
 * Class Card
 *
 * @package Game\Controllers
 */
class Card
{
    private $database;

    private $actID;

    /**
     * Card constructor.
     *
     * @param int $actID
     */
    public function __construct(int $actID)
    {
        $this->database = DatabaseFactory::getInstance();
        $this->actID = $actID;
    }

    /**
     * @param int $cardID
     * @return array
     * @throws CardNotFoundException
     */
    public function loadCard(int $cardID): array
    {
        $result = $this->database->get(
            'cards',
            [
                'cardID',
                'actID',
                'logicFlag',
                'content',
                'linksJSON',
            ],
            [
                'cardID[=]' => $cardID,
                'actID[=]'  => $this->actID,
            ]
        );
        if (!$result) {
            throw new CardNotFoundException("Card with ID {$cardID} in act {$this->actID} not found", 101);
        }

        $result['linksJSON'] = json_decode($result['linksJSON'], true);

        return $result;
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function newCard(array $data): bool
    {
        $database = DatabaseFactory::getInstance();
        $result = $database->insert(
            'cards',
            [
                'cardID'    => $data['cardID'],
                'actID'     => $data['actID'],
                'logicFlag' => false,
                'content'   => $data['content'],
                'linksJSON' => $data['linksJSON'],
                'active'    => true,
            ]
        );
        return $result ? true : false;
    }
}

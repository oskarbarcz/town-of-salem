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

use ArchFW\Controllers\Router;
use Game\Controllers\Card;
use Game\Controllers\Choices;
use Game\Exceptions\CardNotFoundException;
use Game\Views\HTML\Workers\AccountCheckHTMLRenderer;

/**
 * Class CardScreen
 *
 * @package Game\Views\HTML
 */
class CardScreen extends AccountCheckHTMLRenderer
{

    private $currentCard;

    private $Card;

    private $Choices;

    /**
     * CardScreen constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        parent::preventUnauthorised();
        $this->Card = new Card(1);
        $this->Choices = new Choices(parent::data()['accountID']);
        $this->assign();
        $cardData = $this->getCard();
        $this->Choices->updateLC($this->currentCard);

        echo parent::render(
            [
                'cardDetails' => $cardData,
            ]
        );
    }

    private function assign(): void
    {
        if ($cardID = Router::getNthURI(2)) {
            $this->currentCard = $cardID;
        }
    }

    /**
     * @return array
     */
    private function getCard(): array
    {
        try {
            return $this->Card->loadCard($this->currentCard);
        } catch (CardNotFoundException $e) {
            header("Location: /card-not-found?referrer={$this->currentCard}");
        }
        return [];
    }
}

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
use Game\Controllers\Act;
use Game\Controllers\StoryManager;
use Game\Views\HTML\Workers\AccountCheckHTMLRenderer;

/**
 * Class ActScreen
 *
 * @package Game\Views\HTML
 */
class ActScreen extends AccountCheckHTMLRenderer
{
    private $currentAct;

    /**
     * ActScreen constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        // authorize
        parent::preventUnauthorised();
        $this->assign();
        $StoryManager = new StoryManager(parent::data()['accountID']);
        $Act = new Act();
        $details = $Act->getActDetails($this->currentAct);
        $link = $StoryManager->initAct($details['actID']);


        echo parent::render(
            [
                'actDetails' => $details,
                'link'       => $link,
            ]
        );
    }

    /**
     * Asigns value
     */
    private function assign()
    {
        if ($act = Router::getNthURI(2)) {
            $this->currentAct = $act;
        } else {
            header('Location: /');
        }
    }
}

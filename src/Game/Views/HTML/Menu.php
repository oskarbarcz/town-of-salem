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

use Game\Controllers\StoryManager;
use Game\Views\HTML\Workers\AccountCheckHTMLRenderer;

/**
 * Class InitialScreen
 *
 * @package ArchFW\Views\HTMLViews
 */
final class Menu extends AccountCheckHTMLRenderer
{
    /**
     * Menu constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        $this->compose();
    }

    /**
     * Composes the answer
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function compose()
    {
        if (parent::logged()) {
            $StoryManager = new StoryManager(parent::data()['accountID']);

            echo parent::render(
                [
                    'userData' => parent::data(),
                    'button'   => [
                        'title' => 'Kontynuuj grę',
                        'link'  => $StoryManager->detectLink(),
                    ],
                ]
            );
        } else {
            echo parent::render(
                [
                    'button' => [
                        'title' => 'Zacznij grę',
                        'link'  => '/login-choose',
                    ],

                ]
            );
        }
    }
}

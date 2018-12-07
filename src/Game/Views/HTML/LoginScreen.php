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
use Game\Controllers\Account;
use Game\Exceptions\UserNotFoundException;
use Game\Views\HTML\Workers\AccountCheckHTMLRenderer;

/**
 * Class LoginScreen
 *
 * @package Game\Views\HTML
 */
final class LoginScreen extends AccountCheckHTMLRenderer
{
    private $failed;

    /**
     * LoginScreen constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        // redirect actually logged users
        if (parent::logged()) {
            header('Location: /');
        }

        // if user filled the form
        if (isset($_POST['login'], $_POST['password'])) {
            $this->catchLoginFail($_POST['login'], $_POST['password']);
        }
        // compose the request
        $this->compose();
    }

    /**
     * Catches login fail
     *
     * @param string $login
     * @param string $password
     */
    private function catchLoginFail(string $login, string $password)
    {
        try {
            $account = new Account($login, $password);

            SessionStorage::set('User', $account);
            $this->failed = false;

        } catch (UserNotFoundException $exc) {
            // set fail flag
            $this->failed = true;
        }
    }

    /**
     * Composing the response
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function compose(): void
    {
        if (is_null($this->failed)) {
            // show the form on first try
            echo parent::render([]);
        } elseif ($this->failed === true) {
            // render with error when entered wrong data
            echo parent::render(
                [
                    'error' => 'Niepoprawny login/hasło',
                ]
            );
        } elseif ($this->failed === false) {
            // head to mian screen on successfull login
            header('Location: /');
        }
    }
}

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


use ArchFW\Views\Renderers\HTMLRenderer;
use Game\Controllers\Account;
use Game\Exceptions\ValidateException;
use Game\Models\AccountData;

/**
 * Class RegisterScreen
 *
 * @package Game\Views\HTML
 */
class RegisterScreen extends HTMLRenderer
{
    /**
     * RegisterScreen constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        if (isset($_POST['login'], $_POST['password'])) {
            if ($_POST['password'] !== $_POST['repeated']) {
                echo parent::render(
                    [
                        'error' => 'Podane hasła nie są zgodne',
                    ]
                );
            } else {
                $this->handleForm($_POST['login'], $_POST['password']);
            }
        } else {
            echo parent::render([]);
        }

    }

    /**
     * @param string $login
     * @param string $password
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function handleForm(string $login, string $password)
    {
        try {
            $AccData = new AccountData($login, $password);
            Account::adaaqaqaqad($AccData);
            $errorMsg = 'Dodano użytkownika poprawnie';
        } catch (ValidateException $e) {
            $errorMsg = $e->getMessage();
        } finally {
            echo parent::render(
                [
                    'error' => $errorMsg,
                ]
            );
        }
    }
}

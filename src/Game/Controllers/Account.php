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
use Game\Exceptions\UserNotFoundException;
use Game\Models\AccountData;
use Medoo\Medoo;

/**
 * Class Account
 *
 * @package Game\Controllers
 */
class Account
{
    private $userData;

    /**
     * @var Medoo $database Holds database link
     */
    private $database;

    /**
     * Account constructor.
     *
     * @param string $login
     * @param string $password
     * @throws UserNotFoundException
     */
    public function __construct(string $login, string $password)
    {
        // create database link
        $this->database = DatabaseFactory::getInstance();
        // try to log user
        $this->userData = $this->log($login, $password);
    }

    /**
     * @param string $login
     * @param string $password
     * @return array
     * @throws UserNotFoundException
     */
    private function log(string $login, string $password): array
    {
        // query that checks login and password validity
        $result = $this->database->get(
            'accounts',
            [
                'accountID',
                'login',
                'registerTime',
            ],
            [
                'login[=]'    => $login,
                'password[=]' => $password,
                'active[=]'   => true,
            ]
        );
        // throw if user not found
        if (!$result) {
            throw new UserNotFoundException(
                "Someone tried to load profile with login [{$login}].",
                101
            );
        }
        $this->updateLLT();
        return $result;
    }

    /**
     * Updates last login time in database
     */
    private function updateLLT()
    {
        // query
        $this->database->update(
            'accounts',
            [
                'lastLoginTime' => date("Y-m-d H:i:s"),
            ]
        );
    }

    /**
     * Retrieves user data from object
     *
     * @return array|null
     */
    public function getUserData(): ?array
    {
        return ($this->userData) ? $this->userData : null;
    }

    /**
     * @param string $login
     * @return bool
     */
    public static function exists(string $login): bool
    {
        $database = DatabaseFactory::getInstance();
        return $database->has(
            'accounts',
            [
                'login[=]' => $login,
            ]
        );
    }

    public static function add(AccountData $Data): void
    {
        $database = DatabaseFactory::getInstance();
        $database->insert(
            'accounts',
            [
                'accountID'     => null,
                'login'         => $Data->getLogin(),
                'password'      => $Data->getPassword(),
                'lastLoginTime' => null,
                'registerTime'  => date('Y-m-d H:i:s'),
                '',
            ]
        );
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['userData'];
    }

    /**
     *
     */
    public function __wakeup()
    {
        $this->database = DatabaseFactory::getInstance();
    }
}

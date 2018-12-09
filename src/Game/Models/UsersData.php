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

namespace Game\Models;

use Game\Exceptions\ValidateException;

/**
 * Class UsersData
 *
 * @package Game\Models
 */
class UsersData
{
    private $login;

    private $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = hash('sha256', $password);
        $this->validate();
    }

    private function validate(): bool
    {
        // validate length
        if (strlen($this->login) < 3 and strlen($this->login) > 32) {
            throw new ValidateException('Login musi zawierać od 4 do 32 znaków.', 101);
        }
        return true;
    }
}

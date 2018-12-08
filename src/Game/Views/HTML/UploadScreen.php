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

/**
 * Class UploadScreen
 *
 * @package Game\Views\HTML
 */
class UploadScreen extends HTMLRenderer
{
    private $actID;

    public function __construct()
    {
        $this->actID = ($_GET['act']) ? $_GET['act'] : header('Location: /uploader-choose-act');
        if ($this->catchSubmit()) {
            $this->compose();
        }

        echo parent::render(
            [
                'actID' => $this->actID,
            ]
        );
    }

    private function catchSubmit()
    {
        if (isset($_POST['submitted']) and $_POST['submitted']) {
            return true;
        }
        return false;
    }

    private function compose()
    {
        $data['still'] = [

        ];
    }
}
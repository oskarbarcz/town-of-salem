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
use Game\Controllers\Card;

/**
 * Class UploadScreen
 *
 * @package Game\Views\HTML
 */
class UploadScreen extends HTMLRenderer
{
    private $actID;

    /**
     * UploadScreen constructor.
     *
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __construct()
    {
        $this->actID = ($_GET['act']) ? $_GET['act'] : header('Location: /uploader-choose-act');
        if ($this->catchSubmit()) {
            $data = $this->compose();
            if (Card::newCard($data)) {
                echo parent::render(
                    [
                        'actID' => $this->actID,
                        'error' => 'Dodano pomyślnie!',
                    ]
                );
            } else {
                echo parent::render(
                    [
                        'actID' => $this->actID,
                        'error' => 'Wystąpił jakiś błąd!',
                    ]
                );
            }
        } else {
            echo parent::render(
                [
                    'actID' => $this->actID,
                ]
            );
        }
    }

    private function catchSubmit()
    {
        if (isset($_POST['submitted']) and $_POST['submitted']) {
            return true;
        }
        return false;
    }

    private function compose(): array
    {
        $arr = [];
        foreach ($_POST['answer'] as $key => $value) {
            if (isset($_POST['to'][$key])) {
                $arr[] = [
                    'answerText' => $value,
                    'answerLink' => $_POST['to'][$key],
                ];
            }

        }
        $data = [
            'cardID'    => $_POST['cardID'],
            'actID'     => $_GET['act'],
            'content'   => $_POST['cardContent'],
            'linksJSON' => json_encode($arr),
        ];

        return $data;
    }
}
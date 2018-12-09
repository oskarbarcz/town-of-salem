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

use ArchFW\Application as Service;

/*
HERE IS A PART OF THE FILE YOU CAN AND SHOULD EDIT IF YOU CHANGED THE FRAMEWORK STRUCTURE

Enter fistly relative path to the folder containing configs.
 */
$configPath = '../config';
/*
Now enter relative path to the Composer sources autoloader (usually vendor/autoload.php)
 */
$vendor = '../vendor/autoload.php';
/*
Better do not edit the code below.
 */

try {
    // ENSURE CONFIG FILES PATH IS VALID
    if (!file_exists($configPath)) {
        throw new Exception('Config file wasn\'t found!', 2);
    }

    /*
    As far as you are using PHP older than 7.0.0 this framework won't start, because
    it uses functionality that were not implemented before.
     */
    if (version_compare(PHP_VERSION, '7.0.0') < 0) {
        throw new Exception('Unsupported PHP version, minimum: 7.0.0, yours: ' . PHP_VERSION, 4);
    }

    // ENSURE HAVING VENDOR FILES
    if (!file_exists($vendor)) {
        throw new Exception(
            'VENDOR files were not found, run \'composer install\'' .
            ' over main framework folder.',
            3
        );
    }
    // LOADING LIBS AND CLASSES
    include_once $vendor;
    new Service($configPath);
} catch (Exception $err) {
    // Catch the exceptions that came before running an app.
    http_response_code(500);
    exit('INIT ERROR ' . $err->getCode() . ': ' . $err->getMessage());
}



/*
    d888888b  .d88b.  db   d8b   db d8b   db       .d88b.  d88888b      .d8888.  .d8b.  db      d88888b .88b  d88.
    `~~88~~' .8P  Y8. 88   I8I   88 888o  88      .8P  Y8. 88'          88'  YP d8' `8b 88      88'     88'YbdP`88
       88    88    88 88   I8I   88 88V8o 88      88    88 88ooo        `8bo.   88ooo88 88      88ooooo 88  88  88
       88    88    88 Y8   I8I   88 88 V8o88      88    88 88~~~          `Y8b. 88~~~88 88      88~~~~~ 88  88  88
       88    `8b  d8' `8b d8'8b d8' 88  V888      `8b  d8' 88           db   8D 88   88 88booo. 88.     88  88  88
       YP     `Y88P'   `8b8' `8d8'  VP   V8P       `Y88P'  YP           `8888Y' YP   YP Y88888P Y88888P YP  YP  YP



MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMW0x0MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMkcdXMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMWWNXKK000000000KKKKKXXNNWWWWMMMMMMMMMMMMMMMMXOlxWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMWX0kdl:,',,,,,,,,,,','.',;;::clcccoddddxxxxxxkkkkkx:,x0KKNWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMM0lcclc.  'llooooolllc. .;cc::;;,''',,,;,;;;,,,,,,,,'.',,;:clodk0XWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMNdcddd:. .cddddddddddl. .ldddddolc:;,,'.':ccclllllllllccccccc::ccldxkKNMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMOclddo'  ,odddddddddd:. 'odddddddddoc;,,,;:lddddddddddddddddddddddoolcoxKWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMWxcdddc. .cddddddddddo,  'odddddddddddol;,,;,:lddddddddddddddddddddddddolcokXWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMXocddo,  ,oddddddddddl.  ,oddddddddddddddl;,,,,:odddddddddddddddddddddddddlcld0NMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMOcoddc. .:ddddddddddd:.  ;dddddddddddddddooc'.',,coddddddddddddddddddddddddddlcokNMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMXl.',;.  .cddddddddddo,   ;ddddddddddddlcclccc. .',;loddddddddddddddddddddddddddoclxXWMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMXd;'..'..''',,,;;:cloddo'   ;dddddddddddc:okOd:c;. .,;;;;cldddddddddddddddddddddddddolld0WMMMMMMMMMMMMMMMMMMMMMMMM
MMM0;..;,..'cxOkxdlc:::;;;;,.   ;odddddddddd:;oxkko;';, .;cc:;;;:clloddddddddddddddddddddddlcoONMMMMMMMMMMMMMMMMMMMMMM
MMWd..';,.   ,x0000000OOkxd:,;:;:ccc:::ccllol;;:ccol,;,  ,cccccc:,'..';:::cccccccccccccc:::::,,dXMMMMMMMMMMMMMMMMMMMMM
MMWd.,:;;',c:lk000OO0OOO00Oc.'',cxOkxdoollccc:;;;'.,lc. .;ccccccc,''...':::;;;;;;;;;;;:,';:::c:cKMMMMMMMMMMMMMMMMMMMMM
MMMO::ccc;oO00O0000000OO00Oc.   .d000OO000OOOkxddolcc:. .,;;;;;:;,;l:..':::::::::::::::;;;;;::;cxO0KNWMMMMMMMMMMMMMMMM
MMWk;;;,,,lO0O0OO000000000Oo;'.;dO00OO0O000OO00000000k:';;;;;,'';:ccccloooooooooooooooooooddxxkkxxddxxkOKWMMMMMMMMMMMM
MM0:'.    ,dOxooddxkOO0000Oo:;;dO0000000000OO000000OOo;:ccccccc:;::ccloodxkOO0000O00O0OO0000O0000000OOxddxxOKNMMMMMMMM
MMk'       .cl;.....',;:codlcxOO00000000000000000000Ol;ccccccccccccc::;;;::cclldxkO000OO0OOOOOOO000000000Okddxx0NMMMMM
MM0'        .ckkdolc;,'.......,;clodxkOO000000OO00O0Oc;cc:;;:ccccccccccccccc::;;::clodkO0000OOO0O0000000OO000Oxdd0MMMM
MMX:   .''.. .ldxOO00OOkxol,','.......';:cldxkOO0000kc;c:,'',cccccccccccccccccccc:;;;;:cldkOO0O0000000OOOO00000OokWMMM
MMWd. .';;,..  ..',:codkOO0dlxOkxdolc:;'......';:loxx:;cc::;;,'....';:cccccccccc;,;:;,::,:xxoxO0000000OOOOkkxdoc;oXMMM
MMWd  .,;;'.          ..',:;;lkOOO0000OOkkxolc:;,,,;c:;cc:..         ..',,;;;;;;'.,,'.,,cXMWx:loollc::;;,'....   .,xNM
MMM0,  .''.     .:lc;,'..    ..',;cldxkOO00O0000OOOkd::c,.                ........   ...'ldl,.....          .....  ,KM
MMMWO'         .lNMMWNNK0Okdoc;,..   ..';:codxkO0000d;:;.      .....       ........               .....:cloddxx,...oNM
MMMMWKo,..  ..;xNMMMMMMMMMMMMMWNX0kxoc;'..  ...,;:loc,;'      .',''...      ......                 ...,ddoolc:'...cXMM
MMMMMMMNK0000KNMMMMMMMMMMMMMMMMMMMMMMMWNKOxoc;'..     .      ...,:;;'..      ........                 ....       .xWMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWNKOxoc:'..    .,.,:::::,..     ...........       ...              .cXMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWNK0o.  .'',;:::c,'.      .........   ...  ...          ..'ckNMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMXc   .,'';;;,''.      ..........      ............':lxKWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMK:.  ...''.''.     'dkdl:,''........'''''',:loxk0XWMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMXOl.   ....      ,OWMMMWNXXKKKKKKKKXXXXXXNWMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMW0o;.......':lkXMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWNXXXXXXNWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
 */

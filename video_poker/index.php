<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 2/23/2017
 * Time: 10:24 PM
 */
require_once('includes/poker_constants.php');
require_once('includes/poker_code.php');
require_once('includes/page_constants.php');
require_once('includes/utilities.php');
require_once('includes/login_constants.php');

require_secure();
session_start();
require_login();

header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");

$deck = make_deck();
$hand = deal($deck);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Video Poker</title>
        <link rel="stylesheet" type="text/css" href="includes/poker.css.php">
        <script src="includes/poker.js.php"></script>
    </head>
        <body onload="javascript:init();">
        <?php show_user(); ?>
        <div id="spacer"></div>
            <?php show_content($hand); ?>
        <?php output_form($hand, $deck); ?>

        </body>
</html>

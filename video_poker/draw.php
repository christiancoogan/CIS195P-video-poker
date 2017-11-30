<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 2/23/2017
 * Time: 11:10 PM
 */
require_once('includes/poker_constants.php');
require_once('includes/poker_code.php');
require_once('includes/page_constants.php');
require_once('includes/utilities.php');
require_once('includes/login_constants.php');
require_once('includes/hand_type.php');

require_secure();
session_start();
require_login();

$deck = get_session_value(DECK_KEY);
$hand = get_session_value(HAND_KEY);

draw_cards($hand, $deck);

//$hand = [ [12,0], [12, 1], [12, 2], [12, 3], [8, 0]];

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
<?php show_content($hand, TRUE); ?>
<a href="index.php"><?php show_redraw_button(); ?></a>
</body>
</html>
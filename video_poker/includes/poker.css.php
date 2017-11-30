<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 2/23/2017
 * Time: 10:21 PM
 */
header('Content-Type: text/css');
require_once('poker_constants.php');
?>
a:link, a:visited {
    text-decoration: none;
}

.card_img {
    max-width: <?php echo CARD_IMAGE_PERCENT; ?>;
    max-height: <?php echo CARD_IMAGE_PERCENT; ?>;
    cursor: pointer;

}

.card {
    text-align:center;
    display: inline-block;
    max-width: <?php echo 100 / HAND_CARDS; ?>%;
    max-height: 100%;
}
#hand {
    font-size: 0px;
    padding: <?php echo HAND_PADDING; ?>;
}
#info {
    text-align: center;
    padding: <?php echo HAND_PADDING; ?>;
    margin-bottom:10px;
}
#draw_button {
    background-color:red;
    color:white;
    <?php echo POKER_FONT; ?>
    border-radius: 10px;
    cursor: pointer;
}
#redraw_button {
    background-color:green;
    color:white;
    <?php echo POKER_FONT; ?>
    border-radius: 10px;
    cursor: pointer;
}

#hand_type {
    <?php echo POKER_FONT; ?>
}

#content {
    visibility: hidden;
}

#payoff {
    <?php echo POKER_FONT; ?>
}
#user_pane {
    text-align: right;
}
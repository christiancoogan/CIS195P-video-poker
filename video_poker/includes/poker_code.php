<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 2/23/2017
 * Time: 10:23 PM
 */

function make_deck() {
    $deck = [];
    for($rank = 0; $rank < RANK_COUNT; $rank++) {
        for($suit = 0; $suit < SUIT_COUNT; $suit++) {
            $deck[] = [$rank, $suit];
        }
    }
    shuffle($deck);
    return $deck;
}

function deal(&$deck) {
    if (get_session_value(FINAL_KEY) === '' || get_session_value(FINAL_KEY)) {
        $hand = array_slice($deck, 0, HAND_CARDS);
        $deck = array_slice($deck, HAND_CARDS);
        set_session_value(HAND_KEY, $hand);
        set_session_value(DECK_KEY, $deck);
        set_session_value(FINAL_KEY, FALSE);
        set_session_value(HANDS_PLAYED_KEY, (get_session_value(HANDS_PLAYED_KEY) + 1));
        set_session_value(BALANCE_KEY, (get_session_value(BALANCE_KEY) - 1));
        return $hand;
    }
    $hand = get_session_value(HAND_KEY);
    $deck = get_session_value(DECK_KEY);
    return $hand;
}

function card_name($card) {
    return IMAGES . RANK_NAMES[$card[RANK_FIELD]] . '_of_' . SUIT_NAMES[$card[SUIT_FIELD]] . '.png';
}

function show_user() {
    $balance = get_session_value(BALANCE_KEY);
    $hands = get_session_value(HANDS_PLAYED_KEY);
    if ($hands !== "" && $hands !== 0) {
        $ev = number_format($balance / $hands, 4);
    } else {
        $ev = 'unknown';
    }

    echo '<div id="user_pane">' . "\n";
    echo '    ' . get_session_value(SESSION_USERNAME_KEY) . ' [<a href="' . LOGOUT_PAGE . '">LOGOUT</a>]' . "<br>\n";
    echo '    Balance: ' , $balance .  "<br>\n";
    echo '    Hands Played: ' , $hands .  "<br>\n";
    echo '    Expected Return: ' . $ev . ' units/hand' . "\n";
    echo '</div>' . "\n";
}

function show_card($card, $id) {
    echo '        <div class="card">' . "\n";
    echo '            <img class="card_img"';
    echo '            '. CARD_ID . '="' . $id .'"';
    echo '            src="' . card_name($card) . '"';
    echo '            ' . CARD_SRC . '="' . card_name($card) . '"';
    echo '            >' . "\n";
    echo '        </div>' . "\n";
}

function show_hand($hand) {
    echo '<div id="hand">' . "\n";
    for ($card = 0; $card < HAND_CARDS; $card++) {
        show_card($hand[$card], $card);
    }
    echo '</div>' . "\n";
}

function show_draw_button() {
    echo '    <div id="info">' . "\n";
    echo '       <span id="draw_button">Draw</span>' . "\n";
    echo '    </div>' . "\n";
}
function show_redraw_button() {
    echo '    <div id="info">' . "\n";
    echo '       <span id="redraw_button">Redraw</span>' . "\n";
    echo '    </div>' . "\n";
}

function show_type($hand) {
    $type = hand_type($hand);
    $payoffs = PAYOFFS;
    $payoff = $payoffs[$type];

    echo '    <div id="info">' . "\n";
    echo '       <span id="hand_type">' . $type .' &mdash; </span>' . "\n";
    echo '       <span id="payoff" style="color: ' . ($payoff > 0 ? "green" : "red") . '">Payoff: ' . $payoff .'</span>' . "\n";
    echo '    </div>' . "\n";
}

function show_content($hand, $final=FALSE) {
    echo '<div id="content">' . "\n";
    show_hand($hand);
    if($final) {
        show_type($hand);
    } else {
        show_draw_button();
    }
    echo '</div>' . "\n";
}

function output_form($hand, $deck) {
    echo '<form method ="POST" action="draw.php" id="draw_form">' . "\n";
    for($card = 0; $card < HAND_CARDS; $card++) {
        echo '    <input type="hidden" name="' . CARD_KEY . $card . '" id="' . CARD_KEY . $card . '" value="' . KEEP . '">' . "\n";
    }
    echo '</form>' . "\n";
}

function draw_cards(&$hand, &$deck) {
    if (get_session_value(FINAL_KEY)) {
        return;
    }
    for($card =0; $card < HAND_CARDS; $card++) {
        $draw = $_POST[CARD_KEY . $card];
        if ($draw === DRAW) {
            $hand[$card] = $deck[0];
            $deck = array_slice($deck, 1);
        }
    }
    $type = hand_type($hand);
    set_session_value(BALANCE_KEY, get_session_value(BALANCE_KEY) +PAYOFFS[$type]);
    set_session_value(HAND_KEY, $hand);
    set_session_value(DECK_KEY, $deck);
    set_session_value(FINAL_KEY, TRUE);
}
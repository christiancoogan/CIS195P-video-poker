<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 3/9/2017
 * Time: 11:02 PM
 */
require_once('includes/utilities.php');
require_once('includes/page_constants.php');

session_start();
destroy_session();
header('Location: ' . LOGIN_PAGE);

?>
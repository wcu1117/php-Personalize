<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/2/2016
 * Time: 5:07 PM
 */
require_once('bookmark_fns.php');
do_html_header('Resetting password');

//creating short variable name
$username = $_POST['username'];

try {
    $password = reset_password($username);
    notify_password($username,$password);
    echo 'Your new password has been be emailed to you.<br/>';
}
catch (Exception $e){
    echo 'Your password could not be reset';
}
do_html_url('login.php','Login');
do_html_footer();

?>
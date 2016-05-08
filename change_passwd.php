<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/2/2016
 * Time: 4:16 PM
 */
//create short variable
require_once ('bookmark_fns.php');
session_start();
do_html_header('Changing password');

//create short variable names
$old_passwd = $_POST['old_passwd'];
$new_passwd = $_POST['new_passwd'];
$new_passwd2 = $_POST['new_passwd2'];

try{
    check_valid_user();
    if(!filled_out($_POST)){
        throw new Exception('you have not filled the form');
    }
    if($new_passwd != $new_passwd2){
        throw new Exception('you have not filled the PASSWORD');
    }
    //check password length is ok
    if((strlen($passwd) <6 ) || (strlen($passwd) > 16)){
        throw new Exception('your passwd must between 6 and 16,please go back!');
    }

    //attempt update
    change_password($_SESSION['valid_user'],$sold_passwd,$new_passwd);
    echo 'password changed';
}
catch (Exception $e){
    echo $e->getMessage();
}
display_user_menu();
do_html_footer();
?>
<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/2/2016
 * Time: 2:01 PM
 */
//include function file for this application
require_once ('bookmark_fns.php');

//create short variable names
$email=$_POST['email'];
$username=$_POST['username'];
$passwd=$_POST['passwd'];
$passwd2=$_POST['passwd2'];

//start session which may be needed later
//start it now,cause it must go before header
session_start();
try{
    //check forms filled in
    if(!filled_out($_POST)){
        throw new Exception('you have not filled the form out correctly,please go back!');
    }

    //email address not vaild
    if(!vaild_email($email)){
        throw new Exception('you have not filled the email out correctly,please go back!');
    }
    //password not same
    if($passwd!=$passwd2){
        throw new Exception('you have not filled the password out correctly,please go back!');
    }
    //check password length is ok
    if((strlen($passwd) <6 ) || (strlen($passwd) > 16)){
        throw new Exception('your passwd must between 6 and 16,please go back!');
    }

    //attempt to register
    //this function can also throw na exception
    register($username,$email,$passwd);

    //register session variable
    $_SESSION['valid_user'] = $username;

    //procide link to member page
    do_html_header('Registration successful');
    echo 'Your registration was successful.go to the member page to start setting up your bookmarks!';
    do_html_url('member.php','go to member page');

    //end page
    do_html_footer();
}
catch (Exception $e){
    do_html_header('problem');
    echo $e->getMessage();
    do_html_footer();
    exit;
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/8/2016
 * Time: 9:59 PM
    包含login.php里面的函数
 */
function do_html_header($title){
//print an html header
?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, Helvrtica, sans-serif;
            font-size: 13px;
        }

        li, td {
            font-family：Arial, Helvrtica, sans-self;
            font-size: 13px;
        }

        hr {
            color: #3333cc;
            width: 300px;
            text-align: left;
        }

        a {
            color: #000000;
        }
    </style>
</head>
<body>
<h1>PHPbookmark</h1>
<hr/>
<?php

}

function display_login_form(){

    ?>
    <a href="register_form.php">Not a member?</a>
    <form action="login.php" method="post">
    <p>Username<input name="username" type="text" size="13px"> </p>
    <p>Password<input name="passwd" type="text" size="13px"></p>
    <input type="submit" value="Login">
    </form>
<?php
}
function do_html_footer(){
    ?>
    </body>
    </html>
<?php
}

function do_html_url($url,$action){
    ?>
    <a href="<?php
    $url
    ?>">
        <?php
        $action
        ?>
    </a>
<?php

}

function display_registration_form(){
    ?>
    <form action="register_new.php" method="post">
    <p>Email Address:<input type="text" name="email" size="20px"></p>
    <p>Username:<input type="text" name="username" size="20px"></p>
    <P>Password:<input type="text" name="passwd" size="20px"></P>
    <p>Confirm Password:<input type="text" name="passwd2" size="20px"></p>
    <input type="submit" value="Register">
    </form>
<?php
}
?>
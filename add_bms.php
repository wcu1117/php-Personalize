<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/2/2016
 * Time: 5:59 PM
 */
require_once ('bookmark_fns.php');
session_start();

//create short variable name
$new_url = $_POST['new_url'];
do_html_header('Adding bookmarks');

try
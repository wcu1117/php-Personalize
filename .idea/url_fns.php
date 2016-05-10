<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/10/2016
 * Time: 5:04 PM
 */
require_once ('bookmark_fns.php');
session_start();

//create short variable name
$new_url = $_POST['new_url'];
do_html_header('Adding bookmark');

try{
    eheck_valid_user();
    if(!filled_out($_POST)){
        throw new Exception('Form not completely filled out');
    }

    //eheck URL format
    if(strstr($new_url,'http://') === false){
        $new_url = 'http://'.$new_url;
    }

    //check url is valid
    if(!(@fopen($new_url,'r'))){
        throw new Exception('Not a valid URL');
    }

    //try to add bm
    add_bm($new_url);
    echo 'bookmaek added';

    //get the bookmark this user has saved
    if($new_array = get_user_urls($_SESSION['valid_user'])){
        display_user_urls($new_array);
    }
}catch(Exception $e){
    echo $e->getMessage();
}
display_user_menu();
do_html_footer();

function get_user_urls($username){
    //extract from the database all the URLs this user has stores

    $conn = db_connect();
    $result = $conn->query("select bm_URL from bookmark where username ='".$username."'");
    if(!$result){
        return false;
    }

    //create an array of this url
    $url_array = array();
    for($count = 1;$row = $result->fetch_row();++$count){
        $url_array[$count] = $row[0];
    }
    return $url_array;
}

function delete_bm($user,$url){
    //delete one url from the database
    $conn = db_connect();

    //delete the bookmark
    if(!$conn->query("delete from bookmark where username='".$user."' and bm_url='".$url."'")){
        throw new Exception('Bookmark could not be delete');
    }
    return true;
}


function recommend_urls($valid_user,$popularity = 1){
    //provide recommendations to people
    $conn = db_connect();

    //find other matching users
    $query = "select bm_URL from bookmark where username in (SELECT DISTINCT(b2.username) FROM bookmark b1, bookmark b2 WHERE b1.username='".$valid_user."'
                and b1.username != b2.username and b1.bm_URL = b2.bm_URL)
                and bm_URL not in (select bm_URL from bookmark where username='".$valid_user."') groud by bm_url having count(bm_URL)>".$popularity;

    if(!($result = $conn->query($query))){
        throw new Exception('Could not find any bookmarks to recommend');
    }

    if($result->num_rows == 0){
        throw new Exception('Could not find any bookmarks to recommend');
    }

    $urls = array();
    //build an array of the relevant urls
    for($count=0;$row = $result->fetch_object();$count++){
        $urls[$count] = $row->bm_URL;
    }
    return $urls;
}
?>

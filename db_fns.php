<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/8/2016
 * Time: 11:00 PM
 */
function db_connect(){
    $result = new mysqli('localhost','bm_user','123456','bookmarks');
    if(!$result){
        throw new Exception('Could not connect db server');
    }else{
        return true;
    }
}
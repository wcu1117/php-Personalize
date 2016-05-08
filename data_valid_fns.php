<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/8/2016
 * Time: 10:32 PM
 */
function filled_out($form_vars){
    //test that each variable has a value
    foreach($form_vars as $key => $value){
        if((!isset($Key))||($value=='')){
            return false;
        }
    }
    return true;
}

function valid_email($address){
    //check an email address is possible valid
    if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$address)){
        return true;
    }else{
        return false;
    }
}
?>
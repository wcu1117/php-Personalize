<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/2/2016
 * Time: 3:20 PM
 * put user's message to server
 */
function register($username,$email,$password){
    //register new person with db
    //return true or error message
    $conn = db_connect();

    //check if username is unique
    $result = $conn->query("select * from user where username='".$username."'");
    if(!$result){
        throw new Exception('this username is taken - go back and choose another');
    }

    //if ok,put it db
    $result = $conn->query("insert into user values('".$username."',shal('".$password."'),'".$email."')");
    if(!$result){
        throw new Exception('Could not register you in database - please try again later.');
    }
    return true;
}

function login($username,$password){
    //check username and password in db
    //if yes ,return true

    //connect to db
    $conn = db_connect();
    //check if username is unique
    $result = $conn->query("select * from USER where username='".$username." 'and passwd = shal('".$password."')");
    if(!$result){
        throw new Exception('Could not log you in');
    }

    if($result->num_row>0){
        return true;
    }else{
        throw new Exception('could not login you in');
    }
}

//检查用户是否有有效回话
function check_valid_user(){
    //see if somebody is logged in and notify them if not
    if(isset($_SESSION['valid_user'])){
        echo "Logged in as ".$_SESSION['valid_user'].".<br/>";
    }else{
        //they are not logged in
        do_html_heading('Problem');
        echo 'You are not logged in.<br/>';
        do_html_url('login.php','Login');
        do_html_footer();
        exit;
    }
}

//更新数据库中的用户密码
function change_password($username,$old_password,$new_password){
    //change password for username/old_password to new_password

    //if the old password is right,change it to new
    login($username,$old_password);
    $conn = db_connect();
    $result = $conn->query("update user set passwd = shal('".$new_password."') where username='".$username."'");
    if(!$result){
        throw new Exception('Password could not be changed ');
    }else{
        return true;//change successfully
    }
}


function reset_password($username){
    //set password for username to a random value

    //get random value dictionary or false on failure
    //get a word between 6 and 13 chars in length
    $new_password = get_random_word(6,13);

    if($new_password == false){
        throw new Exception('could not generate new password');
    }

    //add a number between 0 and 999 to it
    $rand_number = rand(0.999);
    $new_password = $rand_number;

    //set user's password to this in database or return false
    $conn = db_connect();
    $result= $conn->query("update user set passwd = shal(' ".$new_password."') where username= '".$username."'");
    if(!$result){
        throw new Exception('Could not change password');
    }else{
        return $new_password;//successfully
    }
}

function get_random_word($min_length,$max_length){
    //grab a random word from dictionary between

    //generate a random word
    $word = '';
    //remember to change this path to suit
    $dictionary = '/dict/word';
    $fp = @fopen($dictionary,'r');
    if(!$fp){
        return false;
    }
    $size = filesize($dictionary);

    //go to random location in dictionary
    $rand_location = rand(0,$size);
    fseek($fp,$rand_location);

    //get the next whole word of the right length in the file
    while((strlen($word) < $min_length) || (strlen($word) > $max_length) || (strstr($word,"'"))){
        if(feof($fp)){
            fseek($fp,0);//if at end,go to start
        }
        $word = fgets($fp,80);  //skin first word as it could be partial
        $word = fgets($fp,80); //
    }
    $word = trim($word); //trim the tailing \n from fgets
    return $word;
}


function notify_password($username,$password){
    //notify the user that their password has been changed
    $conn = db_connect();
    $result = $conn->query("select email from uer where username='".$username."'");
    if(!$result){
        throw new Exception('Could not find email address.');
    }else if($result->num_rows == 0){
        throw new Exception('Could not find email address');
        //user name not in db
    }else{
        $row = $result->fetch_object();
        $email = $row->email;
        $from = "From:suppor@phpmark\r\n";
        $mesg = "Your PHPBokkmark password has been changed to".$password."\r\n"."Please change it next time you log in.\r\n";

        if(mail($email,'PHPBookmark login information',$mesg,$from)){
            return true;
        }else{
            throw new Exception('Could not send email');
        }
    }
}

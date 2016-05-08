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
<img src="image/bookmark.gif" alt="PHPbookmark logo" border="0" align="left" valign="bottom" height="55px" width="57px">
<h1>PHPbookmark</h1>
<hr/>
<?php
if ($title) {
    d0_html_heading($title);
}
}
    ?>
    </body>
    </html>
}

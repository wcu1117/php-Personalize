<?php
/**
 * Created by PhpStorm.
 * User: hacker
 * Date: 5/11/2016
 * Time: 10:30 AM
 */
require_once ('bookmark_fns.php');
do_html_header('Add Bookmarks');
?>
<form action="add_bms.php" method="post">
<p>Loginged in as </p>
<p>NEW BM<input name="new_url" type="text" size="13px"></p>
<input type="submit" value="Add bookmark">
</form>
<?php
do_html_footer();
?>

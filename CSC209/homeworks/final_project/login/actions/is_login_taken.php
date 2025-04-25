<?php
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/users.php";
?>
<?= user_exists($_GET['uname']) ? '* Username is taken :(' : '';
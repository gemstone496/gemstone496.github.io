<?php
include_once '../assets/php/lab2.php';
?>
<?= count_users($render_args["users"] ?? "users.txt"); ?>
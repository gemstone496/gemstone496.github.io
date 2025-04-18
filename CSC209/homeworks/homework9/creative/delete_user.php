<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/login.php";

$path = "../output/users.json";
$users = file_exists($path) ? read_data($path) : [];
$uname = $_REQUEST["uname"];
if (array_key_exists($uname, $users)) {
  unset($users[$uname]);
}

$fp = fopen($path,"w");
  fwrite($fp, json_encode($users));
fclose($fp);

foreach ($users as $uname => $pwd) {
  echo "
  <p>User: $uname <button class='cancelbtn' onclick='removeUser(\"delete_user.php\", \"$uname\")'>Delete User</button></p>";
}
<?php
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/users.php";

$uname = strip_input($_POST["uname"]);
$psw = strip_input($_POST["psw"]);
$location = "../login.html.php";
$new_sesh = false;

if ($_POST["mode"] === "signup") {
  if (!user_exists($uname)) {
    $new_user_path = find_asset("data/users").$uname;
    if (
      mkdir(directory: $new_user_path, recursive: true) &&
      $fp = fopen("$new_user_path/$uname.json","w")
    ) {
      $new_user = ["username" => $uname, "password"=> $psw];
      fwrite($fp, json_encode($new_user));
      fclose($fp);
        
      $location = "../../comic/pages.html.php";
      $new_sesh = true;
    }
  }
} else if ($_POST["mode"] === "login") {
  if (validate_login($uname, $psw)) {
    $new_sesh = true;
    $location = is_admin($uname) ? "../admin.html.php" : "../../comic/pages.html.php";
  }
}

if ($new_sesh) {
  session_start();
  $_SESSION["user"] = $uname;
}
header("Location: $location");
die();
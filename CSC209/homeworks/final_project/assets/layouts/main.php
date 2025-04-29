<?php 
session_start();
$user = $_SESSION["user"] ?? "";

$layout_content["assets"] = array_merge(["main", "modal", "nav"], $content["assets"] ?? []);

$layout_content["content"] = generate_modal("log-out").'
  <div class="col full-width center tb-pad secondary-color">
    <h1 class="logo">wildfire</h1>
    <div class="dropdown-wrapper">
      <nav class="menu row center tb-pad">
        <a class="nav hidden" onclick="openMenu(this)">MENU</a>
        <a class="nav responsive" href="'.find_asset("comic/pages.html.php").'">HOME</a>
        <a class="nav responsive" href="'.find_asset("about.html.php").'">ABOUT</a>
        <a class="nav responsive" href="'.find_asset("comic/archive.html.php").'">ARCHIVE</a>
        <div id="profile-dropdown" class="dropdown responsive col flex-right">
          <div class="nav dropdown-reveal">
            <a href="'.(find_asset($user ? "login/profile.html.php" : "login/login.html.php")).'">
              <img class="pfp user thumbnail" 
                src="'.($user && fetch_pfp($user) ? fetch_pfp($user) : find_asset("images/pfp_default.png")).'">
            </a>
          </div>
          <div class="dropdown-content">
            <div class="dropdown-option flex-right">
              <a class="off-frgd" href="'.($user ? find_asset("login/profile.html.php") : find_asset("login/login.html.php")).'">
                '.($user ? "PROFILE" : "LOG IN").'
              </a>
            </div>
            '.($user ? '<div class="dropdown-option flex-right abort-link">
              <a onclick="showModal(\'logout-modal\')">LOG OUT</a>
            </div>' : '').'
          </div>
        </div><div class="hz-vt-spacer responsive"></div>
      </nav>
    </div>
  </div>
  <div id="content">
';
$layout_content["content"] .= $content["content"] ?? "";
$layout_content["content"] .= '
  </div>
  <div class="col full-width center tb-pad secondary-color">
    <nav class="menu row center tb-pad">
      <a class="nav" href="'.find_asset("comic/pages.html.php").'">HOME</a>
      <a class="nav" href="'.find_asset("about.html.php").'">ABOUT</a>
      <a class="nav" href="'.find_asset("comic/archive.html.php").'">ARCHIVE</a>
    </nav>
  </div>
  <div id="copyright" class="full-width tb-pad secondary-color">&copy;2025 Jade Onyx Violet Lilian<div class="hz-vt-spacer"></div></div>
';
?>

<?= render_layout("head", $layout_content); ?>

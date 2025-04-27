<?php 
session_start();
$user = $_SESSION["user"] ?? "";

$layout_content["assets"] = $content["assets"] ?? [];

$layout_content["content"] = '
  <div class="vflex-center secondary-color">
    <h1 class="logo">wildfire</h1>
    <div class="dropdown-wrapper">
      <nav class="menu">
        <a class="nav hidden" onclick="openMenu(this)">MENU</a>
        <a class="nav responsive" href="'.find_asset("comic/pages.html.php").'">HOME</a>
        <a class="nav responsive" href="'.find_asset("about.html.php").'">ABOUT</a>
        <a class="nav responsive" href="'.find_asset("comic/archive.html.php").'">ARCHIVE</a>
        <div id="profile-dropdown" class="dropdown responsive">
          <a class="dropdown-reveal" href="'.(find_asset($user ? "login/profile.html.php" : "login/login.html.php")).'">
            <img class="nav pfp-thumbnail" 
              src="'.($user && fetch_pfp($user) ? '' : find_asset("images/pfp_default.png")).'">
          </a>
          <div class="dropdown-content">
            <div class="dropdown-option">
              <a class="off-frgd" href="'.($user ? find_asset("login/profile.html.php") : find_asset("login/login.html.php")).'">
                '.($user ? "PROFILE" : "LOG IN").'
              </a>
            </div>
            <div class="dropdown-option abort-link">
              <a onclick="confirmLogout(\''.find_asset("login/actions/logout.php").'\')">
                '.($user ? "LOG OUT" : "").'
              </a>
            </div>
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
  <div class="vflex-center secondary-color">
    <nav class="menu">
      <a class="nav" href="'.find_asset("comic/pages.html.php").'">HOME</a>
      <a class="nav" href="'.find_asset("about.html.php").'">ABOUT</a>
      <a class="nav" href="'.find_asset("comic/archive.html.php").'">ARCHIVE</a>
    </nav>
  </div>
  <div id="copyright" class="secondary-color">&copy;2025 Jade Onyx Violet Lilian<div class="hz-vt-spacer"></div></div>
';
?>

<?= render_layout("head", $layout_content); ?>
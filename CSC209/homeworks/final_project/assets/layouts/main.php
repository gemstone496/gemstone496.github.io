<?php 
session_start();
$user = $_SESSION["user"] ?? "";

$layout_content["assets"] = array_merge(["main", "modal", "nav"], $content["assets"] ?? []);

$layout_content["content"] = '
  <div id="logout-modal" class="modal animate">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Log out</h4>
        <span class="modal-close" title="Close Modal">&times;</span>
      </div>
      <div class="modal-body">
        Are you sure you would like to log out?
      </div>
      <div class="modal-footer">
        <form method="post" action="'.find_asset("login/actions/logout.php").'">
          <button class="btn" type="submit">Log out</button>
        </form>
        <button class="modal-close btn abort-btn">Cancel</button>
      </div>
    </div>
  </div>
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
            '.($user ? '<div class="dropdown-option abort-link">
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

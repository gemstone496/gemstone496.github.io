<?php
include_once "helpers.php";

/**
 * fetches a user's pfp and returns its src path for embedding
 * @param string $username the username to check for a pfp
 * @return null
 */
function fetch_pfp(string $username): string | null {
  $user_dir = find_asset("data/users/$username");
  $pfp = glob($user_dir."_pfp_*");
  return $pfp[0] ?? null;
}

/**
 * generates a header for user profile pages (profile and admin)
 * @param string $user the user to check for pfps and admin with
 * @return string the profile header string
 */
function generate_profile_header(string $user): string {
  $printout = '
<div class="col full-width">
  <h2 class="row center">Welcome, '.$user.(is_admin($user) ? ' ADMIN' : '').'</h2>
  <div class="row center top mb-3">
    <img class="pfp user enlarged" src="'.(fetch_pfp($user) ?? find_asset("images/pfp_default.png")).'">
    <a class="hover-underline lr-pad" onclick="toggleObjectHidden(\'pfp-form-wrapper\')">Edit</a>
  </div>
  <div id="pfp-form-wrapper" class="row center border white hidden tb-pad mb-3">
    <form id="pfp-upload-form" class="col center" method="post" enctype="multipart/form-data"
          onsubmit="verifySubmit(event, \'pfp-upload-form\')" action="./actions/upload_pfp.php">
      <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
      <div class="hz-vt-spacer">
      <label for="pfp-upload" class="row center little-txt"><span id="pfp-upload-verifier" class="verifier lr-pad"></span></label>
      <input id="pfp-upload" name="pfp-upload" class="row center" type="file" onchange=validateInputField(\'pfp-upload\')>
      <div class="hz-vt-spacer">
      <div class="row center">
        <button class="btn" type="submit">Upload</button>
        <button class="btn abort-btn" onclick="removePfp(\''.find_asset("images/pfp_default.png").'\')">Remove profile picture</button>
      </div>
    </form>
  </div>
</div>';
  return $printout;
}

/**
 * is the specified user an admin?
 * @param string $uname username to look up
 * @return bool Y/N is uname in the set of admins
 */
function is_admin(string $uname): bool {
  $admins = read_data(find_asset("data").'adminlist.json');
  // admins["$uname"] exists iff $uname is admin.
  // stored in associative array for faster lookups.
  // the site has no built-in ways to change admins, they are fixed.
  return $admins && array_key_exists($uname, $admins);
}

/**
 * returns the password of user $uname, null if user does not exist
 * WARNING: this method uses slow lookups. may need adjustment for larger userbases
 * @param string $uname the username to check
 * @return string username's password
 */
function user_exists(string $uname): string | null {
  $users = glob(find_asset('data/users').'*');
  foreach ($users as $user) {
    if (strip_filename($user, false) === strip_input($uname)) {
      return read_data("$user/$uname.json")["password"];
    }
  }
  return null;
}

/**
 * do my inputs match my outputs? let's find out!
 * @param string $username raw user input (to be escaped)
 * @param string $password raw password to match
 * @return bool do they match?
 */
function validate_login(string $username, string $password): bool {
  $username = strip_input($username);
  $password = strip_input($password);

  return $password !== null && $password === user_exists($username);
}
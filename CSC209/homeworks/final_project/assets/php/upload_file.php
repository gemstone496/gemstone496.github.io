<?php
      /**
       * max file size
       * @var int the max file size i accept from forms
       */
const MAX_FILE_SIZE = 7500000;

/**
 * uploads a file from the client to the spot designated by path
 * CREATE DIRECTORIES FIRST
 * most of this code is derived from [this post](https://www.php.net/manual/en/features.file-upload.php) in the php manual
 * @param mixed $upload
 * @param mixed $path
 * @return bool whether the file is successfully uploaded
 */
function upload_file($upload, $path): bool {
  if (
    !isset($upload['error']) || # undefined | $_FILES corruption
    is_array($upload['error']) || # multiple files | $_FILES corruption
    $upload["error"] !== UPLOAD_ERR_OK || # check $upload['error'] value
    $upload['size'] > MAX_FILE_SIZE # check filesize
  ) {
    return false;
  }

  # resource https://www.php.net/manual/en/features.file-upload.php said this method is unreliable. i'm inclined to trust it, as it's in the official php docs page
  # unfortunately, idk how to get finfo to work properly without a php.ini file that you wouldn't have anyways
  # code snippets, for this block only, modified from https://www.geeksforgeeks.org/how-to-check-the-type-and-size-before-file-uploading-in-php/
  $ext = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
  if (false === array_search(
    $ext,
    ['jpg', 'jpeg', 'png', "bmp"], # acceptable img filetypes
    true
  )) {
    return false;
  }

  if (file_exists("$path.$ext")) {
    unlink("$path.$ext");
  }

  // name it
  // DO NOT USE $_FILES['page-upload']['name'] WITHOUT ANY VALIDATION !!
  // On this example, obtain safe unique name from its binary data.
  if (!move_uploaded_file(
    $upload['tmp_name'], "$path.$ext"
  )) {
    return false;
  }

  return true; 
}
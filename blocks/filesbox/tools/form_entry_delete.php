<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
// -----
if (isset($_GET['pID']) === false) {
  return;
}
// -----
$pID = $_GET['pID'];
$filename = $_GET['filename'];
$fullpath = DIR_FILES_UPLOADED_STANDARD.'/filesbox'.'/'.$pID.'/'.$filename;
// -----
if (file_exists($fullpath)) {
  unlink($fullpath);
}

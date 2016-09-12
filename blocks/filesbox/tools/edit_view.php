<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
// =====
if (isset($_GET['pID']) === false) {
  echo('[no files]');
  return;
}
$pID = $_GET['pID'];
// =====
$html = '';
// =====
$dir = DIR_FILES_UPLOADED_STANDARD.'/filesbox';
if (file_exists($dir) === false) {
  mkdir($dir);
}
// =====
$dir = $dir.'/'.$pID;
if (file_exists($dir) === false) {
	mkdir($dir);
}
// =====
$dirth = $dir.'/thumbs';
if (file_exists($dirth) === false) {
	mkdir($dirth);
}
// =====
$target_path = array();
// =====
if ($handle = opendir($dir)) {
  while (false !== ($file = readdir($handle))) {
    if( filetype($dir.'/'.$file) == "file" ) {
      $f = array();
      $f['file'] = $file;
      $target_path[] = $f;
    }
  }
  closedir($handle);
}
// =====
if (count($target_path) == 0) {
  $html = 'No File';
} else {
  $html .= BASE_URL.'/application/files/filesbox/'.$pID.'/<br>';
  asort($target_path);
  foreach($target_path as $v) {
    $html .= '<span class="glyphicon glyphicon-file" aria-hidden="true"></span> '.$v['file'].' ';
  }
}
// =====
echo $html;

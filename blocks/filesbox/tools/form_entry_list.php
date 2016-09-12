<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
// =====
$html = '';
// =====
if (isset($_GET['pID']) === false) {
  echo('[no files]');
  return;
}
$pID = $_GET['pID'];
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
      $f['url'] = BASE_URL.'/application/files/filesbox/'.$pID.'/'.$file;
      $f['urlth'] = BASE_URL.'/application/files/filesbox/'.$pID.'/thumbs/'.$file;
      $f['pathth'] = $dirth.'/'.$file;
      $target_path[] = $f;
    }
  }
  closedir($handle);
}
// =====
if (count($target_path) == 0) {
  $html = 'No File';
} else {
  asort($target_path);
  if (count($target_path) != 1) {
    $html .= '<div class="form-group">';
    $html .= '<pre>';
    foreach($target_path as $v) {
      $html .= $v['url']."\n";
    }
    $html .= '</pre>';
    $html .= '</div>';
  }
  foreach($target_path as $v) {
    $html .= '<div class="form-group">';
    if (file_exists($v['pathth'])) {
      $html .= '<img src="'.$v['urlth'].'" width="128px" class="img-thumbnail"><br>';
    }
    $html .= $v['file'].'<br>';
    $html .= $v['url'].'<br>';
    $html .= '<span id="btn_delete" class="btn btn-xs btn-danger" filename="'.$v['file'].'">削除</span>';
    $html .= '</div>';
  }
}
// =====
echo $html;

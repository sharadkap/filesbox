<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
// =====
$html = '';
// =====
if (isset($_POST['pID']) === false) {
  return;
}
$pID = $_POST['pID'];
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

if(!empty($_FILES)){
  // ======
  $files = $_FILES['file'];
  $tempFile = $files['tmp_name'];
  $actualFile = $dir.'/'.$files['name'];
  $thumbsFile = $dir.'/thumbs/'.$files['name'];
  // ======
  move_uploaded_file($tempFile, $actualFile);
  // ======
  list($im1x, $im1y, $im_mime_type, $im_attr) = getimagesize($actualFile);
  // ======
  if (($im1x != 0) and ($im1y != 0)) {
    switch($im_mime_type){
      case IMAGETYPE_JPEG:
        $im1 = imagecreatefromjpeg($actualFile);
        break;
    case IMAGETYPE_PNG:
        $im1 = imagecreatefrompng($actualFile);
        break;
    }

    $im2x_max = 128;
    $im2y_max = 96;

    $im2x = $im2x_max;
    $im2y = $im1y * ($im2x_max / $im1x);

    if ($im2y > $im2y_max) {
      $im2x = $im1x * ($im2y_max / $im1y);
      $im2y = $im2y_max;
    }

    $im2 = imagecreatetruecolor($im2x_max, $im2y_max);

    $im2white = imagecolorallocate($im2, 255, 255, 255);
    imagefill($im2, 0, 0, $im2white);

    imagecopyresampled($im2, $im1, ($im2x_max-$im2x) / 2, ($im2y_max-$im2y) / 2, 0, 0, $im2x, $im2y, $im1x, $im1y);

    imagejpeg($im2, $thumbsFile);

  }

}

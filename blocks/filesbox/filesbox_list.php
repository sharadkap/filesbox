<?php
$pID = $_GET['pID'];

if ($handle = opendir($dir)) {
  while (false !== ($file = readdir($handle))) {
    if( filetype( $path = $dir . '/'. $file ) == "file" ) {
      $target_path[] = BASE_URL.'/application/files/filesbox/'.$c->getCollectionID().'/'.$file;
    }
  }
  closedir($handle);
}

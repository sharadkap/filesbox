<?php
namespace Concrete\Package\FilesBox;

use Package;
use BlockType;
use SinglePage;
use Loader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

  protected $pkgHandle = "filesbox";
  protected $appVersionRequired = "5.7";
  protected $pkgVersion = "1.0";

  public function getPackageName() {
    return t('FilesBox');
  }

  public function getPackageDescription() {
    return t('Files Box.');
  }

	public function install() {
    $pkg = parent::install();
		// install list block
    BlockType::installBlockTypeFromPackage('filesbox', $pkg);
	}
}

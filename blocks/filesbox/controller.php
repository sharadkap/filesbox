<?php
namespace Concrete\Package\FilesBox\Block\FilesBox;
use \Concrete\Core\Block\BlockController;

class Controller extends BlockController {

  protected $btTable = 'btFilesBox';
  protected $btInterfaceWidth = "600";
  protected $btWrapperClass = 'ccm-ui';
  protected $btInterfaceHeight = "500";
  protected $btCacheBlockRecord = true;
  protected $btCacheBlockOutput = true;
  protected $btCacheBlockOutputOnPost = true;
  protected $btCacheBlockOutputForRegisteredUsers = false;
  protected $btIgnorePageThemeGridFrameworkContainer = true;

  public $content = "";

  public function getBlockTypeName() {
    return t("FilesBox");
  }

  public function getBlockTypeDescription() {
    return t("FilesBox");
  }


  public function view() {
    $this->set('content', $this->content);
  }

  public function save($data) {
    $args['content'] = isset($data['content']) ? $data['content'] : '';
    parent::save($args);
  }

  public function action_mx() {
    echo SITE;
  }

}

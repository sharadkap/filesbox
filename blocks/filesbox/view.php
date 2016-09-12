<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Core::make('helper/form');

$pg = Page::getCurrentPage();

if ($pg->isEditMode() === false) {
  return;
}

$pID = $pg->getCollectionID();

$th = Loader::helper('concrete/urls');
$bt = BlockType::getByHandle('FilesBox');
$ajax_url_edit_view = $th->getBlockTypeToolsURL($bt).'/'.'edit_view?pID='.$pID;

?>

<script>

$(document).ready(function(){

  fb_refresh();

  function fb_refresh() {
    $.ajax({
      url: '<?php echo $ajax_url_edit_view; ?>',
      success: function(data) {
        $('#fb_view').html(data);
      },
      error: function(data) {
        $('#fb_view').text('読み込み失敗');
      }
    });
  }

});

</script>

<div id="filesbox<?php echo intval($bID)?>" class="filesbox panel panel-default">

<div class="panel-heading">
  FilesBox ( pID:<?php echo $pID; ?> )
</div>
<div id="fb_view" class="panel-body">Loading...</div>

</div>


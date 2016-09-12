<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Core::make('helper/form');

$pg = Page::getCurrentPage();
$pID = $pg->getCollectionID();

$th = Loader::helper('concrete/urls');
$bt = BlockType::getByHandle('FilesBox');
$ajax_url_form_enrty_list = $th->getBlockTypeToolsURL($bt).'/'.'form_entry_list?pID='.$pID;
$ajax_url_form_enrty_delete = $th->getBlockTypeToolsURL($bt).'/'.'form_entry_delete?pID='.$pID;

?>

<link rel="stylesheet" href="<?php echo $this->getBlockUrl(); ?>/css/dropzone.min.css">
<script src="<?php echo $this->getBlockUrl(); ?>/js/dropzone.min.js"></script>

<script>

$(document).ready(function(){

  Dropzone.autoDiscover = false;
  Dropzone.options.myAwesomeDropzone = {
    parallelUploads:1,
    maxFiles:10,
    maxFilesize:2.0,
  };
  //var myDropzone = new Dropzone("div#my-dropzone",{url:"<?php echo $this->getBlockUrl(); ?>/filesbox_dropzone_upload.php"});
  var myDropzone = new Dropzone("div#my-dropzone",{url:"<?php echo $th->getBlockTypeToolsURL($bt); ?>/filesbox_dropzone_upload"});
  myDropzone.on("sending", function(file,xhr,formData) {
    formData.append("pID", <?php echo $pID; ?>);
  });
  myDropzone.on("success", function(file) {
    fb_refresh();
  });

  fb_refresh();

  function fb_refresh() {
    $.ajax({
      url: '<?php echo $th->getBlockTypeToolsURL($bt); ?>/form_entry_list',
      data: 'pID=<?php echo $pID ?>',
      success: function(data) {
        $('#fb_form_entry_list').html(data);
      },
      error: function(data) {
        $('#fb_form_entry_list').text('読み込み失敗');
      }
    });
  }

  $(document).on('click','#btn_delete',function(){
    $.ajax({
      url: '<?php echo $th->getBlockTypeToolsURL($bt); ?>/form_entry_delete',
      data: 'pID=<?php echo $pID ?>&filename='+$(this).attr('filename'),
      success: function(data) {
        fb_refresh();
      }
    });

  });

});

</script>

<div class="form-group">
  <div id="my-dropzone" class="dropzone"></div>
</div>

<?php
  if (isset($content) == false) {
    $content = '';
  }
?>

<div class="form-group">
  <label class="control-label"><?php echo t('Comments')?></label>
  <?php echo $form->text('content', $content, array()) ?>
</div>

<div class="form-group">
  <label class="control-label"><?php echo t('Files')?></label>
</div>

<div class="form-group">
  <div id="fb_form_entry_list">Loading...</div>
</div>

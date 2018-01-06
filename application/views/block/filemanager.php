<!-- Modal -->
<div id="modal-filemanager" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body"> 
        <iframe id="iframe-manager" src="<?php echo base_url("/medias?is_iframe=true&max=1");?>"></iframe>
      	<input type="hidden" id="data-value-choose-file">
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?php echo skin_url("css/filemanager.css");?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo skin_url("js/filemanager.js")?>"></script>
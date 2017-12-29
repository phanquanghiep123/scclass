<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/uploader.css");?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/demo.css");?>" rel="stylesheet" />
<div class="row demo-columns">
   <div class="col-md-6">
      <!-- D&D Zone-->
      <div id="drag-and-drop-zone" class="uploader">
         <div>Drag &amp; Drop Images Here</div>
         <div class="or">-or-</div>
         <div class="browser">
            <label>
            <span>Click to open the file Browser</span>
            <input type="file" name="files[]" multiple="multiple" title='Click to add Files'>
            </label>
         </div>
      </div>
      <!-- /D&D Zone -->
      <!-- Debug box -->
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">Debug</h3>
         </div>
         <div class="panel-body demo-panel-debug">
            <ul id="demo-debug">
            </ul>
         </div>
      </div>
      <!-- /Debug box -->
   </div>
   <!-- / Left column -->
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">Uploads</h3>
         </div>
         <div class="panel-body demo-panel-files" id='demo-files'>
            <span class="demo-note">No Files have been selected/droped yet...</span>
         </div>
      </div>
   </div>
   <!-- / Right column -->
</div>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/js/demo-preview.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/src/dmuploader.min.js");?>"></script>
<script type="text/javascript">
  $('#drag-and-drop-zone').dmUploader({
    url: '<?php echo base_url ("medias/upload");?>',
    dataType: 'json',
    allowedTypes: 'image/*',
    onInit: function(){
      $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
    },
    onBeforeUpload: function(id){
      $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

      $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
    },
    onNewFile: function(id, file){
      $.danidemo.addFile('#demo-files', id, file);

      /*** Begins Image preview loader ***/
      if (typeof FileReader !== "undefined"){
        
        var reader = new FileReader();

        // Last image added
        var img = $('#demo-files').find('.demo-image-preview').eq(0);

        reader.onload = function (e) {
          img.attr('src', e.target.result);
        }

        reader.readAsDataURL(file);

      } else {
        // Hide/Remove all Images if FileReader isn't supported
        $('#demo-files').find('.demo-image-preview').remove();
      }
      /*** Ends Image preview loader ***/

    },
    onComplete: function(){
      $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
    },
    onUploadProgress: function(id, percent){
      var percentStr = percent + '%';
      $.danidemo.updateFileProgress(id, percentStr);
    },
    onUploadSuccess: function(id, data){
      $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
      $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
      $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
      $.danidemo.updateFileProgress(id, '100%');
    },
    onUploadError: function(id, message){
      $.danidemo.updateFileStatus(id, 'error', message);
      $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
    },
    onFileTypeError: function(file){
      $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
    },
    onFileSizeError: function(file){
      $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
    },
    onFallbackMode: function(message){
      $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
    }
  });
</script>
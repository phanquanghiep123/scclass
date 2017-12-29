<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/uploader.css");?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/demo.css");?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo skin_url("/css/font-awesome.css");?>" rel="stylesheet" />

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
<div class="row">
  <div id="contaner-media">
    
  </div>
</div>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/js/demo-preview.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/src/dmuploader.min.js");?>"></script>
<script type="text/javascript">
  var string = '<?php echo json_encode(@$mediatype);?>';
  var extensions = JSON.parse(string);
  var base_url  = '<?php echo base_url();?>';
  $('#drag-and-drop-zone').dmUploader({
    url: "<?php echo base_url ("medias/upload");?>",
    dataType: 'json',
    allowedTypes: '*',
    onInit: function(){
      $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
    },
    onBeforeUpload: function(id){
      $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);
      $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
    },
    onNewFile: function(id, file){
      $.danidemo.addFile('#demo-files', id, file);
      var exe = file.name.replace(/^.*\./, '');
      var extension = null;
      $.each (extensions,function(k,v){
        if(v.extension.indexOf("/"+exe.toLowerCase()+"/")!=-1){
          extension = v;
          return false;
        }
      });
      if(extension == null){
        $.each (extensions,function(k,v){
          if(v.name == "file"){
            extension = v;
            return false;
          }
        });
      }
      if(extension.name == "image"){
        if (typeof FileReader !== "undefined"){
          var reader = new FileReader();
          var img = $('#demo-files').find('.demo-image-preview').eq(0);
          reader.onload = function (e) {
            img.attr('src', e.target.result);
          }
          reader.readAsDataURL(file);

        } else {
          $('#demo-files').find('.demo-image-preview').remove();
        }
         
      }else{
        $('#demo-files').find('.demo-image-preview').eq(0).parent().prepend('<i class="'+extension.icon+'"></i>');
        $('#demo-files').find('.demo-image-preview').eq(0).remove();
      }
      
      /*** Ends Image preview loader ***/
    },
    onComplete: function(id,percent){
      $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
    },
    onUploadProgress: function(id, percent){
      var percentStr = percent + '%';
      $.danidemo.updateFileProgress(id, percentStr);
    },
    onUploadSuccess: function(id, data){
      var item = (data.response);
      $("body #contaner-media").prepend('<div class="col-md-2"><div id="contaner-item" data-id="'+item.id+'" data-type="'+item.type_id+'"><div class="action" data-id="'+item.id+'"></div>'+item.show_view+'</div></div>');
      delete data.response.show_view;
      $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
      $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
      $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
      $.danidemo.updateFileProgress(id, '100%');
      $('#demo-file' + id).find('div.progress-bar').addClass("progress-bar-success");
      setTimeout(function(){ $('#demo-file' + id).remove() }, 3000);
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
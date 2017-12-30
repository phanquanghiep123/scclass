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
       <div id="action-allmediall">
         <a href="javascript:;" data-toggle="modal" data-target="#modal-add-folder" class="btn btn-primary"> <i class="fa fa-pencil-square-o" aria-hidden="true"> Add Folder</i></a>
         <a href="javascript:;" class="btn btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"> Delete Select</i></a>
       </div>
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

   <div id="modal-add-folder" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add new folder</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="email">Folder name:</label>
            <input class="form-control" id="folder-name" type="text" required="required" maxlength="255" placeholder="Enter folder name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="add-folder-now">Add</button>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="row">
  <div id="contaner-media">
    <?php
      if(@$list_media != null){
        $sizeData = [
          "Kb" => 1024,
          "Mb" => (1024 * 1024),
          "GB" => (1024 * 1024 * 1024),
          "Tb" => (1024 * 1024 * 1024 * 1024)
        ];

        foreach ($list_media as $key => $value) {
          $sizestring = "";
          if($value["type_name"] != "folder"){
            foreach ($sizeData as $key_1 => $value_1) {
              if($value_1 < $value["size"]){
                  $sizestring = "(" .round(($value["size"] / $value_1),2) .  $key_1 .")";
              }
            }
          }
          ?>
          <div class="col-md-2">
            <div id="contaner-item" data-type="<?php echo $value["type_name"]?>" class="<?php echo $value["type_name"]?>" data-id="<?php echo $value["id"]?>" data-typeid="<?php echo $value["type_id"]?>">
              <div class="action" data-id="<?php echo $value["id"]?>" data-type="<?php echo $value["type_id"]?>">
                <a href="javascript:;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </div>
              <div class="bg-info">
                <p><?php echo  $value["name"]?> <?php echo $sizestring;?></p>
              </div>
              <?php 
                if($value["icon"] == null && $value["icon"] == ""){
                  echo '<img class="thumb-media" src="'.base_url( $value["thumb"]).'">';
                }else{
                  echo '<i class="thumb-media '.$value["icon"].'" ></i>';
                }
              ?>
            </div>
          </div>
        <?php }
      }
    ?>
  </div>
</div>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/js/demo-preview.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/src/dmuploader.min.js");?>"></script>
<script type="text/javascript">
  var string = '<?php echo json_encode(@$mediatype);?>';
  var extensions = JSON.parse(string);
  var base_url  = '<?php echo base_url();?>';
  var folder = 0;
  var id     = 0;
  var type   = null;
  $(document).ready(function(){
    $("#modal-add-folder #add-folder-now").click(function(){
      var folder_name = $("#modal-add-folder #folder-name").val();
      $.ajax({
        url : "<?php echo base_url("medias/add/folder")?>",
        type : "post",
        dataType:"json",
        data:{name : folder_name,folder: folder },
        success : function (r){
          var item = (r.response);
          $("body #contaner-media").prepend(item);
          $("#modal-add-folder").modal("hide");
          $("#modal-add-folder #folder-name").val("");
        },error : function(e){
          console.log(e);
        }
      });
    });
  });
  
  var upload =  $('#drag-and-drop-zone').dmUploader({
    url: "<?php echo base_url ("medias/upload");?>",
    dataType: 'json',
    extraData : {folder : folder},
    allowedTypes: '*',
    
    onInit: function(){
      //$.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
    },
    onBeforeUpload: function(id){

      //$.danidemo.DataSent({folder : folder})
      //$.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);
      $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
      console.log($.danidemo);
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
      //$.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
    },
    onUploadProgress: function(id, percent){
      var percentStr = percent + '%';
      $.danidemo.updateFileProgress(id, percentStr);
    },
    onUploadSuccess: function(id, data){
      var item = (data.response);
      $("body #contaner-media").prepend(item);
      delete data.response.show_view;
      //$.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
     // $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
      $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
      $.danidemo.updateFileProgress(id, '100%');
      $('#demo-file' + id).find('div.progress-bar').addClass("progress-bar-success");
      setTimeout(function(){ $('#demo-file' + id).animate({opacity : 0},2000,function(){
        $(this).remove();
      }) }, 3000);
    },
    onUploadError: function(id, message){
      $.danidemo.updateFileStatus(id, 'error', message);
      //$.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
    },
    onFileTypeError: function(file){
      //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
    },
    onFileSizeError: function(file){
      //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
    },
    onFallbackMode: function(message){
      //$.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
    }
  });
  $(document).on("click","#contaner-media #contaner-item",function(){
      type = $(this).attr("data-type");
      id   = $(this).attr("data-id");
      if(type == "folder"){
        folder = id;
      }
      $.ajax({
        url : "<?php echo base_url("medias/get")?>",
        type : "post",
        dataType:"json",
        data:{id : id,type : type},
        success : function (r){
          var item = (r.response);
          $("body #contaner-media").html(item);
        },
        error : function(e){
          console.log(e);
        }
      });
  });
</script>
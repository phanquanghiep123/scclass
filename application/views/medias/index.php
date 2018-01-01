<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/uploader.css");?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo skin_url("/uploader-master/css/demo.css");?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo skin_url("/css/font-awesome.css");?>" rel="stylesheet" />
<div class="row demo-columns">
   <div class="col-md-5">
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
   </div>
   <!-- / Left column -->
   <div class="col-md-7">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">Uploads</h3>
         </div>
         <div class="panel-body demo-panel-files" id='demo-files'>
            <span class="demo-note">No Files have been selected/droped yet...</span>
         </div>
      </div>
      <div id="action-allmediall">
        <a href="javascript:;" data-toggle="modal" data-target="#modal-add-folder" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"> Add Folder</i></a>
        <a href="javascript:;" id="delete-list-media" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"> Delete Select</i></a>         
        <a href="javascript:;" data-type="1" class="list-action-media btn btn-info disabled"><i class="fa fa-copy" aria-hidden="true"> Copy Select</i></a>
        <a href="javascript:;" data-type="2" class="list-action-media btn btn-info disabled"><i class="fa fa-cut" aria-hidden="true"> Cut Select</i></a>
        <a href="javascript:;" data-type="3" class="list-action-media btn btn-info disabled"><i class="fa fa-paste" aria-hidden="true"> Paste Select</i></a>
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
  <div class="col-md-3"><ul id="treeDemo" class="ztree"></ul></div>
    <div class="col-md-9">
      <div class="row custom-row">
        <div id="contaner-media">
          <?php
            if(@$list_media != null){
              foreach ($list_media as $key => $value) {
                $sizestring = "";
                if($value["type_name"] != "folder"){
                  foreach ($sizeData as $key_1 => $value_1) {
                    if(((int)$value_1["value"]) < $value["size"]){
                        $sizestring = "(" .round(($value["size"] / ((int)$value_1["value"])),2) .  $value_1["key_id"] .")";
                    }
                  }
                }
                ?>
                <div class="col-md-2 item-colums">
                  <div id="contaner-item" data-type="<?php echo $value["type_name"]?>" class="<?php echo $value["type_name"]?>" data-id="<?php echo $value["id"]?>" data-typeid="<?php echo $value["type_id"]?>">
                    <div class="action" data-id="<?php echo $value["id"]?>" data-type="<?php echo $value["type_id"]?>">
                      <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                      <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
  </div>
</div>
<link rel="stylesheet" href="<?php echo skin_url("zTree_v3-master/css/demo.css");?>" type="text/css">
<link rel="stylesheet" href="<?php echo skin_url("zTree_v3-master/css/zTreeStyle/zTreeStyle.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo skin_url("zTree_v3-master/js/jquery.ztree.core.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("zTree_v3-master/js/jquery.ztree.excheck.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("zTree_v3-master/js/jquery.ztree.exedit.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/js/demo-preview.js");?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/uploader-master/src/dmuploader.js");?>"></script>
<script type="text/javascript">
  var string = '<?php echo json_encode(@$mediatype);?>';
  var extensions = JSON.parse(string);
  var base_url  = '<?php echo base_url();?>';
  var folder = 0;
  var id     = 0;
  var type   = null;
  var ids    = [];
  var action_current = false;
  $(document).ready(function(){
    var setting = {
      async: {
        enable: true,
        url: getUrl
      },
      check: {
        enable: false
      },
      data: {
        simpleData: {
          enable: true
        }
      },
      view: {
        expandSpeed: ""
      },
      callback: {
        beforeExpand: beforeExpand,
        onAsyncSuccess: onAsyncSuccess,
        onAsyncError: onAsyncError,
        beforeMouseUp  : onMouseDown,

      }
    };
    var zNodes = JSON.parse('<?php echo json_encode(@$list_folder)?>');
    var log, className = "dark",
    startTime = 0, endTime = 0, perCount = 100, perTime = 100;
    startTime = new Date();
    function getUrl(treeId, treeNode) {
      var param = "id="+treeNode.id;
      return "<?php echo( base_url("medias/get_folder_by_id?"))?>" + param;
    }
    function getTime() {
      var now= new Date(),
      h=now.getHours(),
      m=now.getMinutes(),
      s=now.getSeconds(),
      ms=now.getMilliseconds();
      return (h+":"+m+":"+s+ " " +ms);
    }
    function onMouseDown(treeId, treeNode){
      if(typeof treeNode != "undefined" && treeNode != null && treeNode.id != null)
      {
        folder = treeNode.id;
        var zTree     = $.fn.zTree.getZTreeObj("treeDemo");
        treeNode.icon = "<?php echo skin_url("zTree_v3-master/css/zTreeStyle/img/loading.gif");?>";
        zTree.updateNode(treeNode);
        $.ajax({
          url : "<?php echo base_url("medias/get")?>",
          type : "post",
          dataType:"json",
          data:{id : treeNode.id,type : "folder"},
          success : function (r){
            var item = (r.response);
            $("body #contaner-media").html(item); 
            zTree.reAsyncChildNodes(treeNode, "refresh", true);
          },
          error : function(e){
            console.log(e);
          }
        });
      }
    }
    function beforeExpand(treeId, treeNode) {
      if (!treeNode.isAjaxing) { 
        treeNode.times = 1;
        ajaxGetNodes(treeNode, "refresh");
        return true;
      } else {
        alert("Downloading data, Please wait to expand node...");
        return false;
      }
    }
    function onAsyncSuccess(event, treeId, treeNode, msg) {
      if (!msg || msg.length == 0) {
        return;
      }
      var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
      totalCount = treeNode.count;
      if (treeNode.children.length < totalCount) {
        setTimeout(function() {ajaxGetNodes(treeNode);}, perTime);
      } else {
        treeNode.icon = "";
        zTree.updateNode(treeNode);
        zTree.selectNode(treeNode.children[0]);
        endTime = new Date();
        var usedTime = (endTime.getTime() - startTime.getTime())/1000;
        className = (className === "dark" ? "":"dark");
        showLog("[ "+getTime()+" ]&nbsp;&nbsp;treeNode:" + treeNode.name );
        showLog("Child node has finished loading, a total of "+ (treeNode.times-1) +" times the asynchronous load, elapsed time: "+ usedTime + " seconds ");
      }
    }
    function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
      var zTree = $.fn.zTree.getZTreeObj("treeDemo");
      alert("ajax error...");
      treeNode.icon = "";
      zTree.updateNode(treeNode);
    }
    function ajaxGetNodes(treeNode, reloadType) {
      var zTree = $.fn.zTree.getZTreeObj("treeDemo");
      if (reloadType == "refresh") {
        treeNode.icon = "<?php echo skin_url("zTree_v3-master/css/zTreeStyle/img/loading.gif");?>";
        zTree.updateNode(treeNode);
      }
      zTree.reAsyncChildNodes(treeNode, reloadType, true);
    }
    function showLog(str) {
      if (!log) log = $("#log");
      log.append("<li class='"+className+"'>"+str+"</li>");
      if(log.children("li").length > 4) {
        log.get(0).removeChild(log.children("li")[0]);
      }
    }
    $(document).ready(function(){
      $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });
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
          $("#contaner-media .empty-folder").remove();
        },error : function(e){
          console.log(e);
        }
      });
    });
  });
  var upload =  $('#drag-and-drop-zone').dmUploader({
    url: "<?php echo base_url ("medias/upload");?>",
    dataType: 'json',
    extFilter : '<?php echo $allow_uploads;?>',
    OnsentData : function(){
      var fd = new FormData();
      fd.append("folder", folder);
      return fd;
    },
    onInit: function(){
      //$.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
    },
    onBeforeUpload: function(id){

      //$.danidemo.DataSent({folder : folder})
      //$.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);
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
      //$.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
    },
    onUploadProgress: function(id, percent){
      var percentStr = percent + '%';
      $.danidemo.updateFileProgress(id, percentStr);
    },
    onUploadSuccess: function(id, data){
      var item = (data.response);
      $("body #contaner-media").prepend(item);
      $("#contaner-media .empty-folder").remove();
      try{
        delete data.response.show_view;
      }catch (err){

      }
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
    onFileExtError: function(file){
    alert('File extension of ' + file.name + ' is not allowed');
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
        get_file_on_folder({id : id,type : type});
      }  
  });
  function get_file_on_folder (data){
      $.ajax({
        url : "<?php echo base_url("medias/get")?>",
        type : "post",
        dataType:"json",
        data:data,
        success : function (r){
          var item = (r.response);
          $("body #contaner-media").html(item); 
          initdata();
        },
        error : function(e){
          console.log(e);
        }
      });
  }
  $(document).on("click","#contaner-item .action #select-media",function(event){
    event.stopPropagation();
    var id_on = $(this).parent(".action").attr("data-id");
    if($(this).hasClass("selected") == false){
      $(this).addClass("selected");
      $(this).find("i").removeClass("fa-square-o").addClass("fa-check-square");
    }else{
      $(this).removeClass("selected");
      $(this).find("i").removeClass("fa-check-square").addClass("fa-square-o");
    }
    ids = [];
    $.each($("#contaner-item .action #select-media.selected"),function(k,v){
      ids.push( $(this).parent(".action").attr("data-id") );
    });
    initdata();
    return false;
  });
  $(document).on("click","#action-allmediall #delete-list-media",function(event){
    event.stopPropagation();
    ids = [];
    $.each($("#contaner-item .action #select-media.selected"),function(k,v){
      ids.push( $(this).parent(".action").attr("data-id") );
    });
    if(ids.length == 0){
      alert("Please select at least a media!");
    }else{
      var c = confirm("Do you really want to delete the things you selected?");
      if(c){
        $.ajax({
          url : "<?php echo base_url("medias/delete")?>",
          type : "post",
          dataType : "json",
          data : {data : ids},
          success : function(r){
            console.log(r);
          },error:function(e){

          }
        });
        $.each(ids,function(k,v){
          $("#contaner-media .item-colums #contaner-item[data-id='"+v+"']").parent(".item-colums").remove();
        }); 
        initdata();
      }
    }
    return false;
  });
  $(document).on("click","#action-allmediall .list-action-media",function(event){
    if($(this).attr("data-type") != 3 && ids.length > 0){
      action_current = $(this).attr("data-type");
    }
    $("#action-allmediall .list-action-media.disabled").removeClass("disabled");
    $(this).addClass("disabled");
    if(action_current != false && ids.length > 0){
      $("#action-allmediall .list-action-media[data-type=3]").removeClass("disabled");
    }else{
      $("#action-allmediall .list-action-media[data-type=3]").addClass("disabled");
    }
    if($(this).attr("data-type") == 3){
      $("#action-allmediall .list-action-media").addClass("disabled");
      $.ajax({
        url : "<?php echo base_url("medias/actions")?>",
        type : "post",
       // dataType : "json",
        data : {data : ids,type : action_current ,folder : folder},
        success : function(r){
          action_current = false;
          console.log(r);
        },error:function(e){
          console.log(r);
        }
      });
    }
    return false;
  });
  function initdata (){
    if(ids.length > 0){
      if(action_current == 1){
        $("#action-allmediall .list-action-media[data-type=1]").addClass("disabled");
      }else{
        $("#action-allmediall .list-action-media[data-type=1]").removeClass("disabled");
      }
      if(action_current == 2){
        $("#action-allmediall .list-action-media[data-type=2]").addClass("disabled");
      }else{
        $("#action-allmediall .list-action-media[data-type=2]").removeClass("disabled");
      }
    }else{
      $("#action-allmediall .list-action-media[data-type=1]").addClass("disabled");
      $("#action-allmediall .list-action-media[data-type=2]").addClass("disabled");
    }

  }
</script>
<?php 
  $actions = $post["actions"];
  $html_action = "<ul class='action-list'>";
  foreach ($actions as $key => $value) {
    $html_action .='<li><div class="checkbox">
      <label><input id="action-item" type="checkbox" value="'.$value["id"].'">'.$value["name"].'</label>
    </div></li>';
  }
  $html_action .= "</ul>";
  $ramkey = uniqid();
?>
<link rel="stylesheet" href="<?php echo skin_url("css/font-awesome.css");?>" rel="stylesheet" />
<div class="is_page" id="page_parts">
  <div class="row">
    <form method="post" action="<?php echo base_url($action_save)?>">
      <div class="form-group">
        <label for="name" class="col-sm-4 col-form-label">Tên phần</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" id="name" value="<?php echo @$post["name"]?>" required="required">
        </div>
      </div>
      <div class="form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
          <select name="status" value="<?php echo @$post["status"]?>" class="form-control" required="required">
            <option value="">--chọn trạng thái--</option>
            <option value="0">ẩn</option>
            <option value="1">hiện</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <div class="content-left">
            <div class="list-parts">
              <ul class="nav-parts">
                <?php if(@$post["parts"] != null){
                  foreach ($post["parts"] as $key => $value) {
                    echo '<li class="item-part" data-id="'.$value["id"].'" >
                            <p data-id="'.$value["id"].'">'.$value["name"].'</p>
                            <a href="javascript:;" data-id="'.$value["id"].'" id="add-new-item" class="add-item bnt btn btn-success"> + add</a>
                            <ul data-id="'.$value["id"].'">
                                <hr/>
                                <li><div id="slider-numcolumn">
                                  <p class="lable">Rows:</p>
                                  <select class="none" name="minbeds" id="minbeds">
                                    <option value="1">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6" selected>6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="12">13</option>
                                  </select>
                                </div><hr></li>
                                <li> <p class="lable">Actions:</p>'.$html_action.'</li>
                            </ul>
                          </li>';
                  }
                }?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="content-right">
            <div class="content-show-parts">
              <h3 class="text-center">Block content</h3>
              <div class="row"><div id="container-block">
                <?php if(@$my_parts != null){
                  foreach ($my_parts as $key => $value) {
                    echo '<div data-colum="'.$value["ncolum"].'" data-id="'.$value["block_part_id"].'" class="item-part-block col-md-'.$value["ncolum"].' ui-sortable-handle"><div class="block-part"><h3 class="title-block">'.$value["name"].'</h3><div id="box-info-part"><input name="id" value="'.$value["block_part_id"].'" type="hidden">
                      <input name="ids[]" value="'.$value["block_part_id"].'" type="hidden">
                      </div>
                        <div class="menu-action">
                          <ul class="menu-block">
                            <li><a href="javascript:;" id="edit-part"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:;" id="delete-part"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                          </ul>
                        <div></div>
                      </div>
                      </div></div>';
                  }
                }?>
              </div></div>
              <input type="hidden" name="ramkey" value="<?php echo $ramkey?>">
            </div>
            <div class="form-group">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary mb-2"><?php echo @$post["id"] != null ? "Update" : "Add new";?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="modal-edit-part" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <form id="edit-part-form">
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save-block-part">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<style type="text/css">
  img ,video ,audio{max-width: 100%;}
  .form-group{float: left;width: 100%;}
  .nav-parts,.nav-parts ul{
    margin: 0;
    padding: 0;
    position: relative;
  }
  .none {display: none;}
  .nav-parts > li {
    position: relative;
    padding: 10px;
    display: list-item;
    list-style: none;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-top: none;
    position: relative;
    font-size: 23px;
    color: #000;
  }
  .nav-parts li{
    list-style: none;
  }
  .nav-parts > li:first-child{
    border-top : 1px solid #f1f1f1 ;
  }
  .nav-parts li > p{
    margin: 0;
    padding: 0;
    cursor: pointer;
    text-transform: capitalize;
  }
  .nav-parts > li > p:hover {
    color: #cccccc;
  }
  .content-show-parts{
    border: 1px solid #f1f1f1;
    border-left: 2px solid #f1f1f1;
    border-bottom: 2px solid #f1f1f1;
    min-height: 300px;
    margin-bottom: 20px;
  }
  #custom-handle {
    width: 25px;
    height: 18px;
    top: 50%;
    margin-top: -9px;
    text-align: center;
    line-height: 18px;
    font-size: 16px;
  }
  .lable, .action-list label{
    display: block;
    margin-bottom: 0.4rem;
    font-size: 1.5rem;
    font-weight: 400;
    line-height: 2rem;
    text-transform: initial;
    letter-spacing: initial;
    cursor: pointer;
  }
  #slider-numcolumn #slider {
    margin-top: 10px;
  }
  .list-parts .ui-slider-horizontal{
    height: 0.5em
  }
  .list-parts .item-part > ul {
    height: 0;
    overflow: hidden;
    -webkit-transition: height 1s; /* Safari */
    transition: height 1s;
  }
  .list-parts .item-part.open > ul{
    height: 240px;
    -webkit-transition: height 1s; /* Safari */
    transition: height 1s;
  }
  .list-parts .item-part .item-add{
    position: absolute;
    right: 10px;
    bottom: 10px;
  }
  .list-parts li.item-part #add-new-item{
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 12px;
    padding: 5px;
  } 
  #container-block {
    padding: 10px;
  }
  .block-part{
    position: relative;
    padding: 20px 15px;
    border: 1px solid #ccc;
    text-align: center;
    background: #f1f1f1;
    margin-bottom: 20px;
    display: table;
    width: 100%;
    vertical-align: middle;
  }
  .part-item{
    display: table;
    vertical-align: middle;
    width: 100%;
    padding: 5px;
  }
  .title-block{
    text-transform: capitalize;
    margin: 0;
  }
  #container-block .menu-action{
    position: absolute;
    right: 5px;
    top: 5px;
  }
  #container-block .menu-action .menu-block{
    padding: 0;
    margin: 0;
  }
  #container-block .menu-action .menu-block li{
    display: inline-block;
    list-style: none;
  }
  #modal-edit-part .box-full{
    width: 100%;
    text-align: left;
    margin-bottom: 20px; 
    border: 1px solid #f1f1f1;
  }
  #modal-edit-part ul {margin: 0;padding: 0;}
  #modal-edit-part ul li {list-style: none;}
  #modal-edit-part ul.action-list li {display: inline-block;}
  #modal-edit-part .box-action .lable label { margin-left: 10px;font-weight: 100; }
  #modal-edit-part .box-action .lable label input{ margin-right: 5px; }
  #modal-edit-part .box-action .lable {line-height: 0.7;};
  #modal-edit-part .ui-slider{margin-top: 5px;}
  #modal-edit-part textarea{
    width: 100%;
  }
  #modal-edit-part input[type='text']{
    width: 100%;
  }
  .info-item .delete-item{ 
    position: absolute;
    border-radius: 100%;
    border: 1px solid #ccc;
    background: #f1f1f1;
    color: red;
    font-size: 12px;
    padding: 1px 5px;
    right: 5px;
    top: 5px;
    text-align: center;
  }
  .block-part #content-list .info-item {
    width: 20%; 
    max-height: 100px;
    margin-bottom: 10px;
    display: inline-block;
  }
  .block-part .info-item{
    position: relative;
  }
  #content-list .info-item img {
    max-width: 100%;
    height: 100px;
    object-fit: cover;
  }
   #modal-edit-part .part-item #toggle-upload-file {
    margin-top: 20px; 
  }
  #modal-edit-part .part-item #open-file-manage{
    margin-bottom: 20px
  }
  #modal-edit-part .part-item{
    padding: 10px 0px;
  }
  #modal-edit-part .part-item textarea{
    height: 300px;
  }
  #modal-edit-part #content-list{
    margin-bottom: 20px;
  }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo skin_url("/datetimepicker/build/jquery.datetimepicker.min.css")?>">
<link rel="stylesheet" type="text/css" href="<?php echo skin_url("/jquery-ui/jquery-ui.min.css")?>">
<link rel="stylesheet" type="text/css" href="<?php echo skin_url("/validate/validatefrom.css")?>">
<script type="text/javascript" src="<?php echo skin_url("/jquery-ui/jquery-ui.min.js")?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/tinymce/jquery.tinymce.min.js")?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/tinymce/tinymce.min.js")?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/filemanager/filemanager.js")?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/validate/validatefrom.js")?>"></script>
<script type="text/javascript" src="<?php echo skin_url("/datetimepicker/build/jquery.datetimepicker.full.min.js")?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcTul7LXK43zFtXU6UpXU8oPkhN9AXKoY&libraries=places"></script>
<script type="text/javascript">
  var ramkey = "<?php echo $ramkey;?>";
  $(document).on("change","#minbeds", function() {
    var handle = $(this).parent().find( "#custom-handle" );
    handle.text( $(this).val() );
  });
  $("#container-block").sortable({
    connectWith: "#container-block",
  });
  $.each($("#slider-numcolumn #minbeds"),function(){
    var select = $(this);
    var slider = $( "<div id='slider'><div id='custom-handle' class='ui-slider-handle'></div></div>" ).insertAfter( select ).slider({
      min: 1,
      max: 12,
      range: "min",
      value: 6,
      slide: function( event, ui ) {
        select.val (ui.value);
        select.change();
      }
    }); 
    $(this).parent().find( "#custom-handle" ).text(6); 
  });
  $(document).on("click",".list-parts .item-part p",function(){
    $(this).closest("li").toggleClass("open");
  });
  $(document).on("click",".list-parts #add-new-item",function(){
    var id = $(this).attr("data-id");
    var c  = $(this).parent().find("#slider-numcolumn #minbeds").val();
    var sort = $("#container-block .item-ui").length;
    var a  = [];
    $.each ($(this).parent().find(".action-list #action-item:checked"),function(){
      a.push($(this).val());
    });
    if(id){
      $("#modal-edit-part").modal();
      $.ajax({
        type:"post",
        dataType:"json",
        url : "<?php echo base_url("parts/get");?>",
        data:{id : id,column : c , actions : a ,ramkey : ramkey,sort : sort},
        success : function (r){
          if(r.status == "success"){
            $(".content-right .content-show-parts #container-block").append(r.response );
            $("#modal-edit-part .modal-body").html(r.modal);
            var select = $("#modal-edit-part .modal-body #minbeds");
            var slider = $( "<div id='slider'><div id='custom-handle' class='ui-slider-handle'></div></div>" ).insertAfter( select ).slider({
              min: 1,
              max: 12,
              range: "min",
              value : $("#modal-edit-part .modal-body #minbeds").val(),
              slide: function( event, ui ) {
                select.val (ui.value);
                select.change();
              }
            }); 
            $("#modal-edit-part .modal-body #custom-handle" ).text($("#modal-edit-part .modal-body #minbeds").val()); 
            var filemanager = $("#modal-edit-part #open-file-manage").Scfilemanagers({
              base_url : "<?php echo base_url();?>", 
              before : function(){
                this.query.max_file = $("#modal-edit-part #open-file-manage").attr("data-max");
                this.query.type_file = $("#modal-edit-part #open-file-manage").attr("data-type");
              },
              beforchoose : function(val){
                var max_file = this.query.max_file;
                var id = $("#modal-edit-part #box-info-part [name='id']").val();
                $.ajax({
                  url  : "<?php echo base_url("blocks/value_part")?>",
                  type : "post",
                  dataType : "json",
                  data : {id : id},
                  success : function(r){
                    if(r.status == "success"){
                      var html = "";
                      var s ="";
                      var response = r.response;
                      var ids_media = [];
                      $.each(val,function(k,v){
                        if(max_file > 1){
                          s = response.replace("{{value}}",v.thumb);
                        }else{
                          s = response.replace("{{value}}",v.medium);
                        }
                        html += '<div data-id="'+v["id"]+'" class="info-item">'+s+'</div>';
                      }); 
                      if(max_file > 1){
                        $("#modal-edit-part #content-list").append(html);  
                      }else{
                        $("#modal-edit-part #data-show-value").html(html); 
                      }
                      $.each($("#modal-edit-part #content-list .info-item"),function(){
                        ids_media.push($(this).attr("data-id"));
                      });
                      $("#modal-edit-part #box-info-part #list_media").val(ids_media.join(","));          
                    }
                  },error : function(r){

                  }
                });
              },
              after : function (){
                $("body").addClass("modal-open");
              }             
            });
            $("#container-block").sortable("refresh");
            show_data_type();
          }else{
            alert("Error ! Please try again your action");
          }
        }
        ,error:function(e){
          alert("Error ! Please try again your action");
        }
      })
    }
  });
  $(document).on("click","#container-block .block-part #edit-part",function(){
    var info_box = $(this).closest(".block-part").find("#box-info-part");
    var id = info_box.find("[name='id']").val();
    if(id){
      $("#modal-edit-part").modal();
      $.ajax({
        url : "<?php echo base_url("blocks/update_part_block")?>",
        type:"post",
        dataType:"json",
        data:{id:id},
        success : function(r){
          $("#modal-edit-part .modal-body").html(r.response);
          var select = $("#modal-edit-part .modal-body #minbeds");
          var slider = $( "<div id='slider'><div id='custom-handle' class='ui-slider-handle'></div></div>" ).insertAfter( select ).slider({
            min: 1,
            max: 12,
            range: "min",
            value : $("#modal-edit-part .modal-body #minbeds").val(),
            slide: function( event, ui ) {
              select.val (ui.value);
              select.change();
            }
          }); 
          $("#modal-edit-part .modal-body #custom-handle" ).text($("#modal-edit-part .modal-body #minbeds").val()); 
          var filemanager = $("#modal-edit-part #open-file-manage").Scfilemanagers({
            base_url : "<?php echo base_url();?>",
            before : function(){
              this.query.max_file = $("#modal-edit-part #open-file-manage").attr("data-max");
              this.query.type_file = $("#modal-edit-part #open-file-manage").attr("data-type");
            },
            beforchoose : function(val){
              var max_file = this.query.max_file;
              var id = $("#modal-edit-part #box-info-part [name='id']").val();
              $.ajax({
                url  : "<?php echo base_url("blocks/value_part")?>",
                type : "post",
                dataType : "json",
                data : {id : id},
                success : function(r){
                  if(r.status == "success"){
                    var html = "";
                    var s ="";
                    var response = r.response;
                    var ids_media = [];
                    $.each(val,function(k,v){
                      if(max_file > 1){
                        s = response.replace("{{value}}",v.thumb);
                      }else{
                        s = response.replace("{{value}}",v.medium);
                      }
                      html += '<div data-id="'+v["id"]+'" class="info-item">'+s+'</div>';
                    }); 
                    if(max_file > 1){
                      $("#modal-edit-part #content-list").append(html);  
                    }else{
                      $("#modal-edit-part #data-show-value").html(html); 
                    }
                    $.each($("#modal-edit-part #content-list .info-item"),function(){
                      ids_media.push($(this).attr("data-id"));
                    });
                    $("#modal-edit-part #box-info-part #list_media").val(ids_media.join(","));
                  }
                },error : function(r){

                }
              });
            },
            after : function (){
              $("body").addClass("modal-open");
            }     
          });
          $("#modal-edit-part #content-list").sortable({
            connectWith: "#content-list",
          });
          show_data_type();
        },
        error : function(r){
          console.log(r);
        }
      })
    }
  });
  $(document).on("submit","#modal-edit-part #edit-part-form",function(){
    var data = $(this).serialize();
    $.ajax({
      url : "<?php echo base_url("blocks/save_block_part");?>",
      type:"post",
      data : data,
      dataType : "json",
      success : function(r){
        if(r.status == "success"){
          var id = r.post.id ;
          var c = $("#container-block .item-part-block[data-id ="+id+"]").attr("class");
          var cl = $("#container-block .item-part-block[data-id ="+id+"]").attr("data-colum");
          c = c.replace(cl,r.post.minbeds);
          $("#container-block > div[data-id ="+id+"]").attr("class",c);
          $("#container-block > div[data-id ="+id+"]").attr("data-colum",r.post.minbeds);
        }
        $("#modal-edit-part").modal("hide");
      },error : function(e){
        console.log(e);
      }
    });
    return false;
  });
  $(document).on("click","#content-list .item-list .delete-item",function(){
    var p  = $(this).closest(".block-part");
    $(this).closest(".info-item").remove();
    var list_media = [];
    $.each(p.find("#content-list .info-item"),function(){
      list_media.push($(this).attr("data-id"));
    });
    p.find("#box-info-part #list_media").val(list_media.join(","));
  });
  $(document).on("click","#container-block .item-part-block #delete-part",function(){
    $(this).closest(".item-part-block").remove();
  });
  function show_data_type(){
    $.each($("#modal-edit-part [data-show]"),function(){
      if($(this).attr("data-show") == "editer"){
        $(this).tinymce(
        {
          height: 300,
          menubar: false,
          plugins: [
              'advlist autolink lists link image charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code'
          ],
          toolbar: ' styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        }); 
      }else if($(this).attr("data-show") == "datetime"){
        $(this).datetimepicker({
          format: 'd/m/Y H:i',
          formatDate: 'd/m/Y H:i',
        });
      }
      else if($(this).attr("data-show") == "day"){
        $(this).datetimepicker({
          timepicker: false,
          format: 'd/m/Y',
          formatDate: 'd/m/Y',
        });
      }
      else if($(this).attr("data-show") == "month"){
        $(this).datetimepicker({
          timepicker: false,
          format: 'm',
          formatDate: 'm',
          viewMode  :"months"
        });
      }
      else if($(this).attr("data-show") == "year"){
        $(this).datetimepicker({
          timepicker: false,
          format: 'Y',
          formatDate: 'Y',
          viewMode: "years", 
          minViewMode: "years"
        });
      } else if($(this).attr("data-show") == "hours"){
        $(this).datetimepicker({
          datepicker: false,
          format: 'H:i',
          formatDate: 'H:i'
        });
      } else if($(this).attr("data-show") == "map"){
        var mapdiv = $(this)[0];
        var map    = new google.maps.Map(mapdiv,{
          zoom: 6,
          center: {lat: -34.397, lng: 150.644},
        });
        setTimeout(function() {
          google.maps.event.trigger(map, "resize");
          map.setCenter({lat: -34.397, lng: 150.644});
        }, 200);
      }
    });
  }
  $("#modal-edit-part").on("hidden.bs.modal",function(){
    $.each($("#modal-edit-part [data-show]"),function(){
      if($(this).attr("data-show") == "editer"){
        $(this).tinymce().remove();
      }else if($(this).attr("data-show") == "datetime" || $(this).attr("data-show") == "day" || $(this).attr("data-show") == "month" || $(this).attr("data-show") == "year" || $(this).attr("data-show") == "hours"){
        $(this).datetimepicker('destroy');
      }
    });
    $(this).find(".modal-body").html("");
  });
  $.each($("select[value]"),function(){
    $(this).val($(this).attr("value"));
  });
</script>

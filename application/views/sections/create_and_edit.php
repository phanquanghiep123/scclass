
<link rel="stylesheet" href="<?php echo skin_url("css/font-awesome.css");?>" rel="stylesheet" />
<div class="is_page" id="page_parts">
  <div class="row">
    <form method="post" action="<?php echo base_url($action_save)?>">
      <div class="form-group">
        <label for="name" class="col-sm-4 col-form-label">Section name</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" id="name" value="<?php echo @$post["name"]?>" required="required">
        </div>
      </div>
      <div class="form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Full content</label>
        <div class="col-sm-8">
          <select name="is_full" value="<?php echo @$post["is_full"]?>" class="form-control" required="required">
            <option value="">--select a item--</option>
            <option value="0">no</option>
            <option value="1">yes</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="class_name" class="col-sm-4 col-form-label">Class name</label>
        <div class="col-sm-8">
          <input type="text" name="class_name" class="form-control" id="class_name" value="<?php echo @$post["class_name"]?>">
        </div>
      </div>
      <div class="form-group">
        <label for="id_name" class="col-sm-4 col-form-label">Id name</label>
        <div class="col-sm-8">
          <input type="text" name="id_name" class="form-control" id="id_name" value="<?php echo @$post["id_name"]?>">
        </div>
      </div>
      <div class="form-group">
        <label for="sort" class="col-sm-4 col-form-label">Sort</label>
        <div class="col-sm-8">
          <input type="number" name="sort" class="form-control" id="sort" value="<?php echo @$post["sort"]?>">
        </div>
      </div>
      <div class="form-group">
        <label for="id_name" class="col-sm-4 col-form-label">Actions</label>
        <div class="col-sm-8">
          <div class="lable">
            <?php if(@$post["actions"]){
              foreach ($post["actions"] as $key => $value) {
                $active = "";
                if($value["active"] == 1){
                  $active = 'checked = "checked" ';
                }
               echo '<label><input id="action-item" name="actions[]" type="checkbox" value="'.$value["id"].'" '.$active.'>'.$value["name"].'</label>';
              }
            }?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Number row</label>
        <div class="col-sm-8">
          <select name="ncolum_block" value="<?php echo @$post["ncolum_block"]?>" class="form-control">
            <option value="">--select a item--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="6">6</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Default add block</label>
        <div class="col-sm-8">
          <select name="default_block" value="<?php echo @$post["default_block"]?>" class="form-control">
            <option value="">--select a item--</option>
            <?php if(@$post["blocks"]){
              foreach (@$post["blocks"] as $key => $value) {
                echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
              }
            }?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Status</label>
        <div class="col-sm-8">
          <select name="status" value="<?php echo @$post["status"]?>" class="form-control" required="required">
            <option value="">--select a item--</option>
            <option value="0">hidden</option>
            <option value="1">show</option>
          </select>
        </div>
      </div>
      <div class="col-sm-12">
          <div class="content-right">
            <div class="content-show-parts">
              <h3 class="text-center">Section content </h3>
              <div class="row">
                <div id="container-block">
                <?php if(@$post["my_blocks"] != null){
                  $html = "";
                  foreach ($post["my_blocks"] as $key => $value) {
                    $b = $value;
                    if($b){ 
                        $sbId  = $b["section_block_id"];
                        if($sbId){       
                            $html .= '<div data-colum="'.$value["ncolum"].'" data-id="'.$sbId.'" class="block-item col-md-'.$value["ncolum"].' ui-sortable-handle"><div class="wrapper-block">
                            <h4 class="block-title text-center">'.$b["name"].'</h4>
                            <div class="menu-action" id="support_block">
                              <ul class="menu-block">
                                <li><a href="javascript:;" id="edit-block"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;" id="add-part"><i class="fa fa-plus-square" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;" id="delete-block"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                              </ul>
                              <input type="hidden" value="'.$sbId.'" name="section_block_id[]">
                            </div>
                            <div id="list-part">';
                            $ps = $value["ps"];
                            if($ps){
                              foreach ($ps as $key_1 => $value_1) {    
                                  $as = $value_1["actions"];
                                  $as_html = "";
                                  if($as){
                                    $as_html = '<div class="menu-action" id="support_part"><ul class="menu-block">';
                                    foreach ($as as $key_2 => $value_2) {
                                      if($value_2["active"] == 1){
                                        $as_html .= '<li><a href="javascript:;" id="'.$value_2["key_id"].'-part">'.$value_2["icon"].'</a></li>';
                                      }
                                    }
                                    $as_html .= '</ul></div>';
                                } 
                                $html .= '
                                <div data-colum="'.$value_1["ncolum"].'" data-id="'.$value_1["block_part_id"].'" class="item-part-block col-md-'.$value_1["ncolum"].' ui-sortable-handle"> 
                                  <div class="block-part">
                                    <h3 class="title-block">'.$value_1["name"].'</h3>
                                    '.$as_html.'
                                  </div>
                                </div>'; 
                              }
                            }
                            $html .= '</div>';
                        }
                      }
                      $html .= '</div></div>';
                  }
                  echo $html;
                }?>          
                </div>
                <h3 class="text-center block-add-new"><a id="add-block" href="javascript:;">+ add block<a></a>
              </div>
              <input type="hidden" name="ramkey" value="<?php echo $ramkey?>">
            </div>
            <div class="form-group">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary mb-2"><?php echo @$post["id"] != null ? "Update" : "Add new";?></button>
              </div>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>
<div id="modal-edit-block" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <form id="edit-block-form">
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
<div id="modal-all-block" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <ul class="nav-parts">
          <?php if(@$post["blocks"] != null){
            foreach ($post["blocks"] as $key => $value) {
              echo '<li class="item-part" data-id="'.$value["id"].'" >
              <p data-id="'.$value["id"].'">'.$value["name"].'</p>
            </li>';
            }
          }?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="add-block">Add</button>
      </div>
    </div>
  </div>
</div>

<div id="modal-all-part" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <ul class="nav-parts">
          <?php if(@$post["parts"] != null){
            foreach ($post["parts"] as $key => $value) {
              echo '<li class="item-part" data-id="'.$value["id"].'" >
              <p data-id="'.$value["id"].'">'.$value["name"].'</p>
            </li>';
            }
          }?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="add-part">Add</button>
      </div>
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
  .nav-parts > li p{
    padding: 10px;
    background: #fff;
    border: 1px solid #f1f1f1;
    font-size: 23px;
    color: #000;
  }
  .nav-parts li{
    list-style: none;
    width: 49%;
    padding: 0.5%;
    display: inline-block;
    position: relative;
  }
  .nav-parts li > p{
    margin: 0; 
    cursor: pointer;
    text-transform: capitalize;
  }
  .nav-parts > li > p:hover,.nav-parts > li.active > p {
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
    margin-left: 10px;
  }
  .modal .box-full{
    width: 100%;
    text-align: left;
    margin-bottom: 20px; 
    border: 1px solid #f1f1f1;
  }
  .modal ul {margin: 0;padding: 0;}
  .modal ul li {list-style: none;}
  .modal ul.action-list li {display: inline-block;}
  .lable label { margin-left: 10px;font-weight: 100; }
  .lable label input{ margin-right: 5px; }
  .modal .box-action .lable {line-height: 0.7;};
  .modal .ui-slider{margin-top: 5px;}
  .modal textarea{
    width: 100%;
  }
  .modal input[type='text']{
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
    z-index: 99;
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
   .modal .part-item #toggle-upload-file {
    margin-top: 20px; 
  }
  .modal .part-item #open-file-manage{
    margin-bottom: 20px
  }
  .modal .part-item{
    padding: 10px 0px;
  }
  .modal .part-item textarea{
    height: 300px;
  }
  .modal #content-list{
    margin-bottom: 20px;
    max-height: 325px;
    overflow-y: auto;
  }
  .block-add-new{
    position: absolute;
    left: 0;
    right:0;
    bottom: 10px;
    text-align: center;
    z-index: 8;
  }
  #container-block .wrapper-block{
    float: left;
    width: 100%;
    border: 1px solid;
    padding: 10px 0px 0px 0px;
    position: relative;
    margin-bottom: 10px;
    background: #fff;
  }
  #container-block .wrapper-block .tem-part-block{
    position: relative;
  }
  #container-block .wrapper-block #support_block{
     right: 15px;
  }
  #container-block .wrapper-block .block-title{
    margin-top: 0px;
  }
  form .mb-2{
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
    position: relative;
    z-index: 99;
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
  var id = $(".modal #box-info-part [name='id']").val();
  var section_id = <?php echo @$post["id"] ? $post["id"] : 0;?>;
  var section_block_id = 0;
  $("#container-block").sortable({
    connectWith: "#content-list",
  });
  var stop_ui_part = function( event, ui ){
    var p = ui.item.closest(".block-item");
    var part_ids = [];
    var sb_id    = p.attr("data-id");
    $.each(p.find("#list-part .item-part-block"),function(){
      part_ids.push($(this).attr("data-id"));
    });
    $.ajax({
      url : "<?php echo base_url("blocks/sort")?>",
      type:"post",
      dataType:"json",
      data : {sb : sb_id , items : part_ids,ramkey:ramkey},
      success : function(r){
        //console.log(r);
      },error:function(){

      }
    });
  }
  $("#container-block #list-part").sortable({
    connectWith: "#list-part",
    stop : stop_ui_part
  });
  $(document).on("change","#minbeds", function() {
    var handle = $(this).parent().find( "#custom-handle" );
    handle.text( $(this).val() );
  });
  $.each($("select[value]"),function(){
    $(this).val($(this).attr("value"));
  });
  var beforchoose = function (val){
    var max_file = this.query.max_file;
    var id = $(".modal #box-info-part [name='id']").val();
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
            s = s.replace("{{media_id}}",v.id);
            html += '<div data-id="'+v["id"]+'" class="info-item">'+s+'</div>';
          }); 
          if(max_file > 1){
            $(".modal #content-list").append(html);  
          }else{
            $(".modal #data-show-value").html(html); 
          }     
        }
      },error : function(r){
        alert("Error ! Please try again your action");
      }
    });
  }
  var before = function (){
    this.query.max_file = $(".modal #open-file-manage").attr("data-max");
    this.query.type_file = $(".modal #open-file-manage").attr("data-type");
    var length_medias = $(".modal #content-list .info-item").length;
    if(length_medias >= this.query.max_file && this.query.max_file > 1){
      alert("Please select up to "+this.query.max_file+" media file");
      return false;
    }
  }
  function show_data_type(){
    $.each($(".modal [data-show]"),function(){
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
  $(document).ready(function(){
    $(".block-add-new #add-block").click(function(){
      $("#modal-all-block").modal();
    });
    $(".item-part p").click(function(){
      $(this).parent().toggleClass("active");
    });
    $("#modal-all-block #add-block").click(function(){
      var ids  = [];
      $.each($("#modal-all-block .item-part.active"),function(){
        ids.push($(this).attr("data-id"));
      });
      $.ajax({
        url      : "<?php echo base_url("sections/add_blocks")?>",
        type     : "post",
        dataType : "json",
        data     : {ids : ids , ramkey : ramkey, section_id : section_id},
        success : function(r){
          if(r.status == "success"){
            $("body #container-block").append(r.response);
            $("#container-block").sortable("refresh");
            try {
              $("#container-block #list-part").sortable("refresh");
            }catch(e){
              $("#container-block #list-part").sortable({
                connectWith: "#list-part",
                stop : stop_ui_part
              });
            }
          }else{
            alert("Error ! Please try again your action");
          } 
        },
        error: function(){
          alert("Error ! Please try again your action");
        }
      });
    });
    $("#modal-all-part #add-part").click(function(){
      var ids  = [];
      $.each($("#modal-all-part .item-part.active"),function(){
        ids.push($(this).attr("data-id"));
      });
      var sort = $("#container-block .block-item[data-id = "+section_block_id+"] .item-part-block").length;
      $.ajax({
        url      : "<?php echo base_url("sections/add_parts")?>",
        type     : "post",
        dataType : "json",
        data     : {ids : ids ,section_block_id : section_block_id ,ramkey : ramkey,sort:sort},
        success : function(r){
          if(r.status == "success"){
            $("body #container-block .block-item[data-id="+section_block_id+"]").append(r.response);
            $("#container-block #list-part").sortable("refresh");
          }else{
            alert("Error ! Please try again your action");
          } 
        },
        error: function(){
          alert("Error ! Please try again your action");
        }
      });
    });
  });
  $(document).on("click","#container-block #support_part #edit-part",function(){
    var info_box = $(this).closest(".item-part-block");
    var id = info_box.attr("data-id");
    section_block_id = info_box.closest(".block-item").attr("data-id");
    if(id){
      $("#modal-edit-part").modal();
      $.ajax({
        url : "<?php echo base_url("blocks/update_part_block")?>",
        type:"post",
        dataType:"json",
        data:{id:id,ramkey : ramkey, section_block_id : section_block_id},
        success : function(r){
          $("#edit-part-form .modal-body").html(r.response);
          var select = $("#edit-part-form .modal-body #minbeds");
          var slider = $( "<div id='slider'><div id='custom-handle' class='ui-slider-handle'></div></div>" ).insertAfter( select ).slider({
            min: 1,
            max: 12,
            range: "min",
            value : $("#edit-part-form .modal-body #minbeds").val(),
            slide: function( event, ui ) {
              select.val (ui.value);
              select.change();
            }
          }); 
          $("#edit-part-form .modal-body #custom-handle" ).text($("#edit-part-form .modal-body #minbeds").val()); 
          var filemanager = $("#edit-part-form #open-file-manage").Scfilemanagers({
            base_url : "<?php echo base_url();?>",
            before   : before,
            beforchoose : beforchoose,
            after : function (){
              $("body").addClass("modal-open");
            }     
          });
          $("#edit-part-form #content-list").sortable({
            connectWith: "#content-list",
          });
          show_data_type();
        },
        error : function(r){
          alert("Error ! Please try again your action");
        }
      })
    }
  });
  $(document).on("click","#container-block #support_block #edit-block",function(){
    section_block_id =  $(this).closest(".block-item").attr("data-id");
    if(section_block_id){
      $("#modal-edit-block").modal();
      $.ajax({
        url : "<?php echo base_url("sections/edit_block")?>",
        type:"post",
        dataType:"json",
        data:{id:section_block_id},
        success : function(r){
          $("#modal-edit-block .modal-body").html(r.response);
          var select = $("#modal-edit-block .modal-body #minbeds");
          var slider = $( "<div id='slider'><div id='custom-handle' class='ui-slider-handle'></div></div>" ).insertAfter( select ).slider({
            min: 1,
            max: 12,
            range: "min",
            value : $("#modal-edit-block .modal-body #minbeds").val(),
            slide: function( event, ui ) {
              select.val (ui.value);
              select.change();
            }
          }); 
          $("#modal-edit-block .modal-body #custom-handle" ).text($("#modal-edit-block .modal-body #minbeds").val()); 
          var filemanager = $("#modal-edit-block #open-file-manage").Scfilemanagers({
            base_url : "<?php echo base_url();?>",
            before   : before,
            beforchoose : beforchoose,
            after : function (){
              $("body").addClass("modal-open");
            }     
          });
          $("#modal-edit-block #content-list").sortable({
            connectWith: "#content-list",
          });
          show_data_type();
        },
        error : function(r){
          alert("Error ! Please try again your action");
        }
      })
    }
  });
  $(document).on("click","#container-block #support_block #delete-block",function(){
    var c = confirm("Are you want delete it!");
    if(c){
      section_block_id =  $(this).closest(".block-item").attr("data-id");
      if(section_block_id){
        $.ajax({
          url : "<?php echo base_url("sections/delete_block")?>",
          type:"post",
          dataType:"json",
          data:{id:section_block_id,$theme_id : 0},
          success : function(r){
            if(r.status == "success"){
              var id = r.post.id ;
              $("#container-block .block-item[data-id ="+id+"]").remove(); 
            }else{
              alert("Error ! Please try again your action");
            }  
          },
          error : function(r){
            alert("Error ! Please try again your action");
          }
        });
      }
    }
  });
  $(document).on("click","#container-block #support_block #add-part",function(){
    section_block_id =  $(this).closest(".block-item").attr("data-id");
    $("#modal-all-part").modal();
  });
  $(document).on("submit","#modal-edit-part #edit-part-form",function(){
    var data = $(this).serialize();
    data+="&ramkey="+ramkey+"&section_block_id="+section_block_id+""; 
    $.ajax({
      url : "<?php echo base_url("blocks/save_block_part");?>",
      type:"post",
      data : data,
      dataType : "json",
      success : function(r){
        if(r.status == "success"){
          var id = r.post.id ;
          var c  = $("#container-block .wrapper-block .item-part-block[data-id ="+id+"]").attr("class");
          var cl = $("#container-block .wrapper-block .item-part-block[data-id ="+id+"]").attr("data-colum");
          c = c.replace(cl,r.post.minbeds);
          $("#container-block .wrapper-block .item-part-block[data-id ="+id+"]").attr("class",c);
          $("#container-block .wrapper-block .item-part-block[data-id ="+id+"]").attr("data-colum",r.post.minbeds);
          $("#modal-edit-part").modal("hide");
        }else{
          alert("Error ! Please try again your action");
        }   
      },error : function(e){
        console.log(e);
      }
    });
    return false;
  });
  $(document).on("submit","#modal-edit-block #edit-block-form",function(){
    var data = $(this).serialize();
    $.ajax({
      url : "<?php echo base_url("sections/save_block");?>",
      type:"post",
      data : data,
      dataType : "json",
      success : function(r){
        if(r.status == "success"){
          var id = r.post.id ;
          var c  = $("#container-block .block-item[data-id ="+id+"]").attr("class");
          var cl = $("#container-block .block-item[data-id ="+id+"]").attr("data-colum");
          c = c.replace(cl,r.post.minbeds);
          $("#container-block .block-item[data-id ="+id+"]").attr("class",c);
          $("#container-block .block-item[data-id ="+id+"]").attr("data-colum",r.post.minbeds);
          $("#modal-edit-block").modal("hide");
        }else{
          alert("Error ! Please try again your action");
        }        
      },error : function(e){
        console.log(e);
      }
    });
    return false;
  });
  $("#modal-edit-part,#modal-edit-block").on("hidden.bs.modal",function(){
    $.each($("#modal-edit-part [data-show]"),function(){
      if($(this).attr("data-show") == "editer"){
        $(this).tinymce().remove();
      }else if($(this).attr("data-show") == "datetime" || $(this).attr("data-show") == "day" || $(this).attr("data-show") == "month" || $(this).attr("data-show") == "year" || $(this).attr("data-show") == "hours"){
        $(this).datetimepicker('destroy');
      }
    });
    $(this).find(".modal-body").html("");
  });
</script>

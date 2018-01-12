<?php 
  $actions = $post["actions"];

  $html_action = "<ul class='action-list'>";
  foreach ($actions as $key => $value) {
    $html_action .='<li><div class="checkbox">
      <label><input id="action-item" type="checkbox" value="'.$value["id"].'">'.$value["name"].'</label>
    </div></li>';
  }
  $html_action .= "</ul>";

?>
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
        <div class="col-sm-4">
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
                                <li><div id="slider-numcolum">
                                  <p class="lable">Rows:</p>
                                  <select class="none" name="minbeds" id="minbeds">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
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
        <div class="col-sm-8">
          <div class="content-right">
            <div class="content-show-parts">
              <h3 class="text-center">Block content</h3>
              <div id="container-block"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-primary mb-2"><?php echo @$post["id"] != null ? "Update" : "Add new";?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<style type="text/css">
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
    min-height: 300px
  }
  .list-parts #custom-handle {
    width: 1.2em;
    height: 1.2em;
    top: 50%;
    margin-top: -.6em;
    text-align: center;
    line-height: 1em;
    font-size: 0.7em;
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
  #slider-numcolum #slider {
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
</style>
<script type="text/javascript" src="<?php echo skin_url("/filemanager/filemanager.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo skin_url("/jquery-ui/jquery-ui.min.css")?>">
<script type="text/javascript" src="<?php echo skin_url("/jquery-ui/jquery-ui.min.js")?>"></script>
<script type="text/javascript">
  $(document).on("change","#slider-numcolum #minbeds", function() {
    var handle = $(this).parent().find( "#custom-handle" );
    handle.text( $(this).val() );
  });
  $.each($("#slider-numcolum #minbeds"),function(){
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
    var c  = $(this).parent().find("#slider-numcolum #minbeds").val();
    var a  = [];
    $.each ($(this).parent().find(".action-list #action-item:checked"),function(){
      a.push($(this).val());
    });
    if(id){
      $.ajax({
        type:"post",
        dataType:"json",
        url : "<?php echo base_url("parts/get");?>",
        data:{id : id,colum : c , actions : a},
        success : function (r){

        },
        error : function (){

        }
      })
    }
  });
</script>

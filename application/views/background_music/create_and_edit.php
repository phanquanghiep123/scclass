<link rel="stylesheet" href="<?php echo skin_url("css/font-awesome.css");?>" rel="stylesheet" />
<div class="is_page" id="page_parts">
  <div class="row">
    <form method="post" action="<?php echo base_url($action_save)?>">
      <div class="row form-group">
        <label for="name" class="col-sm-4 col-form-label">Tên</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" id="name" value="<?php echo @$post["name"]?>" required="required">
        </div>
      </div>

      <div class="row form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Nhóm</label>
        <div class="col-sm-8">
          <select name="group_id" value="<?php echo @$post["group_id"]?>" class="form-control" required="required">
            <option value="">--Thuộc nhóm--</option>
            <?php if($groups != null){
              foreach ($groups as $key => $value) {
                echo '<option value="'.$value['id'].'">'.$value['name']. '('.$value['type'].')</option>';
              }
            }?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Media file</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="path_name" name="path_name" value="<?php echo @$post["path_name"]?>" required="required" readonly="">
          <input type="hidden" value="<?php echo @$post["media_id"]?>" class="form-control" id="media_id" name="media_id" value="" required="required">
        </div>
        <div class="col-sm-3"><a id="choose-file-html" class="btn btn-primary">Chọn file</a></div>
      </div>
      <div class="row form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
          <select name="status" value="<?php echo @$post["status"]?>" class="form-control" required="required">
            <option value="">--chọn trạng thái--</option>
            <option value="0">ẩn</option>
            <option value="1">hiện</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-primary mb-2"><?php echo @$post["id"] != null ? "Update" : "Add new";?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="<?php echo skin_url("/filemanager/filemanager.js")?>"></script>
<script type="text/javascript">
  $('#choose-file-html').Scfilemanagers({
    base_url : "<?php echo base_url();?>",
    query    : {
      max_file  : 1,
    },
    beforchoose : function(val){
      $("#path_name").val(val[0].name);
      $("#media_id").val(val[0].id);
    }
  });
  $.each($("select[value]"),function(){
    $(this).val($(this).attr("value"));
  });
  $("#select_type").change(function(){
    var t = $(this).val();
  });
</script>
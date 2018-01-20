<link rel="stylesheet" href="<?php echo skin_url("css/font-awesome.css");?>" rel="stylesheet" />
<div class="is_page" id="page_parts">
  <div class="row">
    <form method="post" action="<?php echo base_url($action_save)?>">
      <div class="row form-group">
        <label for="name" class="col-sm-4 col-form-label">Tên nhóm</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" id="name" value="<?php echo @$post["name"]?>" required="required">
        </div>
      </div>
      <div class="row form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Ảnh đại diện</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="path_name" name="path_name" value="<?php echo @$post["path_name"]?>" required="required" readonly="">
          <input type="hidden" value="<?php echo @$post["thumb"]?>" class="form-control" id="thumb" name="thumb" value="">
        </div>
        <div class="col-sm-3"><a id="choose-file-html" class="btn btn-primary">Chọn file</a></div>
      </div>
      <div class="row form-group">
        <label for="path_html" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
          <select name="type" value="<?php echo @$post["type"]?>" class="form-control" required="required">
            <option value="">--Dành cho--</option>
            <option value="background">background</option>
            <option value="music">music</option>
          </select>
        </div>
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
      type_file : "image"
    },
    beforchoose : function(val){
      $("#path_name").val(val[0].name);
      $("#thumb").val(val[0].id);
    }
  });
  $.each($("select[value]"),function(){
    $(this).val($(this).attr("value"));
  });
</script>
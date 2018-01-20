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
        <label for="html_edit" class="col-sm-4 col-form-label">Html edit</label>
        <div class="col-sm-8">
          <textarea name="html_edit" class="form-control" id="html_edit" required="required"><?php echo htmlspecialchars(@$post["html_edit"])?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="html_show" class="col-sm-4 col-form-label">Html show</label>
        <div class="col-sm-8">
          <textarea name="html_show" class="form-control" id="name" required="required"><?php echo htmlspecialchars(@$post["html_show"])?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="list_show" class="col-sm-4 col-form-label">List show</label>
        <div class="col-sm-8">
          <textarea name="list_show" class="form-control" id="list_show" required="required"><?php echo htmlspecialchars(@$post["list_show"])?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="status" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
          <select name="status" value="<?php echo @$post["status"]?>" class="form-control" required="required">
              <option value="">--chọn trạng thái--</option>
              <option value="0" selected="true">ẩn</option>
              <option value="1">hiện</option>
          </select>
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
</style>
<script type="text/javascript" src="<?php echo skin_url("/filemanager/filemanager.js")?>"></script>
<script type="text/javascript">
  $(document).ready (function(){
    $('#choose-file-html').Scfilemanagers({
        base_url : "<?php echo base_url();?>",
        query    : {
          max_file  : 1,
          type_file : "text",
          ext_filter: "html"
        },
        beforchoose : function(val){
          $("#path_name").val(val[0].name);
          $("#path_html").val(val[0].id);
        }
    });
    $.each($("select[value]"),function(){
      $(this).val($(this).attr("value"));
    });
  });
</script>

<div class="is_page" id="page_parts">
    <form method="post">
      <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Tên phần</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" id="name" value="">
        </div>
      </div>
      <div class="form-group row">
        <label for="path_html" class="col-sm-4 col-form-label">File html</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="path_html" name="path_html" value="">
        </div>
        <div class="col-sm-3"><a id="choose-file-html" class="btn btn-primary">Chọn file</a></div>
      </div>
      <div class="form-group row">
        <label for="path_html" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
          <select name="status" class="form-control">
              <option value="0" selected="true">ẩn</option>
              <option value="1">hiện</option>
          </select>
        </div>
      </div>
       <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
    </form>
</div>
<script type="text/javascript" src="<?php echo skin_url("/filemanager/filemanager.js")?>"></script>
<script type="text/javascript">
  $(document).ready (function(){
    $('#choose-file-html').Scfilemanagers({
        base_url : "<?php echo base_url();?>",
        query    : {
            max_file  : 1,
            type_file : "file",
            ext_filter: "html"
        },
        beforchoose : function(val){
            console.log(val);
        }
    });
  });

</script>
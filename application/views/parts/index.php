
<div class="x_content">
	<table class="table table-striped jambo_table bulk_action">
		<thead>
			<tr class="headings">
				<th>#</th>
				<th>Tên</th>
				<th>Path html</th>
				<th>Name html</th>
				<th>Trạng thái</th>
				<th>Ngày tạo</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php if(@$parts != null){
				$i = 1;
				foreach ($parts as $key => $value) {
					echo '<tr>';
					echo '<td>'. ($i++) .'</td>';
					echo '<td>'. $value["name"] .'</td>';
					echo '<td>'. $value["path"] .'</td>';
					echo '<td>'. $value["name_path"] .'</td>';
					echo '<td>'. ($value["status"] == 0 ? "ẩn": " hiện") .'</td>';
					echo '<td>'. $value["created_at"] .'</td>';
					echo '<td><a href="'.base_url($_cname."/edit/".$value["id"]).'">edit</a> | <a href="'.base_url($_cname."/delete/".$value["id"]).'">delete</a></td>';
					echo '</tr>';
				}
			}?>
		</tbody>
	</table>
	<?php echo $this->pagination->create_links(); ?>
</div>
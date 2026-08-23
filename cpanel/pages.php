<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['pg_title']?></h3>
		<div class="pt-options">
			<a href="<?=path?>/dashboard.php?pg=pages&request=new" class="pt-btn"><i class="fas fa-plus"></i> Create a Page</a>
		</div>
	</div>
	<?php if ($request != 'new'): ?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th>Page title</th>
				<th class="text-center">Header</th>
				<th class="text-center">Footer</th>
				<th class="text-center">Created at</th>
				<th class="text-center">Updated at</th>
				<th></th>
			</thead>
			<tbody>
				<?php
				$sql = $db->query("SELECT * FROM ".prefix."pages ORDER BY sort ASC");
				if($sql->num_rows):
				while($rs = $sql->fetch_assoc()):
				?>
				<tr>
					<td width="40%">
						<a href="<?=path?>/pages.php?id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><b><?=$rs['title']?></b></a>
					</td>
					<td class="text-center"><?=($rs['header']?'<b class="pt-plan-badg p2">No</b>':'<b class="pt-plan-badg p1">Yes</b>')?></td>
					<td class="text-center"><?=($rs['footer']?'<b class="pt-plan-badg p2">No</b>':'<b class="pt-plan-badg p1">Yes</b>')?></td>
					<td class="text-center"><?=fh_ago($rs['created_at'])?></td>
					<td class="text-center"><?=($rs['updated_at']?fh_ago($rs['updated_at']):'--')?></td>
					<td class="pt-options">
						<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
						<ul class="pt-drop">
							<li><a href="<?=path?>/dashboard.php?pg=pages&request=new&id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['dashboard']['edit']?></a></li>
							<li><a href="#" class="pt-delete-page" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['delete']?></a></li>
						</ul>
					</td>
				</tr>
				<?php endwhile; ?>
				<?php else: ?>
					<tr>
						<td colspan="7" class="text-center"><?=$lang['alerts']['no-data']?></td>
					</tr>
				<?php endif; ?>
				<?php $sql->close(); ?>
			</tbody>
		</table>
	</div>
<?php else: ?>

<?php $rs = ($id ? db_rs("pages WHERE id = '{$id}'") : ''); ?>
<div class="p-4">
<form id="sendpage">
	<div class="form-group">
		<label>Page title <small class="text-danger">*</small></label>
		<input type="text" name="pg_title" placeholder="type the page name" value="<?=($rs?$rs['title']:'')?>">
	</div>

	<div class="form-group">
		<label>Page Sort</label>
		<input type="text" name="pg_sort" placeholder="type the page sort" value="<?=($rs?$rs['sort']:'')?>">
	</div>

	<div class="form-group">
		<input class="tgl tgl-light" id="cb2" value="1" name="footer" type="checkbox"<?=($rs?($rs['footer'] ? ' checked' : ''):'')?>/>
		<label class="tgl-btn" for="cb2"></label>
		<label>Don't show in Footer</label>
	</div>

	<div class="form-group">
		<input class="tgl tgl-light" id="cb3" value="1" name="header" type="checkbox"<?=($rs?($rs['header'] ? ' checked' : ''):'')?>/>
		<label class="tgl-btn" for="cb3"></label>
		<label>Don't show in header</label>
	</div>

	<div class="form-group">
		<label>Page Content <small class="text-danger">*</small></label>
		<textarea name="pg_content" class="wysibb-editor" id="wysibb-editor"><?=($rs?$rs['content']:'')?></textarea>
	</div>

	<hr>
	<button type="submit" class="pt-btn">Submit</button>
	<input type="hidden" name="id" value="<?=$id?>">
</form>
</div>

<?php endif; ?>
</div>

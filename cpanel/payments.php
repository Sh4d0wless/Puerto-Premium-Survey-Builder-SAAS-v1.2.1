<div class="pt-body">
<div class="pt-title">
	<h3><?=$lang['dashboard']['p_title']?></h3>
</div>
<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th scope="col"><?=$lang['dashboard']['p_user']?></th>
			<th scope="col"><?=$lang['dashboard']['p_status']?></th>
			<th scope="col"><?=$lang['dashboard']['p_plan']?></th>
			<th scope="col"><?=$lang['dashboard']['p_amount']?></th>
			<th scope="col"><?=$lang['dashboard']['p_date']?></th>
			<th scope="col"><?=$lang['dashboard']['p_txn']?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = $db->query("SELECT * FROM ".prefix."payments ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
		?>
		<tr>
			<th scope="row">

				<div class="pt-thumb">
					<img src="<?=db_get("users", "photo", $rs['author'])?>" title="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=nophoto?>'" />
				</div>
				<a href="#"><?=fh_user($rs['author'])?></a>
			</th>
			<td>
				<?=$rs['status']?>
			</td>
			<td>
				<span class="pt-plan-badg <?=( $rs['plan']=='Plan#1' ? 'p1' : ( $rs['plan']=='Plan#2' ? 'p2' : ( $rs['plan']=='Plan#3' ? 'p3' : '')))?>">
					<?=$rs['plan']?>
				</span>
			</td>
			<td>$<?=$rs['price']?></td>
			<td><?=fh_ago($rs['date'])?></td>
			<td><?=$rs['txn_id']?></td>
		</tr>
		<?php
		endwhile;
		echo '<tr><td colspan="8">'.fh_pagination("payments",$limit, path."/dashboard.php?pg=payments&").'</td></tr>';
		else:
			?>
			<tr>
				<td colspan="8">
					<?=fh_alerts($lang['alerts']["no-data"], "info")?>
				</td>
			</tr>
			<?php
		endif;
		$sql->close();
		?>
	</tbody>
</table>
</div>
</div>

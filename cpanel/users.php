<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['u_users']?></h3>
	</div>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th scope="col"><?=$lang['dashboard']['u_status']?></th>
				<th scope="col"><?=$lang['dashboard']['u_username']?></th>
				<th scope="col"><?=$lang['dashboard']['u_plan']?></th>
				<th scope="col"><?=$lang['dashboard']['u_credits']?></th>
				<th scope="col"><?=$lang['dashboard']['u_last_p']?></th>
				<th scope="col"><?=$lang['dashboard']['u_registred']?></th>
				<th scope="col"><?=$lang['dashboard']['u_updated']?></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."users ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
			if($sql->num_rows):
			while($rs = $sql->fetch_assoc()):
			?>
			<tr>
				<th scope="row" class="pt-status pt-userstatus">
					<input class="tgl tgl-light" id="cb<?=$rs['id']?>" value="<?=$rs['id']?>" type="checkbox"<?=($rs['moderat'] ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb<?=$rs['id']?>"></label>
				</th>
				<td>
					<div class="pt-thumb">
						<img src="<?=($rs['photo'] ? $rs['photo'] : nophoto)?>" onerror="this.src='<?=nophoto?>'" />
					</div>
					<a href="#"><?=$rs['username']?></a>
				</td>
				<td>
					<span class="pt-plan-badg <?=( $rs['plan']=='1' ? 'p1' : ( $rs['plan']=='2' ? 'p2' : ( $rs['plan']=='3' ? 'p3' : '')))?>">
						<?=($rs['plan']?'Plan#'.$rs['plan']:'--')?>
					</span>
				</td>
				<td><?=($rs['credits']?"$".$rs['credits']:'--')?></td>
				<td><?=($rs['lastpayment']?fh_ago($rs['lastpayment']):'--')?></td>
				<td><?=fh_ago($rs['date'])?></td>
				<td><?=($rs['updated_at']?fh_ago($rs['updated_at']):'--')?></td>
				<td class="pt-options">
					<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
					<ul class="pt-drop">
						<li><a href="<?=path?>/userdetails.php?id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['dashboard']['u_edit']?></a></li>
						<li><a href="#" class="pt-delete-user" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['u_delete']?></a></li>
					</ul>
				</td>
			</tr>
			<?php
			endwhile;
			echo '<tr><td colspan="8">'.fh_pagination("users",$limit, path."/dashboard.php?pg=users&").'</td></tr>';
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

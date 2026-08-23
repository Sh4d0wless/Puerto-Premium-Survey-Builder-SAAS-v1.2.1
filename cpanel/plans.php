<div class="pt-plans">
	<form class="pt-sendplans">
		<div class="pt-body mb-3">
				<input class="tgl tgl-light" id="cb1" value="1" name="site_plans" type="checkbox"<?=(!site_plans ? ' checked' : '')?>/>
				<label class="tgl-btn" for="cb1"></label>
				<label>Enable Plans</label>
		</div>
		<div class="row">
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."plans");
			while($rs = $sql->fetch_assoc()):
			?>
			<div class="col-3">
				<div class="pt-body">
				<?php foreach ($rs as $key => $value): ?>
					<?php if(!in_array($key, ['id', 'created_at', 'surveys_rapport', 'surveys_export', 'surveys_iframe', 'show_ads', 'survey_design', 'support'])): ?>
					<label> <?php if(in_array($key, ['surveys_month', 'surveys_steps', 'surveys_questions', 'surveys_answers'])): ?><b><?=str_replace('_',' ',$key)?></b> <?php endif;?>
						<input type="text" name="<?=$key?>[<?=$rs['id']?>]" placeholder="plan <?=$key?>" value="<?=$value?>">
					</label>
					<?php endif;?>
					<?php if(in_array($key, ['surveys_rapport', 'surveys_export', 'surveys_iframe', 'show_ads', 'survey_design', 'support'])): ?>
						<div class="mb-3">
							<input class="tgl tgl-light" id="<?=$key.$rs['id']?>" value="1"type="checkbox" name="<?=$key?>[<?=$rs['id']?>]"<?=($value==1?'checked':'')?>/>
							<label class="tgl-btn" for="<?=$key.$rs['id']?>"></label>
							<label><label><?=str_replace('_',' ',$key)?></label></label>
						</div>

					<?php endif;?>
				<?php endforeach;?>
			</div>
			</div>
			<?php
			endwhile;
			$sql->close();
			?>
		</div>
		<div class="pt-link">
			<button type="submit" class="fancy-button bg-gradient5">
				<span><?=$lang['dashboard']['set_btn']?> <i class="fas fa-arrow-circle-right"></i></span>
			</button>
		</div>
	</form>
</div>

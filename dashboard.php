<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Puerto Premium Survey 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤  Whatsapp: +212 654 211 360                ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 13/09/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

include __DIR__."/head.php";

if(us_level == 6):
?>
<link rel="stylesheet" href="<?=path?>/css/scroll.css">
<div class="pt-wrapper">
	<div class="pt-admin-nav">
		<div class="pt-logo"><i class="fas fa-fire"></i></div>
		<ul>
			<li><a href="<?=path?>/index.php"><i class="fas fa-home"></i><b></b></a></li>
			<li<?=($pg==""?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php"><i class="fas fa-tachometer-alt"></i><b></b></a></li>
			<li<?=($pg=="users"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=users"><i class="fas fa-users"></i><b></b></a></li>
			<li<?=($pg=="surveys"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=surveys"><i class="fas fa-poll"></i><b></b></a></li>
			<li<?=($pg=="plans"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=plans"><i class="fas fa-puzzle-piece"></i><b></b></a></li>
			<li<?=($pg=="payments"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=payments"><i class="fas fa-dollar-sign"></i><b></b></a></li>
			<li<?=($pg=="pages"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=pages"><i class="fas fa-copy"></i><b></b></a></li>
			<li<?=($pg=="setting"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=setting"><i class="fas fa-cogs"></i><b></b></a></li>
			<li><a href="#" class="pt-logout"><i class="fas fa-power-off"></i><b></b></a></li>
		</ul>
	</div>
	<div class="pt-admin-body">
		<div class="pt-welcome">
			<h3><?=$lang['dashboard']['hello']?> <?=us_username?>!</h3>
			<p><?=$lang['dashboard']['welcome']?></p>
			<span><i class="fas fa-chart-line"></i></span>
		</div>
		<div class="pt-stats">
			<ul>
				<li><span><i class="fas fa-poll"></i></span><b><?=$lang['dashboard']['surveys']?></b> <em><?=db_rows("survies")?></em></li>
				<li><span><i class="fas fa-users"></i></span><b><?=$lang['dashboard']['users']?></b> <em><?=db_rows("users")?></em></li>
				<li><span><i class="fas fa-hand-holding-heart"></i></span><b><?=$lang['dashboard']['responses']?></b> <em><?=db_rows("responses")?></em></li>
				<li><span><i class="far fa-question-circle"></i></span><b><?=$lang['dashboard']['questions']?></b> <em><?=db_rows("questions")?></em></li>
			</ul>
		</div>



		<?php
		if(!$pg):
			include __DIR__."/cpanel/main.php";
		elseif($pg == "plans"):
			include __DIR__."/cpanel/plans.php";
		elseif($pg == "surveys"):
			include __DIR__."/cpanel/surveys.php";
		elseif($pg == "users"):
			include __DIR__."/cpanel/users.php";
		elseif($pg == "payments"):
			include __DIR__."/cpanel/payments.php";
		elseif($pg == "pages"):
			include __DIR__."/cpanel/pages.php";
		elseif($pg == "setting"):
			include __DIR__."/cpanel/setting.php";
		endif;
	?>

		<div class="pt-footer">
			<div>
					Copyright © 2020 <a href="#">Puerto Premium Survey</a>. All Rights Reserved.<br>
					Programming and design by <a href="http://puertokhalid.com" target="_blanc">Puerto Khalid</a>.
			</div>
		</div>
	</div>
</div>
<?php
include __DIR__."/scripts.php";
else:
	echo '<meta http-equiv="refresh" content="0;url='.path.'">';
endif;
?>
</body>
</html>

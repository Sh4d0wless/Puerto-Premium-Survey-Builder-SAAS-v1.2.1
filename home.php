<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?=fh_title()?></title>

	<meta name="title" content="<?=fh_title()?>">
	<meta name="description" content="<?=site_description?>">
	<meta name="keywords" content="<?=site_keywords?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?=site_url?>">
	<meta property="og:title" content="<?=fh_title()?>">
	<meta property="og:description" content="<?=site_description?>">
	<meta property="og:image" content="<?=site_url?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?=site_url?>">
	<meta property="twitter:title" content="<?=fh_title()?>">
	<meta property="twitter:description" content="<?=site_description?>">
	<meta property="twitter:image" content="<?=site_url?>">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=path?>/<?=site_favicon?>" type="image/x-icon" />

	<link rel="stylesheet" href="//necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link rel="stylesheet" href="<?=path?>/css/all.min.css">
	<link rel="stylesheet" href="<?=path?>/css/simple-line-icons.css">

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

	<link rel="stylesheet" href="<?=path?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=path?>/css/flag-icon.min.css">
	<link rel="stylesheet" href="<?=path?>/css/home.css">
</head>
<body>

<div class="pt-wrapper">


	<div class="pt-header">

		<div class="pt-header-top">
			<div class="pt-container">
				<?php if ($lang['home']['email']): ?>
					<a><i class="far fa-envelope-open"></i> <?=$lang['home']['email']?></a>
				<?php endif; ?>
				<?php if ($lang['home']['phone']): ?>
					<a><i class="fas fa-phone-volume"></i> <?=$lang['home']['phone']?></a>
				<?php endif; ?>

				<?php if (!us_level): ?>
				<div class="right pt-login-form">
					<a class="pt-log"><?=$lang['home']['login']?></a>
					<ul class="pt-drops">
						<li>
							<form id="pt-send-signin">
							<label class="pt-input-icon">
								<span><i class="fas fa-user"></i></span>
								<input type="text" name="sign_name" placeholder="<?=$lang['login']['username']?>" />
							</label>
							<label class="pt-input-icon">
								<span><i class="fas fa-key"></i></span>
								<input type="password" name="sign_pass" placeholder="<?=$lang['login']['password']?>" />
							</label>
							<button type="submit"><?=$lang['login']['button']?></button>
							<?php if(site_register && (login_facebook || login_twitter || login_google)): ?>
							<div class="pt-social-login">
								<b>OR login using social media</b>
								<?php if(login_facebook): ?>
								<a class="facebook" href="<?=$facebookLoginUrl?>"><i class="fab fa-facebook"></i></a>
								<?php endif; ?>
								<?php if(login_twitter): ?>
								<a class="twitter" href="<?=$twitterLoginUrl?>"><i class="fab fa-twitter"></i></a>
								<?php endif; ?>
								<?php if(login_google): ?>
								<a class="google" href="<?=$googleLoginUrl?>"><i class="fab fa-google"></i></a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</form>
						</li>
					</ul>
				</div>
			<?php endif; ?>
				<a class="right" href="<?=path?>/pages.php?id=4&t=<?=fh_seoURL(db_get("pages","title",4))?>"><i class="fas fa-headset"></i> <?=$lang['home']['support']?></a>
			</div>
		</div>

		<div class="pt-container">
			<div class="pt-top-menu">
				<div class="pt-logo">
					<img src="<?=site_logo?>" alt="<?=site_title?>">
				</div>
				<div class="left pt-mobmenu">
					<a href="#" class="pt-mobmenulink"><i class="fas fa-bars"></i></a>
					<ul class="pt-left-menu pt-drop">
						<li><a href="<?=path?>"><?=$lang['home']['home']?></a></li>
						<?php
						$sql = $db->query("SELECT * FROM ".prefix."pages WHERE header = 0 ORDER BY sort ASC");
						if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
						?>
						<li><a href="<?=path?>/pages.php?id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><?=$rs['title']?></a></li>
						<?php endwhile; ?>
						<?php endif; ?>
						<?php $sql->close(); ?>
					</ul>
				</div>
				<ul class="pt-right-menu">
					<?php if( site_plans ): ?>
					<li><a href="<?=path?>/plans.php"><i class="far fa-gem"></i> <?=$lang['menu']['plans']?></a></li>
					<?php endif; ?>
					<li><a href="<?=path?>/mysurvies.php" class="pt-started"><?=(!us_level?$lang['home']['get']:$lang['menu']['my'])?></a></li>
					<?php if (us_level==6): ?>
					<li><a href="<?=path?>/dashboard.php" class="pt-started ml-1" title="<?=$lang['menu']['admin']?>"><i class="fas fa-cogs"></i></a></li>
					<?php endif; ?>

				</ul>
			</div>
		</div>

		<div class="pt-container">
			<div class="pt-context">
				<h3><?=$lang['home']['s_h']?></h3>
				<p><?=$lang['home']['s_p']?></p>
				<a href="<?=path?>/mysurvies.php"><i class="fas fa-fire"></i> <?=$lang['home']['s_b']?></a>
			</div>
		</div>

		<!-- SVGs -->
		<div class="svg"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div><div class="svg svg2"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div>
	</div>

	<div class="pt-section pt-features">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['sf_h']?></h3>
				<p><?=$lang['home']['sf_p']?></p>
			</div>

				<ul>
					<li>
						<div class="pt-content">
							<span><i class="icon-fire icons"></i></span>
							<h3><?=$lang['home']['sf_h1']?></h3>
							<p><?=$lang['home']['sf_p1']?></p>
							<a href="<?=path?>/<?=$lang['home']['sf_b1']?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-rocket icons"></i></span>
							<h3><?=$lang['home']['sf_h2']?></h3>
							<p><?=$lang['home']['sf_p2']?></p>
							<a href="<?=path?>/<?=$lang['home']['sf_b2']?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-speedometer icons"></i></span>
							<h3><?=$lang['home']['sf_h3']?></h3>
							<p><?=$lang['home']['sf_p3']?></p>
							<a href="<?=path?>/<?=$lang['home']['sf_b3']?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-pie-chart icons"></i></span>
							<h3><?=$lang['home']['sf_h4']?></h3>
							<p><?=$lang['home']['sf_p4']?></p>
							<a href="<?=path?>/<?=$lang['home']['sf_b4']?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
				</ul>

				<div class="pt-links">
					<a href="<?=path?>/plans.php"><span><i class="icon-diamond icons"></i> <?=$lang['home']['link1']?></span></a>
					<a href="<?=path?>/mysurveys"><span><i class="icon-question icons"></i> <?=$lang['home']['link2']?></span></a>
				</div>

				<div class="pt-stats">
					<div>
						<span><i class="icon-chart icons"></i></span>
						<strong><?=$lang['home']['stats_h1']?></strong>
						<b><?php echo db_rows("survies")?></b>
					</div>
					<div>
						<span><i class="icon-check icons"></i></span>
						<strong><?=$lang['home']['stats_h2']?></strong>
						<b><?php echo db_rows("responses")?></b>
					</div>
					<div>
						<span><i class="icon-people icons"></i></span>
						<strong><?=$lang['home']['stats_h3']?></strong>
						<b><?php echo db_rows("users")?></b>
					</div>
				</div>

		</div>
	</div>

	<div class="pt-section pt-topsurvys">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['top_h']?></h3>
				<p><?=$lang['home']['top_p']?></p>
			</div>

				<ul>
					<?php
					$sql = $db->query("SELECT s.id, s.author, s.title, COUNT(r.id) AS resp FROM ".prefix."survies AS s LEFT JOIN ".prefix."responses AS r ON(r.survey = s.id) WHERE s.private = 0 GROUP BY s.id ORDER BY COUNT(r.id) DESC LIMIT 3") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
						$firststep = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id ASC LIMIT 1");
						$laststep  = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
						$pourcent  = $firststep ? ceil(($laststep/$firststep)*100) : '--';
						$lastresp  = db_get("responses", "date", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
						$userphoto = db_get("users", "photo", $rs['author']);
					?>
					<li>
						<div class="media">
								<div class="pt-thumb">
									<img src="<?=($userphoto?$userphoto:nophoto)?>" title="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=nophoto?>'" />
								</div>
							<div class="pt-dtable">
							<div class="pt-vmiddle">
								<a href="<?=path?>/survey.php?id=<?=$rs['id']?>"><?=$rs['title']?></a>
								<p>
									<b><?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY ip", "ip")?></b> <?=$lang['home']['rel']?> <?=($lastresp?fh_ago($lastresp):'--')?>
								</p>
							</div>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						?>
						<div>
								<?=fh_alerts($lang['alerts']["no-data"], "info")?>
						</div>
						<?php
					endif;
					$sql->close();
					?>
				</ul>

			</div>

	</div>

	<div class="pt-section pt-features">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['integ_h']?></h3>
				<p><?=$lang['home']['integ_p']?></p>
			</div>
			<div class="pt-iframe">
				<iframe src="<?=path?>/survey/14/view"></iframe>
			</div>
		</div>

	</div>

<div class="pt-footer">
	<!-- SVGs -->
	<div class="svg"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div><div class="svg svg2"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div>
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="pt-logo">
					<a href="#"><img src="<?=site_logo?>" /></a>
				</div>
				<div class="pt-social">
					<?php if (site_facebook): ?>
					<a href="https://facebook.com/<?=site_facebook?>" target="_blank"><i class="fab fa-facebook"></i></a>
					<?php endif; ?>
					<?php if (site_instagram): ?>
					<a href="https://instagram.com/<?=site_instagram?>" target="_blank"><i class="fab fa-instagram"></i></a>
					<?php endif; ?>
					<?php if (site_twitter): ?>
					<a href="https://twitter.com/<?=site_twitter?>" target="_blank"><i class="fab fa-twitter"></i></a>
					<?php endif; ?>
					<?php if (site_youtube): ?>
					<a href="https://youtube.com/<?=site_youtube?>" target="_blank"><i class="fab fa-youtube"></i></a>
					<?php endif; ?>
					<?php if (site_skype): ?>
					<a href="https://skype.com/<?=site_skype?>" target="_blank"><i class="fab fa-skype"></i></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-6">
				<div class="pt-links">
					<h3><?=$lang['home']['flinks']?></h3>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."pages WHERE footer = 0 ORDER BY sort ASC LIMIT 12");
          if($sql->num_rows):
          $i = 1;
          while($rs = $sql->fetch_assoc()):
          ?>
          <a href="<?=path?>/pages.php?id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><i class="fas fa-long-arrow-alt-right"></i> <?=$rs['title']?></a>
          <?php
          $i++;
          if($i==7){
            echo'</div><div class="pt-links"><h3>&nbsp;</h3>';
            $i=0;
          }
          endwhile;
          endif;
          $sql->close();
          ?>
				</div>
			</div>
			<div class="col-3">
				<div class="pt-copy">
					<h3>&nbsp;</h3>
					<div class="pt-lang">
						<a hrfe="#" rel="en"><i class="flag-icon flag-icon-squared flag-icon-us"></i></a>
						<a hrfe="#" rel="fr"><i class="flag-icon flag-icon-squared flag-icon-fr"></i></a>
						<a hrfe="#" rel="es"><i class="flag-icon flag-icon-squared flag-icon-es"></i></a>
						<a hrfe="#" rel="tr"><i class="flag-icon flag-icon-squared flag-icon-tr"></i></a>
						<a hrfe="#" rel="ar"><i class="flag-icon flag-icon-squared flag-icon-sa"></i></a>
					</div>
					Copyright &copy; 2020 <a href="<?=path?>"><?=site_title?></a>. All Rights Reserved.<br>
					Programming and design with <i class="fas fa-heart text-danger"></i> by <a href="http://puertokhalid.com" target="_blanc">Puerto Khalid</a>.
				</div>
			</div>
		</div>
	</div>

</div><!-- End footer -->


</div><!-- End Wrapper -->

<script>
	var path         = '<?=path?>';
	var lang         = <?=json_encode($lang)?>;
	var nophoto   = '<?=nophoto?>';
</script>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="<?=path?>/js/jquery.livequery.js"></script>
<script>
$(document).ready(function(){
	$.puerto_droped = function( prtclick, prtlist = "ul.pt-drop" ){
		$(prtclick).livequery('click', function(){
			var ul = $(this).parent();
			if( ul.find(prtlist).hasClass('open') ){
				ul.find(prtlist).removeClass('open');
				$(this).removeClass('active');
				if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
			} else {
				$("ul.pt-drop").parent().find(".active").removeClass('active');
				$("ul.pt-drop").removeClass('open');
				ul.find(prtlist).addClass('open');
				$(this).addClass('active');
				if(prtclick == ".pl-mobile-menu") $('body').addClass('active');
			}
			return false;
		});
		$("html, body").livequery('click', function(){
			$("ul.pt-drop").parent().find(".active").removeClass('active');
			$("ul.pt-drop").removeClass('open');
			if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
		});
	}

	$.puerto_droped(".pt-mobmenulink");

	$(".pt-lang a").on('click', function() {
		$.post(path+"/ajax.php?pg=lang", {id:$(this).attr('rel')}, function(puerto){ location.reload(); console.log(puerto);});
	});

	$(".pt-log").on('click', function(){
		var ul = $(this).parent();
		if( ul.find(".pt-drops").hasClass('open') ){
			ul.find(".pt-drops").removeClass('open');
			$(this).removeClass('active');
		} else {
			$("ul.pt-drops").parent().find(".active").removeClass('active');
			$("ul.pt-drops").removeClass('open');
			ul.find(".pt-drops").addClass('open');
			$(this).addClass('active');
		}
		return false;
	});


	$("#pt-send-signin").on("submit", function(){
		var ths = $(this);
		var btn  = ths.find('button[type=submit]');
		var btxt = btn.html();
		console.log("puerto");

		btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

		$.post(path+"/ajax.php?pg=login", $(this).serialize(), function(puerto){
			btn.before(puerto.alert);
			if(puerto.type == "danger"){
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					btn.html(btxt).prop('disabled', false);
				}, 3000);
			} else {
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					$(location).attr('href', path+"/index.php");
				}, 3000);
			}
			console.log(puerto);
		}, 'json');
		return false;
	});
});
</script>

</body>
</html>

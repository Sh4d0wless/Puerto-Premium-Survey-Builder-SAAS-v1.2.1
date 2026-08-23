<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/configs/connection.php';

?>
<title>Puerto Update</title>
<style>
	body { background: #F7F7F7; }
	.install-box { width:450px;margin:20px auto 0 auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 0 5px #CCC; }
	.install-box h1 { padding: 24px 20px;margin:0;font-size:18px;color: #555;    border-bottom: 1px solid #F7F7F7; }
	.install-box p { padding:20px;margin:0;color: #777;line-height: 1.6; }
	.install-box ul { padding: 0 20px;font-size: 12px;line-height: 1.4; }
	.install-box .button {font-size:18px;background:#DF4444;color:#FFF;text-decoration:none;display:block;margin-top:20px;text-align:center;padding:10px 0;border-radius: 3px;width: 100%; }
	.input { padding:10px 20px 0px 20px; }
	.input p { padding:0; font-size:12px; }
	label { font-weight:bold; font-size:12px; margin-left:5px; margin-bottom: 6px; color: #555; display:block; }
	input { padding:10px; font-size:12px; border:1px solid #DDD; width:100%;  }
	input[type=submit] { padding:10px; font-size:12px; color:#FFF; border:1px solid #DF4444; background:#DF4444; width:auto;  }
	.p-h, .p-h a {
    inline-block: ;
    padding: 2px 6px;
    background: #EEE;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    color: #555;
    text-shadow: 0 1px 0 #FFF;
	}
	ul {
		margin:0 24px
	}
	ul li {
		margin: 6px 0;
	}
	.red {
		color: red;
	}
</style>


<?php

$step = (isset($_GET['step']) ? (int)($_GET['step']) : '');

if($step == ''):

?>
<div class="install-box">
	<form method="post" action="update.php?step=1">

	<h1>Welcome to Puerto Premium Survey</h1>
	<p>
	Thank you for purchasing Puerto Premium Survey Script.<br> if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:
	</p>
	<ul>
		<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
		<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
		<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
		<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
	</ul>
	<p>
	 and I will back to you with all help you need.<br>
	 Thanks so much!<br><br />
	<button type="submit" class="button">Update Puerto Script</button>
	</p>
		</form>
</div>





<?php

else:



	$db->query("ALTER TABLE `".prefix."responses` ADD `token_id` VARCHAR(255) NULL AFTER `cook`;");


	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_landing', '1');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_facebook', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_instagram', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_twitter', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_youtube', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_skype', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_logo', 'img/logo3.png');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_favicon', 'img/fav.png');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_ads_header', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_ads_footer', '');");
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'site_ads_survey', '');");

$db->query("
CREATE TABLE `".prefix."pages` (
`id` int(11) NOT NULL,
`title` varchar(200) DEFAULT NULL,
`content` longtext,
`created_at` int(11) DEFAULT '0',
`updated_at` int(11) DEFAULT '0',
`footer` tinyint(1) DEFAULT '0',
`header` tinyint(4) DEFAULT '0',
`sort` smallint(6) DEFAULT '0',
`keywords` text,
`description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$db->query("
INSERT INTO `".prefix."pages` (`id`, `title`, `content`, `created_at`, `updated_at`, `footer`, `header`, `sort`, `keywords`, `description`) VALUES
(1, 'About', '[b]Who are we?[/b]\r\niFood is a technology company that connects people with the best in their cities. We do this by empowering local businesses and in turn, generate new ways for people to earn, work and live. We started by facilitating door-to-door delivery, but we see this as just the beginning of connecting people with possibility — easier evenings, happier days, bigger savings accounts, wider nets and stronger communities.\r\n\r\n[b]Delivering good to Customers[/b]\r\nWith your favorite restaurants at your fingertips, iFood satisfies your cravings and connects you with possibilities — more time and energy for yourself and those you love.\r\n', 1472750541, 1593690346, 0, 0, 1, 'a:3:{i:0;s:4:\"key1\";i:1;s:4:\"key2\";i:2;s:4:\"key3\";}', ''),
(2, 'Contact', 'You can contact us at contact@email.com for your contact questions, opinions, suggestions or skills.\r\nKilic Ali Pasa Cad. No: 12 K: 1 karakãy, Istanbul, Turkey\r\nCana Bilisim Hizmetleri ve Ticaret A.Åž.\r\n\r\nTax Identification Number 1111438913\r\n0212 223 59 00', 1472750541, 1593691345, 0, 0, 2, '', ''),
(3, 'Privacy Policy', '[b]This is my [/b]', 1593868695, 0, 0, 0, 0, NULL, NULL),
(4, 'Support &amp; FAQs', 'Support &amp; FAQs', 1594845749, 1598452175, 0, 1, 0, NULL, NULL),
(5, 'Inspire trust', 'As your click numbers go up, your brand recognition increases. And the more that grows, the more confident people become in the integrity of your content and communications.', 1594845792, 1598452163, 0, 1, 0, NULL, NULL),
(6, 'Boost results', 'Better deliverability and improved click-through are just the start. Rich link-level data allows you to understand who is clicking your links, as well as when and where, so you can make smarter .', 1594845811, 1598452151, 0, 1, 0, NULL, NULL),
(7, 'Gain control', 'On top of being able to fully customize your links, auto-branding boosts awareness of your brand by giving you credit for your content and more insight into how it’s being consumed.', 1594845831, 1598452139, 0, 1, 0, NULL, NULL),
(8, 'Big Data Analysis', 'Lorem ipsum dolor sit amet adicing elit maecenas sa faubus mollis interdum, decisions around the content and communications you share, amet adicing elit maecenas sa faubus mollis interdum.', 1594845848, 1598452126, 0, 1, 0, NULL, NULL);

");
$db->query("
ALTER TABLE `".prefix."pages`
	  ADD PRIMARY KEY (`id`);
");

$db->query("
ALTER TABLE `".prefix."pages`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
");



?>


<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Congratulations Puerto Premium Survey Script is updated successfully. if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:

		</p>
		<ul>
			<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
			<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
			<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
			<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
		</ul>
		<p>
		 and I will back to you with all help you need.<br><br>
		<span class="red">Please do not forget to delete the update file 'update.php'.</span><br>
		<a href="index.php" class="button">Go to index</a>
	</p>
</div>

<?php
endif;

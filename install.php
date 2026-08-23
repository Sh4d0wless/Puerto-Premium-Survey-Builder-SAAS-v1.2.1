<?php
/*=======================================================/
	| Created By: Khalid puerto
 /======================================================*/

$config_file = __DIR__ . '/configs/connection.php';
$step = isset($_GET['step']) ? (int)$_GET['step'] : 0;

if ($step === 1 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = trim($_POST['db_host'] ?? '');
    $db_user = trim($_POST['db_user'] ?? '');
    $db_pass = trim($_POST['db_pass'] ?? '');
    $db_name = trim($_POST['db_name'] ?? '');

    $admin = trim($_POST['admin'] ?? '');
    $pass  = trim($_POST['password'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!$db_host || !$db_user || !$db_name || !$admin || !$pass || !$email) {
        die('გთხოვთ შეავსოთ ყველა სავალდებულო ველი! <meta http-equiv="refresh" content="3;url=install.php">');
    }

    // 1. ბაზასთან კავშირის შემოწმება
    mysqli_report(MYSQLI_REPORT_OFF);
    $db = @new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($db->connect_errno) {
        die('მონაცემთა ბაზასთან დაკავშირება ვერ მოხერხდა: ' . $db->connect_error . ' <br><a href="install.php">უკან დაბრუნება</a>');
    }

    // 2. connection.php-ის ტექსტის მომზადება
    $config_content = "<?php\n"
        . "# -------------------------------------------------#\n"
        . "# Puerto Premium Survey 1.0\n"
        . "# -------------------------------------------------#\n\n"
        . "\$connect = [\n"
        . "    'HOSTNAME' => '" . addslashes($db_host) . "',\n"
        . "    'USERNAME' => '" . addslashes($db_user) . "',\n"
        . "    'PASSWORD' => '" . addslashes($db_pass) . "',\n"
        . "    'DATABASE' => '" . addslashes($db_name) . "'\n"
        . "];\n\n"
        . "define('prefix', 'puerto_');\n\n"
        . "mysqli_report(MYSQLI_REPORT_OFF);\n"
        . "\$db = @new mysqli(\$connect['HOSTNAME'], \$connect['USERNAME'], \$connect['PASSWORD'], \$connect['DATABASE']);\n\n"
        . "if (\$db->connect_errno) {\n"
        . "    if (basename(\$_SERVER['PHP_SELF']) !== 'install.php') {\n"
        . "        header(\"Location: install.php\");\n"
        . "        exit;\n"
        . "    }\n"
        . "} else {\n"
        . "    \$sql_mode = \$db->query(\"SELECT @@GLOBAL.sql_mode;\");\n"
        . "    if (\$sql_mode) {\n"
        . "        \$rs_mode = \$sql_mode->fetch_assoc();\n"
        . "        if (!empty(\$rs_mode[\"@@GLOBAL.sql_mode\"])) {\n"
        . "            \$db->query(\"SET GLOBAL sql_mode='';\");\n"
        . "        }\n"
        . "    }\n"
        . "}\n";

    // 3. ჩაწერის მცდელობა (უფლებების მინიჭებით)
    @chmod($config_file, 0777);
    $is_saved = @file_put_contents($config_file, $config_content);

    // 4. თუ მაინც ვერ ჩაწერა — ეკრანზე გამოტანა
    if ($is_saved === false) {
        echo '<div style="width:600px;margin:50px auto;font-family:tahoma;background:#fff;padding:20px;box-shadow:0 0 5px #ccc;">';
        echo '<h3 style="color:red;">ყურადღება: ფაილში ჩაწერი უფლება არ არის (Permission Denied)!</h3>';
        echo '<p>სკრიპტმა ვერ ჩაწერა მონაცემები <b>configs/connection.php</b> ფაილში.</p>';
        echo '<p>გთხოვთ ხელით გახსნათ <code>configs/connection.php</code> ფაილი და ჩაასვათ შემდეგი კოდი:</p>';
        echo '<textarea style="width:100%;height:200px;font-family:monospace;">' . htmlspecialchars($config_content) . '</textarea>';
        echo '<p>კოდის ჩასმის და ფაილის შენახვის შემდეგ <a href="install.php?step=2_continue">დააჭირეთ აქ ინსტალაციის გასაგრძელებლად</a>.</p>';
        echo '</div>';
        exit;
    }

    // თუ ჩაწერა, პირდაპირ გადავდივართ ბაზის შექმნაზე
    header("Location: install.php?step=2_run&admin=" . urlencode($admin) . "&pass=" . urlencode($pass) . "&email=" . urlencode($email));
    exit;
}

// Step 2: ცხრილების შექმნა
if ($step === 2 || (isset($_GET['step']) && strpos($_GET['step'], '2_') === 0)) {
    
    // შევამოწმოთ connection.php-ის ჩართვა
    if (file_exists($config_file)) {
        require_once $config_file;
    }

    if (!isset($db) || $db->connect_errno) {
        die('შეცდომა: `configs/connection.php` ფაილში ბაზის მონაცემები არასწორია ან ბაზას ვერ უკავშირდება. <a href="install.php">თავიდან ცდა</a>');
    }

    $admin = $_GET['admin'] ?? $_POST['admin'] ?? '';
    $pass  = $_GET['pass'] ?? $_POST['password'] ?? '';
    $email = $_GET['email'] ?? $_POST['email'] ?? '';

    if (!$admin || !$pass || !$email) {
        die('ადმინისტრატორის მონაცემები დაკარგულია. <a href="install.php">გთხოვთ დაიწყოთ თავიდან</a>.');
    }

    $admin_esc = mysqli_real_escape_string($db, $admin);
    $pass_esc  = mysqli_real_escape_string($db, $pass);
    $email_esc = mysqli_real_escape_string($db, $email);

    function sc_pass($data) {
        return sha1($data);
    }

    // ცხრილების შექმნის მოთხოვნები
    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."answers` (
      `id` int(11) NOT NULL,
      `title` varchar(255) DEFAULT NULL,
      `date` int(10) unsigned NOT NULL DEFAULT '0',
      `author` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `survey` int(11) unsigned NOT NULL DEFAULT '0',
      `step` int(11) unsigned NOT NULL DEFAULT '0',
      `question` int(11) unsigned NOT NULL DEFAULT '0',
      `type` varchar(50) DEFAULT NULL,
      `icon` varchar(255) DEFAULT NULL,
      `responses` smallint(5) unsigned NOT NULL DEFAULT '0',
      `lastresponse` int(10) unsigned NOT NULL DEFAULT '0',
      `code` varchar(255) DEFAULT NULL,
      `status` tinyint(1) DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."configs` (
      `id` tinyint(3) unsigned NOT NULL,
      `variable` varchar(255) DEFAULT NULL,
      `value` text
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

    $db->query("INSERT IGNORE INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES
    (1, 'site_title', 'Puerto Premium Survey'),
    (2, 'site_url', 'puertokhalid.com'),
    (3, 'site_description', 'Creating surveys and polls should be simple and fast.'),
    (4, 'site_keywords', 'survey, vote, poll, voting, puerto'),
    (5, 'site_author', 'Puerto Khalid'),
    (6, 'site_register', '1'),
    (7, 'site_plans', '0');");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."payments` (
      `id` int(11) NOT NULL,
      `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      `txn_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      `price` float(10,2) NOT NULL,
      `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      `date` int(11) NOT NULL DEFAULT '0',
      `author` int(11) NOT NULL DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."questions` (
      `id` int(11) NOT NULL,
      `title` varchar(255) DEFAULT NULL,
      `description` text,
      `date` int(10) unsigned NOT NULL DEFAULT '0',
      `author` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `survey` int(11) unsigned NOT NULL DEFAULT '0',
      `step` int(11) unsigned NOT NULL DEFAULT '0',
      `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `inline` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `votes` int(10) unsigned NOT NULL DEFAULT '0',
      `responses` smallint(5) unsigned NOT NULL DEFAULT '0',
      `lastresponse` int(10) unsigned NOT NULL DEFAULT '0',
      `code` varchar(255) DEFAULT NULL,
      `sort` mediumint(8) unsigned NOT NULL DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."responses` (
      `id` int(11) NOT NULL,
      `response` varchar(255) DEFAULT NULL,
      `date` int(10) unsigned NOT NULL DEFAULT '0',
      `author` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `survey` int(11) unsigned NOT NULL DEFAULT '0',
      `step` int(11) unsigned NOT NULL DEFAULT '0',
      `question` int(11) unsigned NOT NULL DEFAULT '0',
      `answer` int(11) DEFAULT '0',
      `ip` varchar(255) DEFAULT NULL,
      `os` varchar(255) DEFAULT NULL,
      `browser` varchar(255) DEFAULT NULL,
      `device` varchar(255) DEFAULT NULL,
      `cook` varchar(255) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."steps` (
      `id` int(11) NOT NULL,
      `date` int(10) unsigned NOT NULL DEFAULT '0',
      `author` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `survey` int(11) unsigned NOT NULL DEFAULT '0',
      `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `code` varchar(255) DEFAULT NULL,
      `sort` mediumint(8) unsigned NOT NULL DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."survies` (
      `id` int(11) NOT NULL,
      `title` varchar(255) DEFAULT NULL,
      `date` int(10) unsigned NOT NULL DEFAULT '0',
      `author` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
      `responses` smallint(5) unsigned NOT NULL DEFAULT '0',
      `lastresponse` int(10) unsigned NOT NULL DEFAULT '0',
      `enddate` int(10) unsigned NOT NULL DEFAULT '0',
      `code` varchar(255) DEFAULT NULL,
      `welcome_head` varchar(255) DEFAULT NULL,
      `welcome_text` mediumtext,
      `welcome_btn` varchar(255) DEFAULT NULL,
      `welcome_icon` varchar(255) DEFAULT NULL,
      `thanks_head` varchar(255) DEFAULT NULL,
      `thanks_text` mediumtext,
      `thanks_btn` varchar(255) DEFAULT NULL,
      `thanks_icon` varchar(255) DEFAULT NULL,
      `startdate` int(10) unsigned NOT NULL DEFAULT '0',
      `private` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `byip` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `url` varchar(255) DEFAULT NULL,
      `button_shadow` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `button_border_size` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `button_border_style` varchar(7) DEFAULT NULL,
      `button_border_color` varchar(7) DEFAULT NULL,
      `bg_gradient` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `bg_color1` varchar(7) DEFAULT NULL,
      `bg_color2` varchar(7) DEFAULT NULL,
      `txt_color` varchar(7) DEFAULT NULL,
      `survey_bg` varchar(7) DEFAULT NULL,
      `input_bg` varchar(7) DEFAULT NULL,
      `step_bg` varchar(7) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $db->query("CREATE TABLE IF NOT EXISTS `".prefix."users` (
      `id` int(10) NOT NULL,
      `firstname` varchar(100) DEFAULT NULL,
      `lastname` varchar(100) DEFAULT NULL,
      `username` varchar(255) DEFAULT NULL,
      `password` varchar(255) DEFAULT NULL,
      `photo` varchar(255) DEFAULT NULL,
      `date` int(11) NOT NULL DEFAULT '0',
      `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `email` varchar(255) DEFAULT NULL,
      `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `address` text,
      `birth` varchar(255) DEFAULT NULL,
      `moderat` varchar(255) DEFAULT NULL,
      `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `credits` float unsigned DEFAULT NULL,
      `description` varchar(255) DEFAULT NULL,
      `language` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
      `trash` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `plan` tinyint(1) DEFAULT '0',
      `lastpayment` int(11) DEFAULT NULL,
      `txn_id` varchar(50) DEFAULT NULL,
      `country` varchar(100) DEFAULT NULL,
      `state` varchar(100) DEFAULT NULL,
      `city` varchar(100) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    @$db->query("ALTER TABLE `".prefix."answers` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."configs` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."payments` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."questions` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."responses` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."steps` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."survies` ADD PRIMARY KEY (`id`);");
    @$db->query("ALTER TABLE `".prefix."users` ADD PRIMARY KEY (`id`);");

    @$db->query("ALTER TABLE `".prefix."answers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."configs` MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;");
    @$db->query("ALTER TABLE `".prefix."payments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."questions` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."responses` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."steps` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."survies` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");
    @$db->query("ALTER TABLE `".prefix."users` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;");

    $db->query("INSERT INTO `".prefix."users` (`username`, `password`, `date`, `level`, `email`) VALUES
    ('{$admin_esc}', '".sc_pass($pass_esc)."', '".time()."', 6, '{$email_esc}');");

    $step = 3; // წარმატება
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Puerto Install</title>
<style>
	body { background: #F7F7F7; }
	.install-box { width:450px;margin:20px auto 0 auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 0 5px #CCC; }
	.install-box h1 { padding: 24px 20px;margin:0;font-size:18px;color: #555; border-bottom: 1px solid #F7F7F7; }
	.install-box p { padding:20px;margin:0;color: #777;line-height: 1.6; }
	.install-box .button {font-size:18px;background:#DF4444;color:#FFF;text-decoration:none;display:block;margin-top:20px;text-align:center;padding:10px 0;border-radius: 3px;width: 100%; border:none; cursor:pointer;}
	label { font-weight:bold; font-size:12px; margin-left:5px; margin-top: 10px; margin-bottom: 4px; color: #555; display:block; }
	input { padding:10px; font-size:12px; border:1px solid #DDD; width:100%; box-sizing:border-box; }
	.red { color: red; }
</style>
</head>
<body>

<?php if ($step === 0): ?>
<div class="install-box">
	<form method="post" action="install.php?step=1">
		<h1>Welcome to Puerto Premium Survey</h1>
		<p>
			<label>Database Host</label>
			<input type="text" name="db_host" value="localhost" required />

			<label>Database User</label>
			<input type="text" name="db_user" placeholder="root" required />

			<label>Database Password</label>
			<input type="password" name="db_pass" placeholder="Database Password" />

			<label>Database Name</label>
			<input type="text" name="db_name" placeholder="Database Name" required />

			<hr style="margin-top:20px; border:0; border-top:1px solid #eee;">

			<label>Admin Username</label>
			<input type="text" name="admin" required />

			<label>Admin Password</label>
			<input type="password" name="password" required />

			<label>Admin Email</label>
			<input type="email" name="email" required />

			<button type="submit" class="button">Install Puerto Script</button>
		</p>
	</form>
</div>

<?php elseif ($step === 3): ?>
<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Puerto Premium Survey Script is installed successfully.
		<br><br>
		<span class="red">Please do not forget to delete the installation file 'install.php'.</span><br>
		<a href="index.php" class="button">Go to index</a>
	</p>
</div>
<?php endif; ?>

</body>
</html>
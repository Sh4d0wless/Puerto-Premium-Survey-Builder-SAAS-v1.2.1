<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['set_title']?></h3>
	</div>
	<form class="pt-sendsettings">
	<div class="pt-admin-setting">
		<div class="form-row">
			<div class="col">
				<div class="form-group">
					<label>Logo (204x48)</label>
					<div class="file-upload">
					  <div class="file-select">
					    <div class="file-select-button" id="fileName2"><?=$lang['details']['image_c']?></div>
					    <div class="file-select-name" id="noFile2"><?=$lang['details']['image_n']?></div>
					    <input type="file" name="chooseFile" id="chooseFile2">
					  </div>
					</div>
					<input type="hidden" name="site_logo" rel="#dropZone2" value="<?=site_logo?>">
					<div id="thumbnails2"><img src="<?=path?>/<?=site_logo?>" onerror="this.src='<?=nophoto?>'" class="nophoto" /></div>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label>Favicon</label>
					<div class="file-upload">
					  <div class="file-select">
					    <div class="file-select-button" id="fileName1"><?=$lang['details']['image_c']?></div>
					    <div class="file-select-name" id="noFile1"><?=$lang['details']['image_n']?></div>
					    <input type="file" name="chooseFile" id="chooseFile1">
					  </div>
					</div>
					<input type="hidden" name="site_favicon" rel="#dropZone1" value="<?=site_favicon?>">
					<div id="thumbnails1"><img src="<?=path?>/<?=site_favicon?>" onerror="this.src='<?=nophoto?>'" class="nophoto" /></div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<input class="tgl tgl-light" id="sb1" value="1" name="site_landing" type="checkbox"<?=(site_landing ? ' checked' : '')?>/>
			<label class="tgl-btn" for="sb1"></label>
			<label>Landing page</label>
		</div>

		<div class="form-group">
			<label><?=$lang['dashboard']['set_stitle']?></label>
			<input type="text" name="site_title" value="<?=site_title?>">
		</div>
		<div class="form-group">
			<label><?=$lang['dashboard']['set_keys']?></label>
			<input type="text" name="site_keywords" value="<?=site_keywords?>">
		</div>
		<div class="form-group">
			<label><?=$lang['dashboard']['set_desc']?></label>
			<textarea name="site_description"><?=site_description?></textarea>
		</div>
		<div class="form-group">
			<label><?=$lang['dashboard']['set_url']?></label>
			<input type="text" name="site_url" value="<?=site_url?>">
		</div>

		<div class="form-group">
			<label><?=$lang['dashboard']['set_noreply']?></label>
			<input type="text" name="site_noreply" value="<?=site_noreply?>">
		</div>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb1" value="1" name="site_register" type="checkbox"<?=(site_register ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb1"></label>
			<label><?=$lang['dashboard']['set_register']?></label>
		</div>

		<div class="form-row">
			<div class="col form-group">
				<label>Facebook</label>
				<input type="text" name="site_facebook" placeholder="Facebook ID" value="<?=site_facebook?>">
			</div>
			<div class="col form-group">
				<label>Twitter</label>
				<input type="text" name="site_twitter" placeholder="Twitter ID" value="<?=site_twitter?>">
			</div>
			<div class="col form-group">
				<label>Instagram</label>
				<input type="text" name="site_instagram" placeholder="Instagram ID" value="<?=site_instagram?>">
			</div>
			<div class="col form-group">
				<label>Youtube</label>
				<input type="text" name="site_youtube" placeholder="Youtube ID" value="<?=site_youtube?>">
			</div>
			<div class="col form-group">
				<label>Skype</label>
				<input type="text" name="site_skype" placeholder="Skype ID" value="<?=site_skype?>">
			</div>
		</div>

		<hr />
		<div class="form-group">
			<label>Header Ads (728x90)</label>
			<textarea name="site_ads_header" placeholder="header ads"><?=site_ads_header?></textarea>
		</div>
		<div class="form-group">
			<label>Footer Ads (851x315)</label>
			<textarea name="site_ads_footer" placeholder="footer ads"><?=site_ads_footer?></textarea>
		</div>
		<div class="form-group">
			<label>Survey Ads</label>
			<textarea name="site_ads_survey" placeholder="survey ads"><?=site_ads_survey?></textarea>
		</div>


		<h3 class="cp-form-title">Facebook login</h3>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb2" value="1" name="login_facebook" type="checkbox"<?=(login_facebook ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb2"></label>
			<label>Facebook Login</label>
		</div>
		<div class="form-row">
			<div class="col-5 form-group">
				<label>App id</label>
				<input type="text" name="login_fbAppId" placeholder="Facebook App Id" value="<?=login_fbAppId?>">
			</div>
			<div class="col-5 form-group">
				<label>App secret</label>
				<input type="password" name="login_fbAppSecret" placeholder="Facebook app secret" value="<?=login_fbAppSecret?>">
			</div>
			<div class="col form-group">
				<label>App version</label>
				<input type="text" name="login_fbAppVersion" placeholder="Facebook app version" value="<?=login_fbAppVersion?>">
			</div>
		</div>
		<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-facebook.php</b></p>

		<h3 class="cp-form-title">Twitter login</h3>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb3" value="1" name="login_twitter" type="checkbox"<?=(login_twitter ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb3"></label>
			<label>Twitter Login</label>
		</div>
		<div class="form-row">
			<div class="col form-group">
				<label>App Key</label>
				<input type="text" name="login_twConKey" placeholder="Twitter App Key" value="<?=login_twConKey?>">
			</div>
			<div class="col form-group">
				<label>App secret</label>
				<input type="password" name="login_twConSecret" placeholder="Twitter App Secret" value="<?=login_twConSecret?>">
			</div>
		</div>
		<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-twitter.php</b></p>

		<h3 class="cp-form-title">Google login</h3>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb4" value="1" name="login_google" type="checkbox"<?=(login_google ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb4"></label>
			<label>Google Login</label>
		</div>
		<div class="form-row">
			<div class="col form-group">
				<label>Client id</label>
				<input type="text" name="login_ggClientId" placeholder="Google client id" value="<?=login_ggClientId?>">
			</div>
			<div class="col form-group">
				<label>Client secret</label>
				<input type="password" name="login_ggClientSecret" placeholder="Google client Secret" value="<?=login_ggClientSecret?>">
			</div>
		</div>
		<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-google.php</b></p>

		<h3 class="cp-form-title">Paypal</h3>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb5" value="1" name="site_paypal_live" type="checkbox"<?=(site_paypal_live ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb5"></label>
			<label>Live</label>
		</div>
		<div class="form-row">
			<div class="col-6 form-group">
				<label>Paypal id</label>
				<input type="text" name="site_paypal_id" placeholder="Paypal id" value="<?=site_paypal_id?>">
			</div>
			<div class="col form-group">
				<label>Paypal Currency</label>
				<input type="text" name="site_currency_name" placeholder="Currency name" value="<?=site_currency_name?>">
			</div>
			<div class="col form-group">
				<label>Currency Symbol</label>
				<input type="text" name="site_currency_symbol" placeholder="Currency Symbol" value="<?=site_currency_symbol?>">
			</div>
		</div>

		<h3 class="cp-form-title">PHPMAILER SMTP</h3>
		<div class="form-group">
			<input class="tgl tgl-light" id="cb6" value="1" name="site_smtp" type="checkbox"<?=(site_smtp ? ' checked' : '')?>/>
			<label class="tgl-btn" for="cb6"></label>
			<label>is SMTP</label>
		</div>
		<div class="form-row">
			<div class="col form-group">
				<label>Host</label>
				<input type="password" name="site_smtp_host" placeholder="SMTP Host" value="<?=site_smtp_host?>">
			</div>
			<div class="col form-group">
				<label>Username</label>
				<input type="password" name="site_smtp_username" placeholder="SMTP Username" value="<?=site_smtp_username?>">
			</div>
			<div class="col form-group">
				<label>Password</label>
				<input type="password" name="site_smtp_password" placeholder="SMTP Password" value="<?=site_smtp_password?>">
			</div>
			<div class="col form-group">
				<label>Port</label>
				<input type="text" name="site_smtp_port" placeholder="SMTP Port" value="<?=site_smtp_port?>">
			</div>
			<div class="col form-group">
				<label>Auth</label>
				<select name="site_smtp_auth">
					<option value="0" <?=(site_smtp_auth=='0'?'selected':'')?>>False</option>
					<option value="1" <?=(site_smtp_auth=='1'?'selected':'')?>>True</option>
				</select>
			</div>
			<div class="col form-group">
				<label>Encryption</label>
				<select name="site_smtp_encryption">
					<option value="none" <?=(site_smtp_encryption=='none'?'selected':'')?>>None</option>
					<option value="tls" <?=(site_smtp_encryption=='tls'?'selected':'')?>>TLS</option>
				</select>
			</div>
		</div>


		<div class="pt-link">
			<button type="submit" class="fancy-button bg-gradient5">
				<span><?=$lang['dashboard']['set_btn']?> <i class="fas fa-arrow-circle-right"></i></span>
			</button>
		</div>
	</div>

	</form>
</div>

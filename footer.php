		<?php if (site_ads_header && (fh_access("ads") || !us_level)): ?>
		<div class="pt-footer-ads"><?=site_ads_footer?></div>
		<?php endif; ?>
	</div>

	<div class="pt-footer">
		<?php if ($request != "su"): ?>
		<div class="pt-lang">
			<a hrfe="#" rel="en"><i class="flag-icon flag-icon-squared flag-icon-us"></i></a>
			<a hrfe="#" rel="fr"><i class="flag-icon flag-icon-squared flag-icon-fr"></i></a>
			<a hrfe="#" rel="es"><i class="flag-icon flag-icon-squared flag-icon-es"></i></a>
			<a hrfe="#" rel="fr"><i class="flag-icon flag-icon-squared flag-icon-ma"></i></a>
			<a hrfe="#" rel="ar"><i class="flag-icon flag-icon-squared flag-icon-sa"></i></a>
		</div>
		<?php endif; ?>
		<div>
				Copyright © 2020 <a href="<?=path?>"><?=site_title?></a>. All Rights Reserved.<br>
				<?php if ($request != "su"): ?>
				Programming and design by <a href="http://puertokhalid.com" target="_blanc">Puerto Khalid</a>.
				<?php endif; ?>
		</div>
	</div>

</div>

<?php
include __DIR__."/scripts.php";
?>

</body>
</html>

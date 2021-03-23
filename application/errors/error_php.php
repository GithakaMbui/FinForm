<?php $CI = &get_instance(); ?>
<?php $CI->load->view('common/header', array('no_header'=>true)); ?>
<div class="error-page">
	<div class="container">
		<div class="error">
			<header>
				<div class="logo col-md-2 col-md-offet-2">
					<img src="<?php echo base_url('img/logos/mykeja.png'); ?>"/>
				</div>
				<div class="error-heading">
					<h2>A PHP Error was encountered</h2>
				</div>
			</header>
			<section class="content">
				<p class="error-message">Severity: <?php echo $severity; ?></p>

				<p class="error-message">Message:  <?php echo $message; ?></p>

				<p class="error-message">Filename: <?php echo $filepath; ?></p>
					
				<p class="error-message">Line Number: <?php echo $line; ?></p>
			</section>
		</div>
	</div>
</div>
<?php $CI->load->view('common/footer.php'); ?>
<!doctype html>
<html>
<head>
	<script>
	</script>

	<title><?php if(isset($title)) echo $title; ?></title>
	
	<meta name="description" content="<?php echo $this->config->item('app-name'); ?>">
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="icon" type="image/png" href="/img/logos/logo.png" sizes="100x100">
	
	<script type="text/javascript" src="<?php echo base_url('js/vendor/modernizr.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/fonts.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/font-awesome.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/animate.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap-datetimepicker.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/app.css?v1'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/app-responsive.css?v1'); ?>"/>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/moment.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/jquery-ui.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/slimscroll.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/vendor/bootstrap-datetimepicker.js'); ?>"></script>
	<script src="<?php echo base_url('js/vendor/highcharts.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/app.js'); ?>"></script>
 </head>
<body class="fixed-header app-body<?php if(!isset($no_header) || !$no_header) echo ' no_header'; ?><?php if($this->users->current_user('is_admin')) echo ' user-page'; ?>">
	<?php if(!isset($no_header) || !$no_header): ?>
		<header class="panel app-header header">
			<section class="content">
				<nav class="navbar navbar-default">
					<div class="container">
						<div class="navbar-header">
							<a href="<?php echo base_url(); ?>" class="navbar-brand">
								<span class="text">
									<?php echo $this->config->item('app-name'); ?>
								</span>
							</a>
						</div>
						<div class="navbar-collapse">
							<ul id="account-menu-view" class="nav navbar-nav">
								<?php if(!$this->users->current_user('is_admin')): ?>
									<li>
									 	<a href="<?php echo base_url(); ?>">
									 		Home
									 	</a>
									</li>
									<?php $this->load->view('users/primary-nav'); ?>
								<?php else: ?>
									<li>
									 	<a href="<?php echo base_url(); ?>">
									 		Dashboard
									 	</a>
									</li>
								<?php endif; ?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php if(!$this->users->current_user('is_signed_in')): ?>
									<li>
									 	<a href="<?php echo base_url('accounts/login'); ?>">
									 		Login
									 	</a>
									</li>
									<li>
									 	<a href="<?php echo base_url('accounts/createaccount'); ?>">
									 		Create Account
									 	</a>
									</li>
								<?php else: ?>
									<li class="dropdown">
									  <a data-toggle="dropdown" href="#">
									  	<img class="user-pic" src="<?php echo base_url('img/app/people/profile/johndoe.png'); ?>"/>
									  </a>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									  	<li>
								     		<a href="<?php echo base_url("user/home/$user->id"); ?>">
									     		My Home
									     	</a>
									     </li>
									     <?php if(!$user->current_user('is_admin')): ?>
										     <li>
									     		<a href="<?php echo base_url("user/setup/$user->id"); ?>">
										     		Edit Preferences
										     	</a>
										     </li>
										 <?php endif; ?>
									  	 <li>
								     		<a href="<?php echo base_url('accounts/logout'); ?>">
									     		Logout
									     	</a>
									     </li>
									  </ul>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</nav>
			</section>
		</header>
	<?php endif; ?>
	<section class="app-page">
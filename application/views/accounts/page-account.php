<?php $this->load->view('common/header'); ?>
<div class="panel page start-page user-home">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-12 quick-trends">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li class="title">
						 <i class="fa fa-account"></i>&nbsp;
						 <?php  echo ucwords(strtolower($account->get_fullname())); ?>
					</li>
					<li class="active">
						 <a data-toggle="tab" href="#profile">
						 	Profile
						 </a>
					</li>
					<li>
						 <a data-toggle="tab" href="#preferences">
						 	Preferences
						 </a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="profile" class="tab-pane active profile-pane">
						<div class="col-md-3">
							<img class="account-pic img-responsive" src="<?php echo base_url('img/app/people/profile/johndoe.png'); ?>"/>
							<h2 class="accountname">
						 		<?php  echo ucwords(strtolower($account->get_fullname())); ?>
							</h2>
						</div>
						<div class="col-md-8">
							<ul class="list-unstyled account-info">
								<li>
									<span class="info-label">
										<i class="fa fa-envelope"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo $account->get_info('email'); ?>
									</span>
								</li>
								<li>
									<span class="info-label">
										<i class="fa fa-gift"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo ($points=$account->get_info('points')) ? $points : 0; ?> points
									</span>
								</li>
								<li>
									<span class="info-label">
										<i class="fa fa-calendar"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo @date('Y-m-d', $account->created); ?>
									</span>
								</li>
							</ul>
						</div>
						<span class="clearfix"></span>
					</div>
					<div id="preferences" class="tab-pane">
					</div>
				</div>
			</div>
			<span class="clearfix"></span>
		</div>
	</header>
	<hr class="divider"/>
</div>
<?php $this->load->view('common/footer'); ?>
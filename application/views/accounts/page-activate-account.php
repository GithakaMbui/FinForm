<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page form-page add-user">
	<header class="header">
		<h2 class="title">
			<i class="fa fa-user-plus"></i>
			&nbsp;Activate <?php echo ucwords(strtolower($account->get_fullname())); ?>
			<?php if(isset($message)): ?>
					<span class="alert alert-danger">
						<?php echo $message?>
					</span>
			<?php endif; ?>
		</h2>
	</header>
	<span class="clearfix"></span>
	<hr class="divider"/>
	<section class="content">
		<div class="panel panel-panel panel-warning">
			<div class="panel-heading">
				<i class="fa fa-warning"></i>&nbsp;Activate account
			</div>
			<div class="panel-body">
				<div class="message">
					<p>
						Are you sure you want to proceed?
					</p>
				</div>
				<hr class="divider"/>
				<div class="col-md-12">
					<a class="btn btn-default btn-cancel" href="<?php echo base_url("dashboard/accounts/$user->id"); ?>">
						Cancel
					</a>
					<a class="btn btn-danger btn-proceed" href="<?php echo base_url("dashboard/activateaccount/$user->id/$account->id/?usr_ok=true"); ?>">
						Proceed
					</a>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Add Account
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/accounts/$user->id"); ?>">
					All Accounts
				</a>
			</span>
		</h1>
	</header>
	<section class="content">
		<?php if(isset($message)): ?>
			<div class="container">
				<span class="alert alert-<?php echo (isset($type) ? $type : 'info')?>">
					<?php echo $message; ?>
				</span>
			</div>
		<?php endif; ?>
		<hr class="divider"/>
		<form class="form" method="post" action="<?php echo base_url("dashboard/addaccount/$user->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">First Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="account[firstname]" value="<?php if(isset($firstname)) echo $firstname; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Last Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="account[lastname]" value="<?php if(isset($lastname)) echo $lastname; ?>"/>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<div class="row">
				<br/>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Email</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="account[email]" value="<?php if(isset($email)) echo $firstname; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Password</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="account[password]" value="<?php if(isset($password)) echo $lastname; ?>"/>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<div class="col-md-11">
						<input class="btn btn-success pull-right" name="usr_submit" value="Add Account" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
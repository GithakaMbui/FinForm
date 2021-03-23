<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page industries-management">
	<header class="header">
		<h1 class="title">
			Add Industry
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/industries/$user->id"); ?>">
					All Industries
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/addindustry/$user->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="industry[name]" value="<?php if(isset($name)) echo $name; ?>"/>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<div class="col-md-11">
						<textarea class="form-control" name="industry[description]" placeholder="Enter brief industry description here"><?php if(isset($description)) echo $description; ?></textarea>
					</div>
					<span class="clearfix"></span>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input class="btn btn-success pull-left" name="usr_submit" value="Save Industry" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
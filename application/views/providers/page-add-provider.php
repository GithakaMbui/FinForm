<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			<i class="fa fa-shopping-cart"></i>
			Add Provider
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/providers/$user->id"); ?>">
					All Providers
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/addprovider/$user->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="provider[name]" value="<?php if(isset($name)) echo $name; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Industry</label>
						<div class="col-md-8">
							<select class="form-control" name="provider[industry]">
								<option value="">Select Industry</option>
								<?php foreach($industries as $d_industry): ?>
									<option value="<?php echo $d_industry->id; ?>" <?php if(isset($industry) && $industry===$d_industry->id): ?>selected<?php endif; ?>>
										<?php echo ucwords(strtolower($d_industry->name)); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<label class="form-label col-md-1">Country</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="provider[country]" value="<?php if(isset($country)) echo $country; ?>"/>
					</div>
					<span class="clearfix"></span>
				</div>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<div class="col-md-11">
						<textarea class="form-control" name="provider[description]" placeholder="Enter brief description of the provider here"><?php if(isset($description)) echo $description; ?></textarea>
					</div>
					<span class="clearfix"></span>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input class="btn btn-success pull-left" name="usr_submit" value="Save Provider" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
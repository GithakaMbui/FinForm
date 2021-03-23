<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Edit Data Point (<?php echo ucwords(strtolower($datapoint->name)); ?>)
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/categories/$user->id"); ?>">
					Categories
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/editdatapoint/$user->id/$datapoint->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="datapoint[name]" value="<?php if(isset($datapoint->name)) echo $datapoint->name; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Type</label>
						<div class="col-md-8">
							<select class="form-control" name="datapoint[type]">
								<option value="">Select Data Type</option>
								<?php foreach(array('numeric', 'text', 'percentage') as $dtype): ?>
									<option value="<?php echo $dtype; ?>"<?php if($dtype==$datapoint->type): ?> selected<?php endif; ?>>
										<?php echo ucwords($dtype); ?>
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
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Units</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="datapoint[units]" value="<?php if(isset($datapoint->units)) echo $datapoint->units; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<div class="col-md-11">
							<input class="btn btn-success pull-right" name="usr_submit" value="Save Data Point" type="submit"/>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
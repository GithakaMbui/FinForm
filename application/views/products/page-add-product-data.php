<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Add Product <?php echo ucwords(strtolower($datapoint->name)); ?> 
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/products/$user->id"); ?>">
					All Products
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
		<form class="form" method="post" action="<?php echo base_url("product/addproductdata/$user->id/$product->id/$datapoint->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input type="hidden" name="datapoint[product]" value="<?php echo $product->id; ?>"/>
							<input type="hidden" name="datapoint[datapoint]" value="<?php echo $datapoint->id; ?>"/>
							<input type="hidden" name="datapoint[owner]" value="<?php echo $user->id; ?>"/>
							<input class="form-control" type="text" value="<?php if(isset($product->name)) echo $product->name; ?>" disabled="disabled"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Provider</label>
						<div class="col-md-8">
							<select class="form-control" name="datapoint[provider]">
								<option value="">Select Provider</option>
								<?php foreach($providers as $d_provider): ?>
									<option value="<?php echo $d_provider->id; ?>" <?php if(isset($provider) && $provider===$d_provider->id): ?>selected<?php endif; ?>>
										<?php echo ucwords(strtolower($d_provider->name)); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Region</label>
						<div class="col-md-8">
							<select class="form-control" name="datapoint[region]">
								<option value="">Select Region</option>
								<?php foreach($regions as $d_region): ?>
									<option value="<?php echo $d_region->id; ?>" <?php if(isset($region) && $region===$d_region->id): ?>selected<?php endif; ?>>
										<?php echo ucwords(strtolower($d_region->name)); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Date</label>
						<div class="col-md-8">
			                <div class='input-group date' id='datetimepicker1'>
			                    <input name="datapoint[date]" type='text' class="form-control" />
			                    <span class="input-group-addon">
			                        <span class="fa fa-calendar"></span>
			                    </span>
			                </div>
			            </div>
		            </div>
		        </div>
				<span class="clearfix"></span>
	        </div>
			<br/>
	        <div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Value</label>
						<div class="col-md-8">
							<input class="form-control"  type="text"  name="datapoint[value]" value="<?php if(isset($value)) echo $value; ?>"/>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<div class="col-md-12 row">
				<br/>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<div class="col-md-11">
						<input class="btn btn-success pull-right" name="usr_submit" value="Save Datapoint" type="submit"/>
					</div>
				</div>
			</div>
		</form>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                	'viewMode':'months'
                });
            });
        </script>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
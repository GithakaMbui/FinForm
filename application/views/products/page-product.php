<?php if(!$user->current_user('is_admin')): ?>
	<?php $this->load->view('common/header'); ?>
<?php else: ?>
	<?php $this->load->view('common/master-detail-header'); ?>
<?php endif; ?>

<script type="text/javascript">
    window.chartData={};
</script>

<?php $datapoints=$product->get_product_datapoint_attrs(); ?>
<div class="panel page start-page user-page info-page">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-12 quick-trends">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li class="title">
						 <i class="fa fa-user"></i>&nbsp;
						 <?php  echo ucwords(strtolower($product->name)); ?>
					</li>
					<li class="active">
						 <a data-toggle="tab" href="#product">
						 	Product
						 </a>
					</li>
					<?php foreach($datapoints as $datapoint): ?>
						<li>
							<a data-toggle="tab"  href="#datapoint-<?php echo $datapoint->id; ?>">
								<?php echo ucwords(strtolower($datapoint->name)); ?>
							</a>
						</li>
					<?php  endforeach; ?>
				</ul>
				<div class="tab-content" style="width:1024px;">
					<div id="product" class="tab-pane active">
						<br/><br/>
						<div class="panel product">
							<header class="header">
								<div class="col-md-4">
									<div class="pic">
										<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
										<?php $product_img=$this->config->item('app-default-item-image'); ?>
										<?php if($product->image) $product_img=$product->image?>
										<img style="width:250px; height:260px;" src="<?php echo base_url($item_images_dir_url.'/'.$product_img); ?>">
									</div>
								</div>
								<div class="col-md-7">
									<ul class="list-unstyled">
										<li class="name">
											<span class="info-label">
												Product Name
											</span>
											<span class="info-value">
												<?php echo $product->name; ?>
											</span>
										</li>
										<br/><br/>
										<li class="name">
											<span class="info-label">
												Category
											</span>
											<span class="info-value">
												<ul class="list-unstyled list-inline">
													<?php foreach($product->get_categories() as $category): ?>
														<li>
															<?php echo ucwords($category->name);?>
														</li>
													<?php endforeach;  ?>
												</ul>
											</span>
										</li>
										<br/><br/>
										<li class="actions">
											<?php if($user->current_user('is_admin')): ?>
												<a class="btn btn-danger pull-left" href="<?php echo base_url("dashboard/removeproduct/$user->id/$product->id"); ?>">
													Remove
												</a>
												<a class="btn btn-info pull-left" href="<?php echo base_url("dashboard/editproduct/$user->id/$product->id"); ?>">
													Edit
												</a>
											<?php endif; ?>
											<span class="clearfix"></span>
										</li>
									</ul>
								</div>
								<span class="clearfix"></span>
							</header>
							<br/>
							<hr class="divider"/>
							<section class="content">
								<div class="col-md-12">
									<h2 class="title">Get Product Data</h2>
									<hr class="divider"/>
									<br/>
									<div class="row filter-form">
										<form data-filter-url="<?php echo base_url("product/data/$product->id"); ?>" id="product-data-filter-form" class="form" method="post" action="#">
											<input type="hidden" name="usr_submit" value="true"/>
											<input type="hidden" name="product" value="<?php echo $product->id; ?>"/>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<select class="form-control provider">	
															<option value="">Select Provider</option>
															<?php foreach($providers as $provider): ?>
																<option value="<?php echo $provider->id; ?>">
																	<?php echo ucwords(strtolower($provider->name)); ?>
																</option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<select class="form-control region">	
															<option value="">Select Region</option>
															<?php foreach($regions as $region): ?>
																<option value="<?php echo $region->id; ?>">
																	<?php echo ucwords(strtolower($region->name)); ?>
																</option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<select class="form-control datapoint">	
															<option value="">Select Datapoint</option>
															<?php foreach($datapoints as $datapoint): ?>
																<option value="<?php echo $datapoint->id; ?>">
																	<?php echo ucwords(strtolower($datapoint->name)); ?>
																</option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<!--div class="col-md-3">
													<div class="form-group">
														<button class="btn btn-md btn-primary">
															Get
														</button>
													</div>
												</div-->
												<span class="clearfix"></span>
											</div>
										</form>
										
									</div>
									<div id="product-data-result-table" class="row data-table">
										<div class="loader hidden">
	    										<img src="<?php echo base_url("img/gifs/loading/hourglass.gif"); ?>"/>
	    								</div>
										<div class="content"></div>
									</div>
								</div>
								<script type="text/javascript">
									(function($){
										$(function(){
											var DataFilterForm=$('#product-data-filter-form');
											DataFilterForm.find('.form-control').change(function(){
												if(DataFilterForm.find('.form-control.provider').val()
													&& DataFilterForm.find('.form-control.region').val()
													 && DataFilterForm.find('.form-control.datapoint').val()){
													getData();
												}
											});
											DataFilterForm.find('.btn').click(function(e){
												e.preventDefault();
												if(DataFilterForm.find('.form-control.provider').val()
													&& DataFilterForm.find('.form-control.region').val()
													 && DataFilterForm.find('.form-control.datapoint').val()){
													getData();
												}
											});
											function getData(){
											   	$('#product-data-result-table .loader').removeClass('hidden');
											    $.post(DataFilterForm.attr('data-filter-url'), {
											    	'provider':DataFilterForm.find('.form-control.provider').val(),
											    	'region':DataFilterForm.find('.form-control.region').val(),
											    	'datapoint':DataFilterForm.find('.form-control.datapoint').val(),
											    	'usr_submit':true
											   	}, function(data){
											    	 var dataTable=$(data);
											    	 $('#product-data-result-table .loader').addClass('hidden');
											    	 $('#product-data-result-table .content').html('').append(data);
											    })
											}
										})
									}(window.jQuery));
								</script>
								<span class="clearfix"></span>
							</section>
						</div>
					</div>
					<?php foreach($datapoints as $datapoint): ?>
						<div id="datapoint-<?php echo $datapoint->id; ?>" class="tab-pane col-md-12">
							<div class="row datapoints-trends">
								<h2 class="title">
									Trend
									<span class="btn-group pull-right">
										<?php if($user->current_user('is_signed_in')): ?>
											<a data-toggle="modal" class="btn btn-info" data-target="#add-datapoint<?php echo $datapoint->id; ?>-data" href="#add-datapoint<?php echo $datapoint->id; ?>-data">
												Add Data
											</a>
										<?php endif; ?>
										<a data-toggle="modal" class="btn btn-primary" data-target="#compare-datapoint<?php echo $datapoint->id; ?>-data" href="#compare-datapoint<?php echo $datapoint->id; ?>-data">
											Compare
										</a>
									</span>
									<span class="clearfix"></span>
								</h2>
								<span class="clearfix"></span>
								<div class="row col-md-12">
									<?php $this->load->view('products/part-product-datapoint-avg-trends', array(
										'product'=>$product,
										'datapoint'=>$datapoint
									)); ?>
								</div>
							</div>
						</div>
					<?php  endforeach; ?>
				</div>
			</div>
		</div>
	</header>
</div>
<?php if(!$user->current_user('is_admin')): ?>
	<?php $this->load->view('common/footer'); ?>
<?php else: ?>
	<?php $this->load->view('common/master-detail-footer'); ?>
<?php endif; ?>
<script type="text/javascript">
    $(function () {
        $('.date-field').datetimepicker({
        	'viewMode':'months'
        });
    });
</script>
<?php $i=0; foreach($datapoints as $datapoint): ?>
	<?php $datapoint_name=ucwords(strtolower($datapoint->name)); ?> 
	
	<?php if($user->current_user('is_signed_in')): ?>
		<div class="modal fade add-data-modal" id="add-datapoint<?php echo $datapoint->id; ?>-data" tabindex="-1" role="dialog">
		    <div class="loader hidden">
		    	<img src="<?php echo base_url("img/gifs/loading/hourglass.gif"); ?>"/>
		    </div>
		    <div class="success hidden">
		    	<img src="<?php echo base_url("img/bgs/success.png"); ?>"/>
		    </div>
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title">Add <?php echo $datapoint_name; ?></h4>
		        </div>
		        <div class="modal-body">
		        	<form data-save-url="<?php echo base_url("product/addproductdata/$user->id/$product->id/$datapoint->id"); ?>" class="form save-data-form" method="post" action="#">
						<input type="hidden" class="product" name="datapoint[product]" value="<?php echo $product->id; ?>"/>
						<input type="hidden" class="datapoint" name="datapoint[datapoint]" value="<?php echo $datapoint->id; ?>"/>
						<input type="hidden" class="owner" name="datapoint[owner]" value="<?php echo $user->id; ?>"/>
		        		<div class="form-group">
		        			<label class="form-label col-md-3">Select Provider</label>
		        			<div class="col-md-8">
		    					<select class="provider form-control" name="datapoint[provider]">
									<option value="">Select Provider</option>
									<?php foreach($providers as $d_provider): ?>
										<option value="<?php echo $d_provider->id; ?>" <?php if(isset($provider) && $provider===$d_provider->id): ?>selected<?php endif; ?>>
											<?php echo ucwords(strtolower($d_provider->name)); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<span class="clearfix"></span>
		        		</div>
		        		<div class="form-group">
		        			<label class="form-label col-md-3">Select Region</label>
		        			<div class="col-md-8">
								<select class="region form-control" name="datapoint[region]">
									<option value="">Select Region</option>
									<?php foreach($regions as $d_region): ?>
										<option value="<?php echo $d_region->id; ?>" <?php if(isset($region) && $region===$d_region->id): ?>selected<?php endif; ?>>
											<?php echo ucwords(strtolower($d_region->name)); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<span class="clearfix"></span>
		        		</div>
						<div class="form-group">
							<label class="form-label col-md-3">Date</label>
							<div class="col-md-8">
				                <div class='input-group date-field' id='datetimepicker1'>
				                    <input  name="datapoint[date]" type='text' class="date form-control" />
				                    <span class="input-group-addon">
				                        <span class="fa fa-calendar"></span>
				                    </span>
				                </div>
				            </div>
							<span class="clearfix"></span>
			            </div>
		        		<div class="form-group">
		        			<label class="form-label col-md-3">Value</label>
		        			<div class="col-md-8">
								<input class="value form-control"  type="text"  name="datapoint[value]" value="<?php if(isset($value)) echo $value; ?>"/>
							</div>
							<span class="clearfix"></span>
		        		</div>
		        		<div class="form-group">
		        			<input type="hidden" name="usr_submit" value="true"/>
		        		</div>
		        	</form>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <button type="button" class="btn btn-primary save-btn">Add Data</button>
		        </div>
		      </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		  </div><!-- /.modal -->
	<?php endif; ?>
	 <div class="modal fade compare-data-modal" id="compare-datapoint<?php echo $datapoint->id; ?>-data" tabindex="-1" role="dialog">
	    <div class="loader hidden">
	    	<img src="<?php echo base_url("img/gifs/loading/hourglass.gif"); ?>"/>
	    </div>
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header" style="background-color:#529eec; color:#fff">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" style="color:#fff">
	          	Compare <?php echo $datapoint_name; ?>
    			<span class="clearfix"></span>
	          </h4>
	        </div>
	        <div class="modal-body" style="padding-top:0px;">
	        	<div class="row chart-header" style="background-color:#f8f8f8; padding:0px;">
	        		<div class="col-md-5 pull-right text-right">
	        			<h4 class="title col-md-7" style="padding:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Criteria</h4>
	        			<form class="compare-form navbar-form col-md-5" data-compare-url="<?php echo base_url("product/compare/$product->id/$datapoint->id/?usr_submit=true"); ?>">
	        				<div class="form-group" style="padding: 5px;">
	        					<select class="form-control criteria">
	        						<option value="provider">Default</option>
	        						<option value="region">
	        							Region
	        						</option>
	        						<option value="provider">
	        							Provider
	        						</option>
	        					</select>
	        				</div>
	        			</form>
	        			<span class="clearfix"></span>
	        		</div>
	        		<span class="clearfix"></span>
	        	</div>
	        	<div class="chart" class="row">
	        	</div>
	        </div>
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
<?php endforeach; ?>
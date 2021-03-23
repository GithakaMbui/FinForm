<?php $this->load->view('common/header'); ?>
<div class="panel page start-page">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-12 quick-trends">
				<ul class="nav nav-tabs">
					<li class="title">
						 <i class="fa fa-area-chart"></i>&nbsp;
						 <?php  echo ucwords(strtolower($c_category->name)); ?>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<div id="<?php echo "cat-$c_category->id"; ?>" class="carousel slide">
							<div class="carousel-inner">
								<br/>
								<?php $j=0; foreach($c_category->get_products() as $product): ?>
									<div id="product-item<?php  echo $product->id; ?>" class="item<?php if($j==0) echo ' active'; ?> product-item">
										<div class="trends-tabs">
											<ul id="product-data-trends-<?php  echo $product->id; ?>-tab" class="product-data-trends-tabs nav nav-tabs" data-tabs="tabs">
												<li class="title">
													<?php echo ucwords($product->name); ?>
												</li>
												<?php $k=0; foreach($c_category->get_datapoints() as $datapoint): ?>
													<li<?php if($k==0) echo ' class="active"'; ?>>
														<a data-toggle="tabs" href="#data-<?php echo $datapoint->id; ?>">
															<?php echo ucwords(strtolower("$datapoint->name ( $datapoint->units )")); ?>
														</a>
													</li>
												<?php $k++; endforeach; ?>
											</ul>
											<div class="tab-content">
												<?php $k=0; foreach($c_category->get_datapoints() as $datapoint): ?>
													<div id="data-<?php echo $datapoint->id; ?>" class="tab-pane<?php if($k==0) echo ' active'; ?>">
														<?php 
															$this->load->view('products/part-product-datapoint-avg-trends', array(
																'product'=>$product,
																'datapoint'=>$datapoint
															)); 
														?>
													</div>
												<?php $k++; endforeach; ?>
											</div>
										</div>
									</div>
								<?php $j++; endforeach; ?>
							</div>
							<a class="carousel-nav left btn btn-default" href="<?php echo "#cat-$c_category->id"; ?>" data-slide="prev">Previous</a>
							<a class="carousel-nav right btn btn-primary pull-right" href="<?php echo "#cat-$c_category->id"; ?>" data-slide="next">Next</a>
						</div>
					</div>
				</div>
			</div>
			<span class="clearfix"></span>
		</div>
	</header>
	<hr class="divider"/>
	<section class="content">
		<?php 
			$this->load->view('products/part-products-categories', array(
				'categories'=>array('category'=>$c_category),
				'products'=>$products
			)); 
		?>
	</section>
</div>
<?php $this->load->view('common/footer'); ?>
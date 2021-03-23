<?php $this->load->view('common/header'); ?>
<div class="panel page start-page">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-8 quick-trends">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li>
						<h1 class="title">
						  <i class="fa fa-area-chart"></i>&nbsp;Trends</h1>
					</li>
					<?php $i=0; foreach($categories as $category): if($i>3 || !count($category->get_products())) break; ?>
						<li<?php if($i==0) echo ' class="active"'; ?>>
							<a data-toggle="tab" href="<?php echo "#cat-$category->id"; ?>">
								<?php echo ucwords(strtolower($category->name)); ?>
							</a>
						</li>
					<?php $i++; endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php $i=0; foreach($categories as $category):  if($i>3 || !count(($c_products=$category->get_products()))) break; ?>
						<div id="<?php echo "cat-$category->id"; ?>" class="tab-pane<?php if($i==0) echo ' active'; ?>">
							<!--h1 class="sub-title">
								<?php echo ucwords(strtolower($category->name)); ?> Product Trends
							</h1-->
							<div class="carousel">
								<div class="carousel-inner"><br/>
									<?php $j=0; foreach($c_products as $product): ?>
										<div id="product-item<?php  echo $product->id; ?>" class="item<?php if($j==0) echo ' active'; ?> product-item">
											<div class="trends-tabs">
												<ul id="product-data-trends-<?php  echo $product->id; ?>-tab" class="product-data-trends-tabs nav nav-tabs" data-tabs="tabs">
													<li class="title">
														<?php echo ucwords($product->name); ?>
													</li>
													<?php $k=0; foreach($category->get_datapoints() as $datapoint): ?>
														<li<?php if($k==0) echo ' class="active"'; ?>>
															<a data-toggle="tabs" href="#data-<?php echo $datapoint->id; ?>">
																<?php echo ucwords(strtolower("$datapoint->name ( $datapoint->units )")); ?>
															</a>
														</li>
													<?php $k++; endforeach; ?>
												</ul>
												<div class="tab-content">
													<?php $k=0; foreach($category->get_datapoints() as $datapoint): ?>
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
								<a class="carousel-nav left btn btn-default" href="<?php echo "#cat-$category->id"; ?>" data-slide="prev">Previous</a>
								<a class="carousel-nav right btn btn-primary pull-right" href="<?php echo "#cat-$category->id"; ?>" data-slide="next">Next</a>
							</div>
						</div>
					<?php $i++; endforeach; ?>
				</div>
			</div>
			<div class="col-md-4 categories">
				<h3 class="title">Product Categories</h3>
				<ul class="list-unstyled categories-list">
					<?php foreach($categories as $category): ?>
						<li>
							<a href="<?php echo base_url("products/index/$category->id"); ?>">
								<?php echo $category->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<span class="clearfix"></span>
		</div>
	</header>
	<hr class="divider"/>
	<section class="content">
		<?php 
			$this->load->view('products/part-products-categories', array(
				'categories'=>$categories,
				'products'=>$products
			)); 
		?>
	</section>
</div>
<script type="text/javascript">
	(function($){
		
		$(function(){
			var carousels=$('.carousel').carousel();
			carousels.each(function(index, carousel){
				var carousel=$(carousel);
				if(carousel.hasClass('slide')){
					carousel.carousel('cycle');
				}else{
					carousel.carousel('pause');
				}
			});
		});
	}(window.jQuery));
</script>
<?php $this->load->view('common/footer'); ?>
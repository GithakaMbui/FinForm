<?php foreach($categories as $category): ?>
	<div class="panel product-category">
		<div class="container">
			<header class="header">
				<h2 class="title">
					<i class="fa fa-sitemap"></i>&nbsp;&nbsp;
					<?php echo ucwords(strtolower($category->name)); ?>
				</h2>
			</header>
			<section class="content">
				<div class="product-list">
					<?php $i=0; foreach($category->get_products() as $product): ?>
						<?php if($i<10): ?>
							<?php $i+=1; ?>
							<div class="col-md-3">
								<a href="<?php echo base_url("product/index/".($user && $user->id ? $user->id : '0')."/$product->id"); ?>">
									<?php $this->load->view('products/part-product-item', array('product'=>$product)); ?>
								</a>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					<span class="clearfix"></span>
				</div>
				<br/>
				<br/>
				<div class="the-more text-right">
					<a class="btn btn-primary" href="<?php ?>">
					  See more
					</a>
				</div>
			</section>
		</div>
	</div>
	<hr class="divider"/>
<?php endforeach; ?>
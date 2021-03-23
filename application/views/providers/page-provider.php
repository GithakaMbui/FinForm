<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page info-page">
	<header class="header">
		<div class="info-section">
			<h2 class="title">
				<?php echo $provider->name; ?>
				<span class="pull-right">
					<span class="btn-group">
						<a class="btn btn-primary" href="<?php echo base_url("dashboard/addprovider/$user->id"); ?>">
							Add Provider
						</a>
						<a class="btn btn-success" href="<?php echo base_url("dashboard/providers/$user->id"); ?>">
							All Providers
						</a>
					</span>
				</span>
				<span class="clearfix"></span>
			</h2>
			<hr class="divider"/>
			<br/>
				<?php if(isset($message) && $message): ?>
					<div class="col-md-12">
						<div class="container">
							<span class="alert alert-<?php echo ((isset($type)) ? $type : 'info'); ?>">
								<?php echo $message; ?>
							</span>
						</div>
					</div>
					<br/>
				<?php endif; ?>
			<div class="info">
				<div class="col-md-3">
				<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
				<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
				<?php if($provider->image): ?>
					<img style="width:150px; height:150px; border-radius: 80px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$provider->image"); ?>"/>
				<?php else: ?>
					<img style="width:150px; height:150px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
				<?php endif; ?>
				</div>
				<div class="col-md-6">
					<br/>
					<ul class="list-unstyled">
						<li>
							<span class="info-label">
								Industry
							</span>
							<span class="info-value">
								<?php echo ucwords(strtolower($provider->industry->name))?>
							</span>
						</li>
					</ul>
					<h4>
						<span class="info-label">
							Description
						</span>
					</h4>
					<p>
						<?php echo $provider->description; ?>
					</p>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
	</header>
	<section class="content">
		<div class="info-section">
			<h2 class="title">
				Products
			</h2>
			<hr class="divider"/>
			<br/>
			<div class="info">
				<div class="col-md-12">
					<?php foreach(($products=$provider->get_products()) as $product): ?>
						<div class="col-md-3">
							<?php 
									$this->load->view('products/part-product-item', array(
										'product'=>$product
									)); 
							?>
						</div>
					<?php endforeach; ?>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
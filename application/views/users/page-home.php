<?php $this->load->view('common/header'); ?>
<div class="panel page start-page user-home info-page">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-12 quick-trends">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li class="title">
						 <i class="fa fa-user"></i>&nbsp;
						 <?php  echo ucwords(strtolower($user->get_fullname())); ?>
					</li>
					<li class="active">
						 <a data-toggle="tab" href="#profile">
						 	Profile
						 </a>
					</li>
					<li>
						 <a data-toggle="tab" href="#preferences">
						 	Preferences
						 </a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="profile" class="tab-pane active profile-pane">
						<div class="col-md-3">
							<img class="user-pic img-responsive" src="<?php echo base_url('img/app/people/profile/johndoe.png'); ?>"/>
							<h2 class="username">
						 		<?php  echo ucwords(strtolower($user->get_fullname())); ?>
							</h2>
						</div>
						<div class="col-md-8">
							<ul class="list-unstyled user-info">
								<li>
									<span class="info-label">
										<i class="fa fa-envelope"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo $user->get_info('email'); ?>
									</span>
								</li>
								<li>
									<span class="info-label">
										<i class="fa fa-gift"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo ($points=$user->get_info('points')) ? $points : 0; ?> points
									</span>
								</li>
								<li>
									<span class="info-label">
										<i class="fa fa-calendar"></i>&nbsp;
									</span>
									<span class="info-value">
										<?php echo @date('Y-m-d', $user->created); ?>
									</span>
								</li>
							</ul>
						</div>
						<span class="clearfix"></span>
					</div>
					<div id="preferences" class="tab-pane">
						<div class="col-md-12">
							<h3 class="title row">Product Categories</h3>
							<ul class="list-unstyled">
								<?php foreach($categories as $category): ?>
									<li class="info-label" style="min-width: 100px; width:auto; margin-top: 20px; margin-right: 20px;">
										<a href="<?php echo base_url("products/index/$category->id"); ?>">
											<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
											<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
											<?php if($category->image): ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" src="<?php echo base_url("$item_images_dir_url/$category->image"); ?>"/>
											<?php else: ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
											<?php endif; ?>
											<?php echo ucwords(strtolower($category->name)); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
							<h3 class="title row">Products</h3>
							<ul class="list-unstyled">
								<?php foreach($categories as $category): ?>
									<?php foreach($category->get_products() as $product): ?>
										<li class="info-value" style="min-width: 100px; width:auto; margin-top: 20px;">
											<a href="<?php echo base_url("product/index/".($user && $user->id ? $user->id : "0")."/$product->id"); ?>">
												<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
												<?php $product_img=$this->config->item('app-default-item-image'); ?>
												<?php if($product->image) $product_img=$product->image?>
												<img style="width:40px; height:40px;" src="<?php echo base_url($item_images_dir_url.'/'.$product_img); ?>">
												<?php echo ucwords(strtolower($product->name)); ?>
											</a>
										</li>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<span class="clearfix"></span>
		</div>
		<hr class="divider"/>
	</header>
</div>
<?php $this->load->view('common/footer'); ?>
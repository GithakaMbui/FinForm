<div class="panel product-item">
	<header class="header">
		<div class="pic">
			<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
			<?php $product_img=$this->config->item('app-default-item-image'); ?>
			<?php if($product->image) $product_img=$product->image?>
			<img src="<?php echo base_url($item_images_dir_url.'/'.$product_img); ?>">
		</div>
	</header>
	<section class="content">
		<ul class="list-ustyled">
			<li class="name">
				<span class="info-value">
					<?php echo $product->name; ?>
				</span>
			</li>
			<li class="actions">
				<?php if($user->current_user('is_admin')): ?>
					<a class="btn btn-danger pull-left" href="<?php echo base_url("dashboard/removeproduct/$user->id/$product->id"); ?>">
						Remove
					</a>
				<?php endif; ?>
				<a class="btn btn-warning pull-right" href="<?php echo base_url("product/index/".($user && $user->id ? $user->id : "0")."/$product->id"); ?>">
					View
				</a>
				<span class="clearfix"></span>
			</li>
		</ul>
	</section>
</div>
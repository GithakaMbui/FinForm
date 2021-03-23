<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Add Product to Category
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/addproducttocategory/$user->id/$product->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input type="hidden" name="category[product]" value="<?php echo $product->id; ?>"/>
							<input class="form-control" type="text" value="<?php if(isset($product->name)) echo $product->name; ?>" disabled="disabled"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Category</label>
						<div class="col-md-8">
							<select class="form-control" name="category[category]">
								<option value="">None</option>
								<?php foreach($categories as $pcat): ?>
									<option value="<?php echo $pcat->id; ?>" <?php if(isset($parent) && $parent===$pcat->id): ?>selected<?php endif; ?>>
										<?php echo ucwords(strtolower($pcat->name)); ?>
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
					<div class="col-md-11">
						<input class="btn btn-success pull-right" name="usr_submit" value="Save Category" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
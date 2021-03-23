<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Edit Product (<?php echo ucwords(strtolower($product->name)); ?>)
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/addproduct/$user->id"); ?>">
					Add Product
				</a>
				<a class="btn btn-success" href="<?php echo base_url("dashboard/products/$user->id"); ?>">
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/editproduct/$user->id/$product->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="product[name]" value="<?php if(isset($product->name)) echo $product->name; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Type</label>
						<div class="col-md-8">
							<select class="form-control" name="product[type]">
								<option value="">Select Product Type</option>
								<option value="good" <?php if(isset($product->type) && $product->type==='good'): ?>selected<?php endif; ?>>Good</option>
								<option value="service" <?php if(isset($product->type) && $product->type==='service'): ?>selected<?php endif; ?>>Service</option>
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
						<textarea class="form-control" name="product[description]" placeholder="Enter brief product description here"><?php if(isset($product->description)) echo $product->description; ?></textarea>
					</div>
					<span class="clearfix"></span>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input class="btn btn-success pull-left" name="usr_submit" value="Save Product" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
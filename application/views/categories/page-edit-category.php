<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page products-management">
	<header class="header">
		<h1 class="title">
			Edit Category (<?php echo ucwords(strtolower($category->name));?>)
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/categories/$user->id"); ?>">
					All Categories
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
		<form class="form" method="post" action="<?php echo base_url("dashboard/editcategory/$user->id/$category->id"); ?>">
			<div class="row">
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-2">Name</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="category[name]" value="<?php if(isset($category->name)) echo $category->name; ?>"/>
						</div>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group">
						<label class="form-label col-md-3">Parent Category</label>
						<div class="col-md-8">
							<select class="form-control" name="category[industry]">
								<option value="">None</option>
								<?php foreach($categories as $pcat): if($pcat->id===$category->id) continue; ?>
									<option value="<?php echo $pcat->id; ?>" <?php if(isset($category->parent) && $category->parent===$pcat->id): ?>selected<?php endif; ?>>
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
					<label class="form-label col-md-1">Category Number</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="category[order]" value="<?php if(isset($category->order)) echo $category->order; ?>"/>
					</div>
					<span class="clearfix"></span>
				</div>
			</div>
			<div class="row">
				<br/>
				<div class="form-group">
					<div class="col-md-11">
						<textarea class="form-control" name="category[description]" placeholder="Enter brief description of the category here"><?php if(isset($category->description)) echo $category->description; ?></textarea>
					</div>
					<span class="clearfix"></span>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input class="btn btn-success pull-left" name="usr_submit" value="Save Category" type="submit"/>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
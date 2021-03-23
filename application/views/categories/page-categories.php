<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page items-management categorys-management">
	<header class="header">
		<h1 class="title">
			Categories
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/addcategory/$user->id"); ?>">
					Add Category
				</a>
			</span>
			<form class="navbar-form pull-right" method="post" action="<?php echo base_url("categories/search/$user->id"); ?>">
				<div class="form-group">
					<input class="form-control" type="text" name="name" placeholder="Search by name"/>
				</div>
				<input type="hidden" name="usr_submit" value="true"/>
			</form>
			<span class="clearfix"></span>
		</h1>
	</header>
	<section class="content">
		<hr class="divider"/>
		<div class="table-panel">
			<section class="content">
				<?php if(isset($message) && $message): ?>
					<div class="container">
						<span class="alert alert-<?php echo ((isset($type)) ? $type : 'info'); ?>">
							<?php echo $message; ?>
						</span>
					</div>
					<br/>
				<?php endif; ?>
				<table class="table table-bordered table-stripped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Data Points</th>
							<th>Added</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($categories as $category): ?>
							<tr class="table-item">
								<td><?php echo $i; ?></td>
								<td>
									<ul class="list-unstyled list-inline">
										<li>
											<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
											<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
											<?php if($category->image): ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$category->image"); ?>"/>
											<?php else: ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
											<?php endif; ?>
										</li>
										<li><?php echo ucwords(strtolower($category->name)); ?></li>
									</ul>
								</td>
								<td>
									<ul class="list-unstyled">
										<?php foreach($category->get_datapoints() as $datapoint): ?>
											<li>
												<ul class="list-unstyled">
													<li>
														<a style="color:#5201e9;" href="<?php echo base_url("dashboard/datapoint/$user->id/$datapoint->id");?>">
															<?php echo $datapoint->name; ?>
														</a>
													</li>
													<li>
														<a class="label label-danger" href="<?php echo base_url("dashboard/removedatapoint/$user->id/$datapoint->id");?>">Remove</a>
														&nbsp;&nbsp;<a class="label label-info" href="<?php echo base_url("dashboard/editdatapoint/$user->id/$datapoint->id");?>">Edit</a>
													</li>
												</ul>
											</li>
											<li><br/></li>
										<?php endforeach;?>
										<li>
											<a class="btn btn-default" href="<?php echo base_url("dashboard/adddatapoint/$user->id/$category->id"); ?>">
												 Add Data Point
											</a>
										</li>
									</ul>
								</td>
								<td><?php echo date('Y-m-d', $category->created); ?></td>
								
								<td class="actions text-center">
									<span class="btn-group">
										<a class="btn btn-info" href="<?php echo base_url("dashboard/editcategory/$user->id/$category->id"); ?>">
											<i class="fa fa-edit"></i>&nbsp;Edit
										</a>
										<a class="btn btn-danger" href="<?php echo base_url("dashboard/removecategory/$user->id/$category->id"); ?>">
											<i class="fa fa-remove"></i>&nbsp;Remove
										</a>
									</span>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</section>
		</div>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
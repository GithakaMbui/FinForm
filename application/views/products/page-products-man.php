<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page items-management products-management">
	<header class="header">
		<h1 class="title">
			Products
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/addproduct/$user->id"); ?>">
					Add Product
				</a>
			</span>
			<form class="navbar-form pull-right" method="post" action="<?php echo base_url("products/search/$user->id"); ?>">
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
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Type</th>
							<th>Categories</th>
							<th>Data Points</th>
							<th>Added</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($products as $product): ?>
							<tr class="table-item">
								<td><?php echo $i; ?></td>
								<td>
									<ul class="list-unstyled list-inline">
										<li>
											<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
											<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
											<?php if($product->image): ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$product->image"); ?>"/>
											<?php else: ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
											<?php endif; ?>
										</li>
										<li><?php echo ucwords(strtolower($product->name)); ?></li>
									</ul>
								</td>
								<td><?php echo ucwords($product->type); ?></td>
								<td>
									<ul class="list-unstyled">
										<?php if(count($categories=$product->get_categories())): ?>
											<?php foreach($categories as $category):  ?>
												<li>
													<ul class="list-unstyled">
														<li>
															<?php echo ucwords(strtolower($category->name)); ?>
														</li>
														<li>
															<a class="label label-danger" href="<?php echo base_url("dashboard/removeproductfromcategory/$user->id/$product->id/$category->id"); ?>">
															  Remove category
															</a>
														</li>
														<li>
															<br/>
														</li>
													</ul>
												</li>
											<?php endforeach; ?>
										<?php endif; ?>
										<li>
											<a class="btn btn-default" href="<?php echo base_url("dashboard/addproducttocategory/$user->id/$product->id"); ?>">
											  Add to Category
											</a>
										</li>
									</ul>
								</td>
								<td>
									<ul class="list-unstyled">
										<?php if(count($datapoints=$product->get_product_datapoint_attrs())): ?>
											<?php foreach($datapoints as $datapoint):  ?>
													<li>
														<ul class="list-unstyled">
															<li>
																<?php echo ucwords(strtolower($datapoint->name)); ?>
															</li>
															<li>
																<a class="label label-success" href="<?php echo base_url("product/addproductdata/$user->id/$product->id/$datapoint->id"); ?>">
																	Add a <?php echo ucwords(strtolower($datapoint->name)); ?>
																</a>
															</li>
															<li><br/></li>
														</ul>
													</li>
											<?php endforeach; ?>
										<?php else: ?>
											<li>
												<span class="label label-info">
													Attach categories to get data points
												</span>
											</li>
										<?php endif; ?>
									</ul>
								</td>
								<td><?php echo date('Y-m-d', $product->created); ?></td>
								
								<td class="actions text-center">
									<span class="btn-group">
										<a class="btn btn-success" href="<?php echo base_url("dashboard/product/$user->id/$product->id"); ?>">
											<i class="fa fa-eye"></i>&nbsp;View
										</a>
										
										<a class="btn btn-info" href="<?php echo base_url("dashboard/editproduct/$user->id/$product->id"); ?>">
											<i class="fa fa-edit"></i>&nbsp;Edit
										</a>
										<a class="btn btn-danger" href="<?php echo base_url("dashboard/removeproduct/$user->id/$product->id"); ?>">
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
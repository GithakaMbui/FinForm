<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page items-management">
	<header class="header">
		<h1 class="title">
			<i class="fa fa-shopping-cart"></i>
			Providers
			<span class="pull-right">
				<span class="btn-group">
					<a class="btn btn-primary" href="<?php echo base_url("dashboard/addprovider/$user->id"); ?>">
						Add Provider
					</a>
				</span>
			</span>
			<form class="navbar-form pull-right" method="post" action="<?php echo base_url("providers/search/$user->id"); ?>">
				<div class="form-group">
					<input class="form-control" type="text" name="industry" placeholder="Search Industry"/>
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
				<br/><br/>
				<ul id="providers-tabs" class="nav nav-tabs">
					<?php $i=0; foreach($industries as $industry): ?>
						<li<?php if($i===0): ?> class="active"<?php endif; ?>>
							<a href="#industry-<?php echo $industry->id; ?>">
								<?php echo ucwords(strtolower($industry->name)); ?>
							</a>
						</li>
					<?php $i++; endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php $i=0; foreach($industries as $industry): $providers=$industry->get_providers(); ?>
						<div id="industry-<?php echo $industry->id; ?>" class="tab-pane<?php if($i===0): ?> active<?php endif; ?>">
							<br/><br/><table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Country</th>
										<th>Industry</th>
										<th>Added</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach($providers as $provider): ?>
										<tr class="table-item">
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<ul class="list-unstyled list-inline">
													<li>
														<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
														<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
														<?php if($provider->image): ?>
															<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$provider->image"); ?>"/>
														<?php else: ?>
															<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
														<?php endif; ?>
													</li>
													<li><?php echo $provider->name; ?></li>
												</ul>
											</td>
											<td>
												<?php echo ucwords(strtolower($provider->country)); ?></td>
											<td>
												<?php echo ucwords(strtolower($provider->industry->name)); ?>
											</td>
											<td><?php echo date('Y-m-d', $provider->created); ?></td>
											
											<td class="actions text-center">
												<span class="btn-group">
													<a class="btn btn-success" href="<?php echo base_url("dashboard/provider/$user->id/$provider->id"); ?>">
														<i class="fa fa-eye"></i>&nbsp;View
													</a>
													
													<a class="btn btn-info" href="<?php echo base_url("dashboard/editprovider/$user->id/$provider->id"); ?>">
														<i class="fa fa-edit"></i>&nbsp;Edit
													</a>
													<a class="btn btn-danger" href="<?php echo base_url("dashboard/removeprovider/$user->id/$provider->id"); ?>">
														<i class="fa fa-remove"></i>&nbsp;Remove
													</a>
												</span>
											</td>
										</tr>
									<?php $i++; endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php endforeach; ?>
				</div>
			</section>
		</div>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
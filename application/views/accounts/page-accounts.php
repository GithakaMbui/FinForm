<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page items-management accounts-management">
	<header class="header">
		<h1 class="title">
			Accounts
			<span class="btn-group pull-right">
				<a class="btn btn-success" href="<?php echo base_url("dashboard/leaderboard/$user->id"); ?>">
					Account Leaderboard
				</a>
			</span>
			<form class="navbar-form pull-right" method="post" action="<?php echo base_url("users/search/$user->id"); ?>">
				<div class="form-group">
					<input class="form-control" type="text" name="name" placeholder="Search by firstname"/>
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
							<th>Points</th>
							<th>Account status</th>
							<th>Added</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($accounts['results'] as $account): ?>
							<tr class="table-item">
								<td><?php echo $i; ?></td>
								<td>
									<ul class="list-unstyled list-inline">
										<li>
											<?php $item_images_dir_url=$this->config->item('app-items-images-dir-uri'); ?>
											<?php $default_item_img=$this->config->item('app-default-item-image'); ?>
											<?php if($account->pic): ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$account->pic"); ?>"/>
											<?php else: ?>
												<img style="width:60px; height:60px; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px;" class="image" src="<?php echo base_url("$item_images_dir_url/$default_item_img"); ?>"/>
											<?php endif; ?>
										</li>
										<li><?php echo ucwords(strtolower($account->get_fullname())); ?></li>
									</ul>
								</td>
								<td><?php echo $account->get_info('points'); ?></td>
								<td><?php echo $account->get_info('status'); ?></td>
								<td><?php echo $account->created; ?></td>
								
								<td class="actions text-center">
									<span class="btn-group">
										<a class="btn btn-success" href="<?php echo base_url("dashboard/account/$user->id/$account->id"); ?>">
											<i class="fa fa-eye"></i>&nbsp;View
										</a>
										
										<a class="btn btn-info" href="<?php echo base_url("dashboard/editaccount/$user->id/$account->id"); ?>">
											<i class="fa fa-edit"></i>&nbsp;Edit
										</a>
										<a class="btn btn-warning" href="<?php echo base_url("dashboard/activateaccount/$user->id/$account->id"); ?>">
											<i class="fa fa-user"></i>&nbsp;Activate
										</a>
										<a class="btn btn-danger" href="<?php echo base_url("dashboard/removeaccount/$user->id/$account->id"); ?>">
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
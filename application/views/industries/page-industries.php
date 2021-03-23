<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel page items-management industries-management">
	<header class="header">
		<h1 class="title">
			Industries
			<span class="btn-group pull-right">
				<a class="btn btn-primary" href="<?php echo base_url("dashboard/addindustry/$user->id"); ?>">
					Add Industry
				</a>
			</span>
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
							<th>Added</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($industries as $industry): ?>
							<tr class="table-item">
								<td><?php echo $i; ?></td>
								<td>
									<?php echo ucwords(strtolower($industry->name)); ?>
								</td>
								<td><?php echo date('Y-m-d', $industry->created); ?></td>
								
								<td class="actions text-center">
									<span class="btn-group">
										<a class="btn btn-info" href="<?php echo base_url("dashboard/editindustry/$user->id/$industry->id"); ?>">
											<i class="fa fa-edit"></i>&nbsp;Edit
										</a>
										<a class="btn btn-danger" href="<?php echo base_url("dashboard/removeindustry/$user->id/$industry->id"); ?>">
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
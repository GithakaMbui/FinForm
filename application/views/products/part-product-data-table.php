<div class="panel table datapoint-data">
	<header class="header">
		<h4>
			<?php echo ($datapoint_name=ucwords(strtolower($datapoint->name))); ?> History
		</h4>
	</header>
	<section class="content">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>
						#
					</th>
					<th>
						Provider
					</th>
					<th>
						Region
					</th>
					<th>
						<?php echo $datapoint_name; ?>
					</th>
					<th>
						Date
					</th>
					<?php if($user->current_user('is_admin')): ?>
						<th>
							Actions
						</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php if(count($products=$product->get_datapoints($data_params))): ?>
					<?php $i=1; foreach($products as $data): ?>
						<tr>
							<td>
								<?php echo $i; ?>
							</td>
							<td>
								<?php echo ucwords(strtolower($data->provider->name)); ?>
							</td>
							<td>
								<?php echo ucwords(strtolower($data->region->name)); ?>
							</td>
							<td>
								<?php echo $data->value; ; ?>
							</td>
							<td>
								<?php echo date('Y-m-d', $data->date); ?>
							</td>
							<?php if($user->current_user('is_admin')): $pid=$data->product->id; ?>
								<td>
									<a class="btn btn-info" href="<?php echo base_url("product/editproductdata/$user->id/$pid/$data->id"); ?>">
										Edit
									</a>
									<a class="btn btn-danger" href="<?php echo base_url("product/removeproductdata/$user->id/$data->id"); ?>">
										Delete
									</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php $i+=1; endforeach; ?>
				<?php else: ?>
					<tr>
						<td>
							<br/><br/>
							<div class="row col-md-12">
								<div class="container">
									<span class="alert alert-danger">No data item found</span>
								</div>
							</div>
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</section>
</div>
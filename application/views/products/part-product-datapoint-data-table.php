<div class="panel table datapoint-data">
	<header class="header">
		<h4>
			<?php echo ($datapoint_name=ucwords(strtolower($datapoint->name))); ?> History
			<span class="pull-right">
				<span class="btn-group">
					<?php if($user->current_user('is_signed_in')): ?>
						<a data-toggle="modal" data-target="#add-datapoint<?php echo $datapoint->id; ?>-data" class="btn btn-primary" href="#add-datapoint<?php echo $datapoint->id; ?>-data">
							Add A <?php echo $datapoint_name; ?>
						</a>
					<?php endif; ?>
					<a data-toggle="modal" data-target="#compare-datapoint<?php echo $datapoint->id; ?>-data" class="btn btn-success" href="#add-datapoint<?php echo $datapoint->id; ?>-data">
						Compare <?php echo $datapoint_name; ?>
					</a>
				</span>
			</span>
			<span class="clearfix"></span>
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
				<?php $i=1; foreach($product->get_datapoints(array('datapoint'=>$datapoint->id)) as $data): ?>
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
			</tbody>
		</table>
	</section>
</div>
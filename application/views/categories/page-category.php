<?php $this->load->view('common/header'); ?>
<div class="panel page info-page">
	<header class="header">
		<div class="info-section">
			<h2 class="title">
				<?php echo $category->name; ?>
			</h2>
			<div class="info">
				<div class="col-md-6">
					<img src=""/>
				</div>
				<div class="col-md-6">
					<ul class="list-unstyled">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
					<p>
						<?php echo $category->description; ?>
					</p>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
	</header>
	<section class="content">
		 <div class="info-section">
			<h2 class="title">
			 	Datapoints
			</h2>
			<div class="info">
				<div class="col-md-6">
					<ul class="list-unstyled">
						<?php foreach(($datapoints=$category->get_datapoints()) as $datapoint): ?>
							<li>
								<?php ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-md-6">
					<h3 class="sub-title"></h3>
					<form class="navbar-form"></form>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
		<div class="info-section">
			<h2 class="title">
				Products
			</h2>
			<div class="info">
				<div class="col-md-6">
					<ul class="list-unstyled">
						<?php foreach(($products=$category->get_datapoints()) as $datapoint): ?>
							<li>
								<?php ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('common/footer'); ?>
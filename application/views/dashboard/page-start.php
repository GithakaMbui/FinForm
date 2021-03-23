<?php $this->load->view('common/master-detail-header'); ?>
<div class="panel content-page dashboard-page">
	<section class="content">
		<h1 class="big-title">Summary</h1>
		<hr class="divider"/>
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-info">
				  <div class="panel-heading">
				     Available Products
				  </div>
				  <div class="panel-body text-center">
				  	  <span class="label label-danger">
				  	  		<?php echo count($products); ?>
				  	  </span>
				  	  <br/>
				  	  <h2 class="title">
				  	  	Products
				  	  </h2>
				  	  <div class="row">
				  	  	  <a class="btn btn-success pull-left" href="<?php echo base_url("dashboard/products/$user->id"); ?>">
				  	  	  	View All
				  	  	  </a>
				  	  	  <a class="btn btn-primary pull-right" href="<?php echo base_url("dashboard/addproduct/$user->id"); ?>">
				  	  	  	Add Product
				  	  	  </a>
				  	  	  <span class="clearfix"></span>
				  	  </div>
				  </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-success">
				  <div class="panel-heading">
				     Available Providers
				  </div>
				  <div class="panel-body text-center">
				  	  <span class="label label-danger">
				  	  		<?php echo count($providers); ?>
				  	  </span>
				  	  <br/>
				  	  <h2 class="title">
				  	  	Providers
				  	  </h2>
				  	  <div class="row">
				  	  	  <a class="btn btn-success pull-left" href="<?php echo base_url("dashboard/providers/$user->id"); ?>">
				  	  	  	View All
				  	  	  </a>
				  	  	  <a class="btn btn-primary pull-right" href="<?php echo base_url("dashboard/addprovider/$user->id"); ?>">
				  	  	  	Add Provider
				  	  	  </a>
				  	  	  <span class="clearfix"></span>
				  	  </div>
				  </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
				  <div class="panel-heading">
				     Available 	Regions
				  </div>
				  <div class="panel-body text-center">
				  	  <span class="label label-danger">
				  	  		<?php echo count($regions); ?>
				  	  </span>
				  	  <br/>
				  	  <h2 class="title">
				  	  	Regions
				  	  </h2>
				  	  <div class="row">
				  	  	  <a class="btn btn-success pull-left" href="<?php echo base_url("dashboard/regions/$user->id"); ?>">
				  	  	  	View All
				  	  	  </a>
				  	  	  <a class="btn btn-primary pull-right" href="<?php echo base_url("dashboard/addregion/$user->id"); ?>">
				  	  	  	Add Region
				  	  	  </a>
				  	  	  <span class="clearfix"></span>
				  	  </div>
				  </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-warning">
				  <div class="panel-heading">
				     Products Categories
				  </div>
				  <div class="panel-body text-center">
				  	  <span class="label label-danger">
				  	  		<?php echo count($categories); ?>
				  	  </span>
				  	  <br/>
				  	  <h2 class="title">
				  	  	Categories
				  	  </h2>
				  	  <div class="row">
				  	  	  <a class="btn btn-success pull-left" href="<?php echo base_url("dashboard/categories/$user->id"); ?>">
				  	  	  	View All
				  	  	  </a>
				  	  	  <a class="btn btn-primary pull-right" href="<?php echo base_url("dashboard/addcategory/$user->id"); ?>">
				  	  	  	Add Category
				  	  	  </a>
				  	  	  <span class="clearfix"></span>
				  	  </div>
				  </div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('common/master-detail-footer'); ?>
<?php $this->load->view('common/header'); ?>
<div class="panel page start-page user-home preferences-page">
	<header class="header">
		<div class="panel hero">
			<div class="col-md-12 quick-trends">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li class="title">
						 <i class="fa fa-user"></i>&nbsp;
						 <?php  echo ucwords(strtolower($user->get_fullname())); ?>
					</li>
					<li class="active">
						 <a data-toggle="tab" href="#preferences">
						 	Set Preferences
						 </a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="preferences" class="tab-pane active profile-pane">
						<?php if(isset($message)): ?>
							<div class="container">
								<span class="alert alert-<?php echo (isset($type) ? $type : 'info')?>">
									<?php echo $message; ?>
								</span>
							</div>
						<?php endif; ?>
						<div id="preferences-wizard" class="carousel slide">
							<form method="post" action="<?php echo base_url("user/setup/$user->id"); ?>">
								<input type="hidden" name="usr_submit" value="trsadasue"/>
								<div class="carousel-inner">
									<div class="item active categories">
										<h1 class="sub-title">Choose a product categories</h1>
										<div class="select-form categories">
											<?php foreach($categories as $category): ?>
												<label class="checkbox-inline">
												  <input type="checkbox" name="categories_preferences[cat-<?php echo $category->id; ?>]" data-ppane-id="#cat-products-<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">
												</label>
												<?php echo ucwords(strtolower($category->name)); ?>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="item products">
										<h1 class="sub-title">Choose prefered products</h1>
										<?php foreach($categories as $category): ?>
											<div id="cat-products-<?php echo $category->id; ?>" class="category-products hidden">
												<?php foreach($category->get_all_products() as $product): ?>
													<label class="checkbox-inline">
													  <input type="checkbox" name="products_preferences[prod-<?php echo $product->id; ?>]"  value="<?php echo $product->id; ?>">
													</label>
												<?php echo ucwords(strtolower($product->name)); ?>
												<?php endforeach; ?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</form>
							<a class="carousel-control btn btn-default left" href="#preferences-wizard" data-slide="prev"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Prev</a>
							<a class="carousel-control btn btn-primary right" href="#preferences-wizard" data-slide="next"><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;Next</a>
						</div>
					</div>
					<script type="text/javascript">
						(function($){
							$(function(){
								 var PreferencesWizard=$('#preferences-wizard').carousel();
								 PreferencesWizard.carousel('pause');
								 PreferencesWizard.find('.checkbox-inline input').change(function(e){
								 	 var productsPane=$($(e.currentTarget).attr('data-ppane-id'));
								 	 productsPane.removeClass('hidden');
								 });

								 PreferencesWizard.find('.carousel-control.right').click(function(e){
								 	e.preventDefault();
								 	PreferencesWizard.carousel('pause');
								 	var activeItem=PreferencesWizard.find('.item.active');
								 	if(activeItem.hasClass('products')){
								 		PreferencesWizard.find('form').submit();
								 	}
								 	else{
								 		PreferencesWizard.carousel('next');
								 	}
								 });

								 PreferencesWizard.on('slid.bs.carousel', function(e){
								 	var activeItem=PreferencesWizard.find('.item.active');
								 	if(activeItem.hasClass('products')){
								 		PreferencesWizard.find('.carousel-control.left').hide();
								 		PreferencesWizard.find('.item:not(.active)').addClass('hidden');
								 	}
								 });
							});
						}(window.jQuery));
					</script>
				</div>
			</div>
			<span class="clearfix"></span>
		</div>
		<hr class="divider"/>
	</header>
</div>
<?php $this->load->view('common/footer'); ?>
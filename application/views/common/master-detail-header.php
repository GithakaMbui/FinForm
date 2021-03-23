<?php $this->load->view('common/header'); ?>
<div class="panel page user-page">
	<section class="content">
		<a class="btn-toggle-master" href="#">
			<i class="fa fa-list"></i>
		</a>
		<div id="master-detail-view" class="panel master-detail<?php if(isset($no_master))echo ' closed'; ?>">
			<section class="content">
				<?php if(!isset($no_master)): ?>
					<div class="master">
						<ul class="menu list-unstyled">
							<?php $this->load->view('dashboard/master-menu'); ?>
							<?php $this->load->view('industries/master-menu'); ?>
							<?php $this->load->view('providers/master-menu'); ?>
							<?php $this->load->view('regions/master-menu'); ?>
							<?php $this->load->view('products/master-menu'); ?>
							<?php $this->load->view('accounts/master-menu'); ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="detail">
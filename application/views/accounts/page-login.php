<?php $this->load->view('common/header', array('no_header'=>true)); ?>
<div class="panel page account-page">
	<section class="content">
		 <div class="panel">
		 	<section class="content">
			    <div class="container">
			      <form class="form-signin animated bounceInDown" method="post" action="<?php echo base_url('accounts/login'); ?>">
			    	<?php if(isset($message)): ?>
			    		<span class="alert alert-danger">
			    			<?php echo $message; ?>
			    		</span>
			    	<?php endif; ?>
			    	<h2 class="title form-signin-heading"><?php echo $this->config->item('app-name'); ?> | Login</h2>
			        <input type="text" name="account[email]" class="form-control" placeholder="Email address" autofocus>
			        <input type="password"  name="account[password]"  class="form-control" placeholder="Password">
			        <label class="checkbox">
			          <input type="checkbox" name="account_remme" value="remember-me"> Remember me
			        </label>
			        <button type="submit" class="btn btn-lg btn-warning btn-block" name="usr_submit" value="true">Login</button>
			      </form>
			    </div> <!-- /container -->
    		</section>
		 </div>
	</section>
</div>
<?php $this->load->view('common/footer'); ?>

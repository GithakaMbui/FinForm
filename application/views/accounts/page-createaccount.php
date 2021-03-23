<?php $this->load->view('common/header', array('no_header'=>true)); ?>
<div class="panel page account-page">
	<section class="content">
		 <div class="panel">
		 	<section class="content">
			    <div class="container">
			      <form class="form-signin animated bounceInDown" method="post" action="<?php echo base_url('accounts/createaccount'); ?>">
			    	<?php if(isset($message)): ?>
			    		<span class="alert alert-danger">
			    			<?php echo $message; ?>
			    		</span>
			    	<?php endif; ?>
			    	<h2 class="title form-signin-heading"><?php echo $this->config->item('app-name'); ?> | Account</h2>
			        <input type="text" name="account[firstname]" class="form-control" placeholder="Firstname" autofocus/>
			        <input type="text" name="account[lastname]" class="form-control" placeholder="Lastname"/>
			        <input type="text" name="account[email]" class="form-control" placeholder="Email address"/>
			        <input type="password"  name="account[password]"  class="form-control" placeholder="Password"/>
			        <input type="password"  name="account[c_password]"  class="form-control" placeholder="Confirm password"/>
			        <label class="checkbox">
			          <input type="checkbox" name="accepts_terms" value="yes"> I agree to the terms and conditions.
			        </label>
			        <button type="submit" class="btn btn-lg btn-warning btn-block" name="usr_submit" value="true">Create Account</button>
			      </form>
			    </div> <!-- /container -->
    		</section>
		 </div>
	</section>
</div>
<?php $this->load->view('common/footer'); ?>

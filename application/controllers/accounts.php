<?php if(!defined('BASEPATH')) exit("Access Denied");
/**
 *accounts
 *
 *Defines Accounts Controller
 *
 */

/**
 *Accounts
 *
 *Accounts related actions
 *
 *@uses Active_Controller
 *
 */
class Accounts extends Active_Controller
{
	 /*
	 *@var $models array, controller autoload models
	 */
	protected $models=array('users');

	/**
	 *__construct
	 *
	 *Controller constructor and front-controller
	 *
	 *@access public
	 *@return $instance Accounts, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
		$this->pre_action();
	}

	/**
	 *pre_action
	 *Controller pre action hook, codeignitor's is kinda costly
	 *
	 *@access public
	 */
	protected function pre_action()
	{
		if($this->users->current_user('is_signed_in'))
		{
			$action=$this->uri->segment(2);

			if('logout'!==$action)
			{
				redirect(base_url($this->users->current_user('home_url')));
			}
		}
	}

	/**
	 *
	 */
	public function createaccount($message_type=null)
	{
		if($this->input->post('usr_submit'))
		{
			$account=$this->input->post('account');

			$this->data=$this->users->create_account($account, array(
				'accepts_terms'=>'yes'
			));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				redirect(base_url($this->users->current_user('home_url')));
			}
		}

		$this->send_response($this->data, array('accounts/page-createaccount'));
	}


	/**
	 *
	 */
	public function login($message_type=null)
	{
		if($this->input->post('usr_submit'))
		{
			$account=$this->input->post('account');

			$this->data=$this->users->login_account($account);

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				redirect(base_url($this->users->current_user('home_url')));
			}
		}

		$this->send_response($this->data, array('accounts/page-login'));
	}

	/**
	 *
	 */
	public function logout()
	{
		$this->data=$this->users->logout_account();

		if(false===$this->data['error'] && !$this->is_ajax_request())
		{
			$message=$this->input->get('message');
			redirect(base_url("app/start?message=$message"));
		}

		$this->send_response($this->data, array('accounts/page-login'));
	}

	/**
	 *
	 */
	public function index()
	{
		$this->login();
	}
}
<?php if (!defined('BASEPATH')) exit('Access Denied');
/**
 *Welcome
 *
 *Define welcome controller
 */

/**
 *Welcome
 *
 *Application Front-controller
 *
 *@uses Active/Active_Controller
 */
class Welcome extends Active_Controller
{	
	/**
	 *@var $models, controller autoload models
	 */
	protected $models=array('users', 'categories', 'products');

	/**
	 *__construct
	 *
	 *@access public
	 *@return $instance App, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *redirect
	 *
	 *@access public
	 */
	protected function redirect()
	{
		if($this->users->current_user('is_admin'))
		{
			$user_id=$this->users->current_user('uid');
			redirect(base_url("dashboard/index/$user_id"));
		}
		redirect(base_url("app"));
	}

	public function index() 
	{  
		$this->redirect();
	}
}


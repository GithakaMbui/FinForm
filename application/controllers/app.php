<?php if(!defined('BASEPATH')) exit("Access Denied");
/**
 *app
 *
 *Define app controller
 *
 */

/**
 *App
 *
 *Default Application controller
 *
 *@uses Active/Active_Controller
 */
class App extends Active_Controller
{
	/**
	 *@var $models, controller autoload models
	 */
	protected $models=array('users', 'categories', 'products', 'providers', 'regions');

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
	 *start
	 *
	 *@access public
	 */
	public function start()
	{
		$user=$this->users->get_user(array('id'=>$this->users->current_user('uid')));
		$this->data['products']=$this->products->get_products();
		$this->data['categories']=$this->categories->get_categories();
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->data['user']= $user ? $user : $this->users;
		$this->send_response($this->data, array('app/page-start'));
	}

	/**
	 *index
	 *
	 *@access public
	 */
	public function index()
	{
		$this->start();
	}
}
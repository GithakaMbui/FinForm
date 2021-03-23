<?php if(!defined('BASEPATH')) exit("Access Denied");
class User extends Active_Controller
{
	protected $models=array('users', 'products', 'categories', 'providers', 'regions');

	public function __construct()
	{
		parent::__construct();
	}

	public function setup($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($user->current_user('is_admin'))
				redirect(base_url("dashboard/start/$user->id"));

		if($this->input->post('usr_submit'))
		{
			$categories_preferences=$this->input->post('categories_preferences');
			$products_preferences=$this->input->post('products_preferences');

			$this->data=$user->save_settings(array(
				'categories_preferences'=>serialize($categories_preferences),
				'products_preferences'=>serialize($products_preferences)
			));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$user->save_settings(array('setup_done'=>'yes'));
				$redirect_url=base_url("user/home/$user->id");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['categories']=$this->categories->results();
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->send_response($this->data, array('users/page-set-preferences'));
	}

	public function home($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($user->current_user('is_admin'))
				redirect(base_url("dashboard/start/$user->id"));
		if($user->get_info('setup_done')!=='yes')
			redirect(base_url("user/setup/$user->id"));

		$this->data['user']=$user;
		$this->data['categories']=$this->categories->get_categories();
		$this->send_response($this->data, array('users/page-home'));
	}

	public function index($id=null)
	{
		$this->home($id);
	}
}
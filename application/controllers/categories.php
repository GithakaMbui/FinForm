<?php if(!defined('BASEPATH')) exit("Access Denied");
class Categories extends Active_Controller
{
	protected $models=array('users', 'categories');

	public function __construct()
	{
		parent::__construct();
	}

	public function search($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!$this->input->post('usr_submit')) 
				redirect(base_url("dashboard/categories/$user->id"));

		$name=$this->input->post('name');
		$categories=$this->categories->like(array('name'=>$name))->results();
		$this->data['user']=$user;
		$this->data['categories']=$categories;
		$this->data['type']= (count($categories) ? 'success' : 'info');
		$this->data['message']= (($count=count($categories)) ? "$count items found": 'No category found with that name');
		$this->send_response($this->data, array('categories/page-categories'));
	}
}
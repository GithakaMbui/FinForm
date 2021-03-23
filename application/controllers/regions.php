<?php if(!defined('BASEPATH')) exit("Access Denied");
class Regions extends Active_Controller
{
	protected $models=array('users', 'regions');

	public function __construct()
	{
		parent::__construct();
	}

	public function search($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!$this->input->post('usr_submit')) 
				redirect(base_url("dashboard/regions/$user->id"));

		$name=$this->input->post('name');
		$regions=$this->regions->like(array('name'=>$name))->results();
		$this->data['user']=$user;
		$this->data['regions']=$regions;
		$this->data['type']= (count($regions) ? 'success' : 'info');
		$this->data['message']= (($count=count($regions)) ? "$count items found": 'No regions found with that name');
		$this->send_response($this->data, array('regions/page-regions'));
	}
}
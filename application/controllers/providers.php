<?php if(!defined('BASEPATH')) exit("Access Denied");
class Providers extends Active_Controller
{
	protected $models=array('users', 'providers');

	public function __construct()
	{
		parent::__construct();
	}

	public function search($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!$this->input->post('usr_submit')) 
				redirect(base_url("dashboard/providers/$user->id"));

		$industry_name=$this->input->post('industry');
		$providers=$this->providers->like(array('industry'=>$industry_name))->order_by('name', 'ASC')->results();
		$this->data['user']=$user;
		$this->data['providers']=$providers;
		$this->data['type']= (count($providers) ? 'success' : 'info');
		$this->data['message']= (($count=count($providers)) ? "$count items found": 'No providers found in that industry');
		$this->send_response($this->data, array('providers/page-providers'));
	}
}
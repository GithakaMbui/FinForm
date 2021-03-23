<?php if(!defined('BASEPATH')) exit("Access Denied");
class Users extends Active_Controller
{
	protected $models=array('users');

	public function __construct()
	{
		parent::__construct();
	}

	public function search($id=null, $cat_id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!$this->input->post('usr_submit')) 
				redirect(base_url("dashboard/accounts/$user->id"));

		$name=$this->input->post('name');
		$accounts=$this->users->like(array('firstname'=>$name))->paged_results();
		$this->data['user']=$user;
		$this->data['accounts']=$accounts;
		$this->data['type']= (count($accounts['results']) ? 'success' : 'info');
		$this->data['message']= (($count=count($accounts['results'])) ? "$count items found": 'No account found with that name');
		$this->send_response($this->data, array('accounts/page-accounts'));

	}
}
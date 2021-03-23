<?php if(!defined('BASEPATH')) exit("Access Denied");
class Products extends Active_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->pre_action();
	}

	public function pre_action()
	{

	}

	public function products($uid=null, $category='all')
	{

	}

	public function product($uid=null, $pid=null)
	{

	}
}
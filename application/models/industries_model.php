<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'industry_model.php';
class Industries_model extends Industry_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function get_providers(array $params=array())
	{
		$this->load->model('providers_model', 'industry_providers');
		return $this->industry_providers->get_providers(array_merge($params, array(
			'industry'=>$this->id
		)));
	}

	public function add_industry(array $industry)
	{
		return $this->add_one(array_merge($industry, array(
			'created'=>time()
		)));
	}

	public function get_industries(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->results();
		return $this->results();
	}

	public function get_industry($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);

		return array_pop($this->get_industries($params));
	}
}

<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'provider_model.php';
class Providers_model extends Provider_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}


	public function get_products(array $params=array())
	{
		$this->load->model('product_datapoints_model', 'product_datapoints');

		$products=array();
		$datapoints=$this->product_datapoints->get_datapoints(array('provider'=>$this->id));
		foreach ($datapoints as $datapoint)
		{
			$products[$datapoint->id]=$datapoint->product;
		}
		return $products;
	}

	public function add_provider(array $provider)
	{
		return $this->add_one(array_merge($provider, array(
			'created'=>time()
		)));
	}

	public function get_providers(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->order_by('name', 'ASC')->results();
		return $this->order_by('name', 'ASC')->results();
	}

	public function get_provider($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_providers($params));
	}
}

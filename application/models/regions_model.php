<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'region_model.php';
class Regions_model extends Region_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function add_region(array $region)
	{
		return $this->add_one(array_merge($region, array(
			'created'=>time()
		)));
	}

	public function get_regions(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->order_by('name', 'ASC')->results();
		return $this->order_by('name', 'ASC')->results();
	}

	public function get_region($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_regions($params));
	}
}

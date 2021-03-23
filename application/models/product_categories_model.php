<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'product_category_model.php';
class Product_categories_model extends Product_category_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}
	
	public function add_category(array $category)
	{
		return $this->add_one(array_merge($category, array(
			'created'=>time()
		)));
	}

	public function get_categories(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->order_by('created', 'DESC')->results();
		return $this->order_by('created', 'DESC')->results();
	}

	public function get_category($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_categories($params));
	}
}

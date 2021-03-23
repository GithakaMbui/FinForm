<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'product_model.php';
class Products_model extends Product_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function get_datapoints_structure(array $criteria)
	{
		return array(
			'x_data'=>array(
				'data_attr_id'=>$criteria['x_term'],
				'label'=>'x-Axis', 
				'data'=>array()
			), 
			'y_data'=>array(
				'data_attr_id'=>$criteria['y_term'],
				'label'=>'y-Axis',
				'data'=>array()
			),
			'criteria'=>$criteria['criteria'],
			'data'=>$this->get_datapoints(array(
				'datapoint'=>$criteria['datapoint']
			))
		);
	}

	public function has_category($product_category)
	{
		foreach ($this->get_categories() as $category)
		{
			if($category->id===$product_category->id) return true;
		}

		return false;
	}

	public function add_datapoint(array $datapoint)
	{
		$this->load->model('product_datapoints_model', 'product_data');
		return $this->product_data->add_datapoint(array_merge($datapoint, array(
			'product'=>$this->id
		)));
	}

	public function remove_datapoint($datapoint)
	{
		$this->load->model('product_datapoints_model', 'product_data');

		$datapoint=($datapoint instanceof Active_model)? $datapoint : array('id'=>$datapoint);

		$result=array(
			'error'=>false, 
			'message'=>'removed successfully'
		);

		if(($datapoint instanceof Active_model) 
			&& (($datapoint->product instanceof Active_model) && $datapoint->product->id==$this->id))
		{
			$result=$datapoint->remove();
		}
		else
		{
			$datapoints=$this->product_data->get_datapoints(array_merge($datapoint, array(
				'product'=>$this->id
			)));

			foreach ($datapoints as $datapoint)
			{
				$result=$datapoint->remove();
			}
		}

		return $result;
	}

	public function get_datapoints(array $params=array())
	{
		$this->load->model('product_datapoints_model', 'product_data');
		return $this->product_data->get_datapoints(array_merge($params, array(
			'product'=>$this->id
		)));
	}

	public function get_product_datapoint_attrs()
	{
		$categories=$this->get_categories();
		$datapoints=array();

		foreach ($categories as $category)
		{
			$datapoints=array_merge($datapoints, $category->get_datapoints());
		}

		return $datapoints;
	}

	public function add_category($category)
	{
		$this->load->model('product_categories_model', 'categories');

		$category=($category instanceof Active_model) ? $category->id : $category;

		$categories=$this->categories->get_categories(array(
			'category'=>$category,
			'product'=>$this->id
		));

		if(!count($categories))
		{
			return $this->categories->add_category(array(
				'product'=>$this->id,
				'category'=>$category
			));
		}

		return array(
			'error'=>false, 
			'message'=>'added successfully'
		);
	}

	public function remove_category($category)
	{
		$this->load->model('product_categories_model', 'categories');

		$category=($category instanceof Active_model) ? $category->id : $category;

		$categories=$this->categories->get_categories(array(
			'category'=>$category,
			'product'=>$this->id
		));

		$result= array(
			'error'=>false, 
			'message'=>'removed successfully'
		);

		if(count($categories))
		{
			foreach($categories as $category)
			{
			   $result=$category->remove();
			}
		}

		return $result;
	}

	public function get_categories()
	{
		$this->load->model('product_categories_model', 'product_categories');

		$categories_list=array();
		$categories=$this->product_categories->get_categories(array(
			'product'=>$this->id
		));

		foreach ($categories as $category)
		{
			if($category->category instanceof Active_model)
				$categories_list[$category->id]=$category->category;
		}

		return $categories_list;
	}

	public function add_product(array $product)
	{
		return $this->add_one(array_merge($product, array(
			'created'=>time()
		)));
	}

	public function get_products(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->order_by('name', 'ASC')->results();
		return $this->order_by('name', 'ASC')->results();
	}

	public function get_product($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_products($params));
	}
}

<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'category_model.php';
class Categories_model extends Category_model
{
	public function __construct(array $data = array(), $save=false)
	{
		$this->load->model('users_model', 'categories_user');
		parent::__construct($data, $save);
	}

	public function add_category(array $category)
	{
		return $this->add_one(array_merge($category, array(
			'created'=>time()
		)));
	}

	public function add_datapoint(array $datapoint)
	{
		$this->load->model('datapoints_model', 'category_datapoint');
		return $this->category_datapoint->add_datapoint(array_merge($datapoint, array(
			'category'=>$this->id
		)));
	}

	public function update_datapoint($id, array $datapoint)
	{
		$this->load->model('datapoints_model', 'category_datapoint');

		$result=array('error'=>false, 'message'=>''); 

		$results=$this->category_datapoint->get_datapoints(array(
			'category'=>$this->id,
			'id'=>$id
		));

		foreach ($results as $datapoint)
		{
			$result=$datapoint->set_attributes($datapoint)
							  ->update();
		}

		return $result;
	}

	public function remove_datapoint(array $datapoint)
	{
		$this->load->model('datapoints_model', 'category_datapoint');
		
		$result=array('error'=>false, 'message'=>''); 
		$results=$this->category_datapoint->get_datapoints(array_merge($datapoint, array(
			'category'=>$this->id
		)));

		foreach ($results as $datapoint)
		{
			$result=$datapoint->remove();
		}

		return $result;
	}

	public function get_datapoints()
	{
		$this->load->model('datapoints_model', 'category_datapoint');

		return $this->category_datapoint->get_datapoints(array(
			'category'=>$this->id
		));

	}


	public function add_product($product)
	{
		$this->load->model('product_categories_model', 'product_categories');
		$category=array();
		if($product instanceof Active_model)
		{
			$category=array('product'=>$product->id);
		}
		else
		{
			$category=array('product'=>$product);
		}

		$this->product_categories->add_category(array_merge($category, array(
			'category'=>$this->id
		)));

	}

	public function remove_product()
	{
		$this->load->model('product_categories_model', 'product_categories');
		$category=array();
		if($product instanceof Active_model)
		{
			$category=array('product'=>$product->id);
		}
		else
		{
			$category=array('product'=>$product);
		}

		$category=$this->product_categories->get_category(array_merge($category, array(
			'category'=>$this->id
		)));

		return $category->remove();
	}

	public function get_products()
	{
		$this->load->model('product_categories_model', 'product_categories');

		$products=$this->product_categories->get_categories(array(
			'category'=>$this->id
		));

		$user_id=$this->categories_user->current_user('uid');
		$user=$this->categories_user->get_user(($user_id ? $user_id : 0));

		$products_list=$preferred_list=array();

		foreach ($products as $product)
		{
			if($product->product instanceof Active_model)
				$products_list[$product->id]=$product->product;
		}

		if($user 
			&& !$user->current_user('is_admin') 
			   && $user->get_info('setup_done')=='yes')
		{
			$products_preferences=$user->get_info('products_preferences');
			$products_preferences= is_array($preferences=unserialize($products_preferences)) ? $preferences : array();

			foreach ($products_preferences as $key => $prod_id)
			{
				foreach ($products_list as $product)
				{
					if($product->id==$prod_id) $preferred_list[$product->id]=$product;
				}
			}

			if(count($preferred_list)) $products_list=$preferred_list;
		}

		return $products_list;
	}

	public function get_all_products()
	{
		$this->load->model('product_categories_model', 'product_categories');

		$products=$this->product_categories->get_categories(array(
			'category'=>$this->id
		));

		$user_id=$this->categories_user->current_user('uid');
		$user=$this->categories_user->get_user($user_id);

		$products_list=array();

		foreach ($products as $product)
		{
			if($product->product instanceof Active_model)
				$products_list[$product->id]=$product->product;
		}

		return $products_list;
	}

	public function get_categories(array $params=array())
	{
		$user_id=$this->categories_user->current_user('uid');
		$user=$this->categories_user->get_user(($user_id ? $user_id : 0));

		if($user 
			&& !$user->current_user('is_admin') 
			   && $user->get_info('setup_done')=='yes')
		{
			$categories_preferences=$user->get_info('categories_preferences');
			$categories_preferences= is_array($preferences=unserialize($categories_preferences)) ? $preferences : array();

			//var_dump($categories_preferences);exit;

			foreach ($categories_preferences as $key => $cat_id)
			{
				$this->or_where(array('id'=>$cat_id));
			}
		}
		else
		{
			if(!empty($params)) $this->where($params);
		}
		return $this->order_by('name', 'ASC')->results();
	}

	public function get_category($params)
	{
		if(!$params || is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_categories($params));
	}

	public function get_category_with($params)
	{
		if(!$params || is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->where($params)->results());
	}
}

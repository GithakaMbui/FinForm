<?php if(!defined('BASEPATH')) exit("Access Denied");
class Products extends Active_Controller
{
	protected $models=array('users', 'products', 'categories', 'datapoints', 'providers', 'regions');

	public function __construct()
	{
		parent::__construct();
	}

	public function search($id=null, $cat_id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!$this->input->post('usr_submit')) 
				redirect(base_url("dashboard/products/$user->id"));

		$name=$this->input->post('name');
		$products=$this->products->like(array('name'=>$name))->results();
		$this->data['user']=$user;
		$this->data['products']=$products;
		$this->data['type']= (count($products) ? 'success' : 'info');
		$this->data['message']= (($count=count($products)) ? "$count items found": 'No products found with that name');
		$this->send_response($this->data, array('products/page-products-man'));

	}

	public function products($cat_id=null)
	{
		if($this->users->current_user('is_admin')) 
			redirect(base_url("dashboard/products/$id"));

		if(!$category=$this->categories->get_category_with($cat_id)) 
			show_error("Unknown product category");

		$user=$this->users->get_user(array('id'=>$this->users->current_user('uid')));
		$this->data['products']=$category->get_products();
		$this->data['c_category']=$category;
		$this->data['categories']=$this->categories->get_categories();
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->data['user']= $user ? $user : $this->users;
		$this->send_response($this->data, array('products/page-category-products'));

	}

	public function index($id=null, $cat_id=null)
	{
		$this->products($id, $cat_id=null);
	}
}
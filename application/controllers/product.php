<?php if(!defined('BASEPATH')) exit("Access Denied");
class Product extends Active_Controller
{
	protected $models=array('users', 'providers', 'regions', 'products', 'categories', 'datapoints', 'product_datapoints');

	public function __construct()
	{
		parent::__construct();
	}
	

	public function addproductdata($id=null, $pid=null, $did=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error("Unknown user");

		if(!$product=$this->products->get_product($pid)) show_error("Unknown product");

		if(!$datapoint=$this->datapoints->get_datapoint($did)) show_error("Unknown datapoint");
	
		if($this->input->post('usr_submit'))
		{
			$datapoint_details=(is_array($datapoint_details=$this->input->post('datapoint')) ? $datapoint_details : array());
			
			if(array_key_exists('date', $datapoint_details))
			   $datapoint_details['date']= strtotime($datapoint_details['date']);

			$this->data=$product->add_datapoint($datapoint_details);

			if(false===$this->data['error'])
			{
				if(!$user->current_user('is_admin'))
				{
					$user->save_settings(array('points'=>(((int)$user->get_info('points'))+10)));
				}

				$message=$this->data['message'];

				if(!$this->is_ajax_request())
				{
					$redirect_url=base_url("dashboard/product/$id/$pid/$did/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}

			$this->data=array_merge($this->data, $datapoint_details);
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->data['datapoint']=$datapoint;
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->send_response($this->data, array('products/page-add-product-data'));
	}

	public function editproductdata($id=null, $pid=null, $did=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error("Unknown user");

		if(!$product=$this->products->get_product($pid)) show_error("Unknown product");

		if(!$datapoint=$this->product_datapoints->get_datapoint($did)) show_error("Unknown datapoint");
	
		if($this->input->post('usr_submit'))
		{
			$datapoint_details=(is_array($datapoint_details=$this->input->post('datapoint')) ? $datapoint_details : array());
			
			if(array_key_exists('date', $datapoint_details))
			   $datapoint_details['date']= strtotime($datapoint_details['date']);
			
			$this->data=$datapoint->set_attributes($datapoint_details)
								  ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/product/$id/$pid/$did/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $datapoint_details);
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->data['data']=$datapoint;
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->send_response($this->data, array('products/page-edit-product-data'));
	}

	public function removeproductdata($id=null, $did=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error("Unknown user");

		if(!$datapoint=$this->product_datapoints->get_datapoint($did)) show_error("Unknown datapoint");
	
			
		if($user->id!==$datapoint->owner->id && $user->current_user('is_admin'))
			redirect("product/index/$id/");

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$datapoint->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$pid=$datapoint->product->id;
				$redirect_url=base_url("product/index/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $datapoint_details);
		}

		$this->data['user']=$user;
		$this->data['datapoint']=$datapoint;
		$this->send_response($this->data, array('products/page-remove-product-data'));
	}

	public function data($pid=null)
	{
		if(!$product=$this->products->get_product($pid)) show_404("Unknown product");

		if($this->input->post('usr_submit'))
		{
			$provider=$this->input->post('provider');
			$region=$this->input->post('provider');
			$datapoint=$this->input->post('provider');
			$user_id=$this->users->current_user('uid');

			$this->data['data_params']=array(
				'provider'=>$provider,
				'region'=>$region,
				'datapoint'=>$datapoint
			);

			$this->data['user']=($user=$this->users->get_user(($user_id ? $user_id : -5))) ? $user : $this->users;
			$this->data['datapoint']=$this->datapoints->get_datapoint($datapoint);
			$this->data['product']=$product;
			$this->send_response($this->data, array('products/part-product-data-table'));
		}
		else
		{	
			$this->send_response($this->data, array('products/part-product-data-table-404'));
		}
	}

	public function compare($pid=null, $did=null)
	{
		if(!$product=$this->products->get_product($pid)) show_error("Unknown product");

		if(!$datapoint=$this->datapoints->get_datapoint($did)) show_error("Unknown datapoint");
		
		if($this->input->post('usr_submit'))
		{
			$series=$this->providers->get_providers();
			$series_attr='provider';
			$criteria=strtolower($this->input->post('criteria'));
			
			if($criteria==='region')
			{
				$series=$this->regions->get_regions();
				$series_attr='region';
			}

			$this->data['series']=$series;
			$this->data['series_attr']=$criteria;
		}

		$this->data['product']=$product;
		$this->data['datapoint']=$datapoint;
		$this->send_response($this->data, array('products/part-comparison-chart'));
	}

	public function product($id=null, $pid=null)
	{
		if($this->users->current_user('is_admin')) redirect(base_url("dashboard/product/$id/$pid"));
		if(!$product=$this->products->get_product($pid)) show_error("Unknown product");
		$this->data['user']=($user=$this->users->get_user($id)) ? $user : $this->users;
		$this->data['product']=$product;
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->send_response($this->data, array('products/page-product'));
	}

	public function index($id=null, $pid=null)
	{
		$this->product($id, $pid);
	}
}
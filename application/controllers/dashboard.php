<?php if(!defined('BASEPATH')) exit("Access Denied");
/**
 *dashboard
 *
 *Define app controller
 *
 */

/**
 *Dashboard
 *
 *Main dashboard
 *
 *@uses Active/Active_Controller
 */
class Dashboard extends Active_Controller
{
	/**
	 *@var $models, controller autoload models
	 */
	protected $models=array('users', 'categories', 'datapoints', 'products', 'product_categories', 'providers', 'regions', 'industries');

	/**
	 *__construct
	 *
	 *@access public
	 *@return $instance App, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
		$this->pre_action();
	}

	/**
	 *pre_action
	 *Controller pre action hook, codeignitor's is kinda costly
	 *
	 *@access public
	 */
	protected function pre_action()
	{

		if(!$this->users->current_user('is_signed_in'))
		{
			redirect(base_url($this->users->current_user('home_url')));
		}
	}


	/**
	 *addindustry
	 */
	public function addindustry($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$industry=(is_array(($industry=$this->input->post('industry')))) ? $industry : array();
			$this->data=$this->industries->add_industry(array_merge($industry, array(
				'added_by'=>$id
			)));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/industries/$id/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $industry);
		}

		$this->data['user']=$user;
		$this->send_response($this->data, array('industries/page-add-industry'));
	}

	/**
	 *editindustry
	 */
	public function editindustry($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($industry=$this->industries->get_industry($pid))) show_error('Unknown industry');

		if($this->input->post('usr_submit'))
		{
			$industry_details=(is_array(($industry_details=$this->input->post('industry')))) ? $industry_details : array();
			$this->data=$industry->set_attributes($industry_details)
								 ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/industries/$id/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $industry_details);
		}

		$this->data['user']=$user;
		$this->data['industry']=$industry;
		$this->send_response($this->data, array('industries/page-edit-industry'));
	}

	/**
	 *removeindustry
	 */
	public function removeindustry($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($industry=$this->industries->get_industry($pid))) show_error('Unknown industry');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$industry->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/industries/$id/$pid?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['industry']=$industry;
		$this->send_response($this->data, array('industries/page-remove-industry'));
	}

	/**
	 *industries
	 */
	public function industries($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['industries']=$this->industries->get_industries();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('industries/page-industries'));
	}
	
	/**
	 *addprovider
	 */
	public function addprovider($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$provider=(is_array(($provider=$this->input->post('provider')))) ? $provider : array();
			$this->data=$this->providers->add_provider(array_merge($provider, array(
				'added_by'=>$id
			)));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addproviderimage/$id/$pid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $provider);
		}

		$this->data['user']=$user;
		$this->data['industries']=$this->industries->get_industries();
		$this->send_response($this->data, array('providers/page-add-provider'));
	}

	/**
	 *editprovider
	 */
	public function editprovider($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($provider=$this->providers->get_provider($pid))) show_error('Unknown provider');

		if($this->input->post('usr_submit'))
		{
			$provider_details=(is_array(($provider_details=$this->input->post('provider')))) ? $provider_details : array();
			$this->data=$provider->set_attributes($provider_details)
								 ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addproviderimage/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $provider_details);
		}

		$this->data['user']=$user;
		$this->data['provider']=$provider;
		$this->data['industries']=$this->industries->get_industries();
		$this->send_response($this->data, array('providers/page-edit-provider'));
	}

	/**
	 *addproviderimage
	 */
	public function addproviderimage($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($provider=$this->providers->get_provider($pid))) show_error('Unknown provider');

		if($this->input->post('usr_submit'))
		{
			
			$this->upload->initialize(array(
				'upload_path'=>$this->config->item('app-items-pics-upload-path'),
				'allowed_types'=>'gif|png|jpg',
				'encrypt_name'=>true
			));

			if($this->upload->do_upload('item_image'))
			{
				$file=$this->upload->data();
				$provider->image=$file['file_name'];
				$this->data=$provider->update();

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$message=$this->data['message'];
					$redirect_url=base_url("dashboard/provider/$id/$pid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}
			else
			{
				$this->data=array(
					'error'=>true,
					'message'=>$this->upload->display_errors()
				);
			}
		}

		$this->data['user']=$user;
		$this->data['provider']=$provider;
		$this->send_response($this->data, array('providers/page-add-provider-image'));
	}

	/**
	 *removeprovider
	 */
	public function removeprovider($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($provider=$this->providers->get_provider($pid))) show_error('Unknown provider');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$provider->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/providers/$id/$pid?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['provider']=$provider;
		$this->send_response($this->data, array('providers/page-remove-provider'));
	}
	/**
	 *provider
	 */
	public function provider($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($provider=$this->providers->get_provider($pid))) show_error('Unknown provider');

		$this->data['user']=$user;
		$this->data['provider']=$provider;
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('providers/page-provider'));
	}

	/**
	 *providers
	 */
	public function providers($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['industries']=$this->industries->get_industries();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('providers/page-providers'));
	}

	/**
	 *addregion
	 */
	public function addregion($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$region=(is_array(($region=$this->input->post('region')))) ? $region : array();
			$this->data=$this->regions->add_region(array_merge($region, array(
				'added_by'=>$id
			)));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addregionimage/$id/$pid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $region);
		}

		$this->data['user']=$user;
		$this->send_response($this->data, array('regions/page-add-region'));
	}

	/**
	 *editregion
	 */
	public function editregion($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($region=$this->regions->get_region($pid))) show_error('Unknown region');

		if($this->input->post('usr_submit'))
		{
			$region_details=(is_array(($region_details=$this->input->post('region')))) ? $region_details : array();
			$this->data=$region->set_attributes($region_details)
							   ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addregionimage/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $region_details);
		}

		$this->data['user']=$user;
		$this->data['region']=$region;
		$this->send_response($this->data, array('regions/page-edit-region'));
	}

	/**
	 *removeregion
	 */
	public function removeregion($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($region=$this->regions->get_region($pid))) show_error('Unknown region');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$region->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/regions/$id/?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['region']=$region;
		$this->send_response($this->data, array('regions/page-remove-region'));
	}
	/**
	 *addregionimage
	 */
	public function addregionimage($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($region=$this->regions->get_region($pid))) show_error('Unknown region');

		if($this->input->post('usr_submit'))
		{
			
			$this->upload->initialize(array(
				'upload_path'=>$this->config->item('app-items-pics-upload-path'),
				'allowed_types'=>'gif|png|jpg',
				'encrypt_name'=>true
			));

			if($this->upload->do_upload('item_image'))
			{
				$file=$this->upload->data();
				$region->image=$file['file_name'];
				$this->data=$region->update();

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$message=$this->data['message'];
					$redirect_url=base_url("dashboard/region/$id/$pid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}
			else
			{
				$this->data=array(
					'error'=>true,
					'message'=>$this->upload->display_errors()
				);
			}
		}

		$this->data['user']=$user;
		$this->data['region']=$region;
		$this->send_response($this->data, array('regions/page-add-region-image'));
	}

	/**
	 *region
	 */
	public function region($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($region=$this->regions->get_region($pid))) show_error('Unknown region');

		$this->data['user']=$user;
		$this->data['region']=$region;
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('regions/page-region'));
	}

	/**
	 *regions
	 */
	public function regions($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['regions']=$this->regions->get_regions();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('regions/page-regions'));
	}



	/**
	 *addcategory
	 */
	public function addcategory($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$category=(is_array(($category=$this->input->post('category')))) ? $category : array();
			$this->data=$this->categories->add_category(array_merge($category, array(
				'added_by'=>$id
			)));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addcategoryimage/$id/$pid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $category);
		}

		$this->data['user']=$user;
		$this->data['categories']=$this->categories->get_categories();
		$this->send_response($this->data, array('categories/page-add-category'));
	}

	/**
	 *editcategory
	 */
	public function editcategory($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($category=$this->categories->get_category($pid))) show_error('Unknown category');

		if($this->input->post('usr_submit'))
		{
			$category_details=(is_array(($category_details=$this->input->post('category')))) ? $category_details : array();
			$this->data=$category->set_attributes($category_details)
								 ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addcategoryimage/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $category_details);
		}

		$this->data['user']=$user;
		$this->data['category']=$category;
		$this->data['categories']=$this->categories->get_categories();
		$this->send_response($this->data, array('categories/page-edit-category'));
	}

	/**
	 *removecategory
	 */
	public function removecategory($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($category=$this->categories->get_category($pid))) show_error('Unknown category');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$category->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/categories/$id/$pid?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['category']=$category;
		$this->send_response($this->data, array('categories/page-remove-category'));
	}

	/**
	 *addcategoryimage
	 */
	public function addcategoryimage($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($category=$this->categories->get_category($pid))) show_error('Unknown category');

		if($this->input->post('usr_submit'))
		{
			
			$this->upload->initialize(array(
				'upload_path'=>$this->config->item('app-items-pics-upload-path'),
				'allowed_types'=>'gif|png|jpg',
				'encrypt_name'=>true
			));

			if($this->upload->do_upload('item_image'))
			{
				$file=$this->upload->data();
				$category->image=$file['file_name'];
				$this->data=$category->update();

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$message=$this->data['message'];
					$redirect_url=base_url("dashboard/category/$id/$pid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}
			else
			{
				$this->data=array(
					'error'=>true,
					'message'=>$this->upload->display_errors()
				);
			}
		}

		$this->data['user']=$user;
		$this->data['category']=$category;
		$this->send_response($this->data, array('categories/page-add-category-image'));
	}

	/**
	 *category
	 */
	public function category($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($category=$this->categories->get_category($pid))) show_error('Unknown category');

		$this->data['user']=$user;
		$this->data['category']=$category;
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('categories/page-category'));
	}

	/**
	 *categories
	 */
	public function categories($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['categories']=$this->categories->get_categories();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('categories/page-categories'));
	}


	/**
	 *adddatapoint
	 */
	public function adddatapoint($id=null, $cid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($category=$this->categories->get_category($cid))) show_error('Unknown category');

		if($this->input->post('usr_submit'))
		{
			$datapoint=(is_array(($datapoint=$this->input->post('datapoint')))) ? $datapoint : array();
			$this->data=$category->add_datapoint($datapoint);

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/categories/$id/$cid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $datapoint);
		}

		$this->data['user']=$user;
		$this->data['category']=$category;
		$this->send_response($this->data, array('categories/page-add-datapoint'));
	}

	/**
	 *editdatapoint
	 */
	public function editdatapoint($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($datapoint=$this->datapoints->get_datapoint(array('id'=>$pid)))) show_error('Unknown datapoint');

		if($this->input->post('usr_submit'))
		{
			$datapoint_details=(is_array(($datapoint_details=$this->input->post('datapoint')))) ? $datapoint_details : array();
			$this->data=$datapoint->set_attributes($datapoint_details)
								  ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/categories/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $datapoint_details);
		}

		$this->data['user']=$user;
		$this->data['datapoint']=$datapoint;
		$this->send_response($this->data, array('categories/page-edit-datapoint'));
	}

	/**
	 *removedatapoint
	 */
	public function removedatapoint($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($datapoint=$this->datapoints->get_datapoint(array('id'=>$pid)))) show_error('Unknown datapoint');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$datapoint->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$cat_id=$datapoint->category->id;
				$redirect_url=base_url("dashboard/categories/$id/$pid/$cat_id?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['datapoint']=$datapoint;
		$this->send_response($this->data, array('categories/page-remove-datapoint'));
	}

	/**
	 *addproduct
	 */
	public function addproduct($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$product=(is_array(($product=$this->input->post('product')))) ? $product : array();
			$this->data=$this->products->add_product(array_merge($product, array(
				'added_by'=>$id
			)));

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addproductimage/$id/$pid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $product);
		}

		$this->data['user']=$user;
		$this->send_response($this->data, array('products/page-add-product'));
	}

	/**
	 *editproduct
	 */
	public function editproduct($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		if($this->input->post('usr_submit'))
		{
			$product_details=(is_array(($product_details=$this->input->post('product')))) ? $product_details : array();
			$this->data=$product->set_attributes($product_details)
								 ->update();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/addproductimage/$id/$pid/?type=success&msg=$message");
				redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $product_details);
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->send_response($this->data, array('products/page-edit-product'));
	}

	/**
	 *removeproduct
	 */
	public function removeproduct($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$product->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/products/$id/$pid?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->send_response($this->data, array('products/page-remove-product'));
	}

	/**
	 *addproductimage
	 */
	public function addproductimage($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		if($this->input->post('usr_submit'))
		{
			
			$this->upload->initialize(array(
				'upload_path'=>$this->config->item('app-items-pics-upload-path'),
				'allowed_types'=>'gif|png|jpg',
				'encrypt_name'=>true
			));

			if($this->upload->do_upload('item_image'))
			{
				$file=$this->upload->data();
				$product->image=$file['file_name'];
				$this->data=$product->update();

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$message=$this->data['message'];
					$redirect_url=base_url("dashboard/product/$id/$pid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}
			else
			{
				$this->data=array(
					'error'=>true,
					'message'=>$this->upload->display_errors()
				);
			}
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->send_response($this->data, array('products/page-add-product-image'));
	}

	/**
	 *product
	 */
	public function product($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('products/page-product'));
	}

	/**
	 *products
	 */
	public function products($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['products']=$this->products->get_products();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('products/page-products-man'));
	}



	/**
	 *addproducttocategory
	 */
	public function addproducttocategory($id=null, $pid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');
			
		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		if($this->input->post('usr_submit'))
		{
			$category_details=(is_array(($category=$this->input->post('category')))) ? $category : array();
			$this->data=$this->product_categories->add_category($category_details);

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$pid=$this->data['id'];
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/products/$id/$pid/?type=success&msg=$message");
			  	redirect($redirect_url);
			}

			$this->data=array_merge($this->data, $category_details);
		}

		$this->data['user']=$user;
		$this->data['categories']=$this->categories->get_categories();
		$this->data['product']=$product;
		$this->send_response($this->data, array('products/page-add-product-category'));
	}

	/**
	 *removeproductfromcategory
	 */
	public function removeproductfromcategory($id=null, $pid=null, $cid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');
			
		if(!($product=$this->products->get_product($pid))) show_error('Unknown product');

		if(!($category=$this->product_categories->get_category(array(
				'category'=>$cid,
				'product'=>$pid
			)))) show_error('Unknown category');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$category->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/products/$id/?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['product']=$product;
		$this->data['category']=$category->category;
		$this->send_response($this->data, array('products/page-remove-product-category'));
	}



	/**
	 *addaccount
	 */
	public function addaccount($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if($this->input->post('usr_submit'))
		{
			$account=(is_array(($account=$this->input->post('account')))) ? $account : array();
			$account_info=(is_array(($account_info=$this->input->post('account_info')))) ? $account_info : array();
			$this->data=$this->users->add_account($account);

			if(false===$this->data['error'])
			{
				$account=$this->users->get_user($this->data['id']);
				$this->data=$account->save_info($account_info);

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$aid=$account->id; $message=$this->data['message'];
					$redirect_url=base_url("dashboard/addaccountimage/$id/$aid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}

			$this->data=array_merge($account, $account_info);
		}

		$this->data['user']=$user;
		$this->send_response($this->data, array('accounts/page-add-account'));
	}

	/**
	 *editproduct
	 */
	public function editaccount($id=null, $aid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($account=$this->users->get_user($aid))) show_error('Unknown account');

		if($this->input->post('usr_submit'))
		{
			$account_details=(is_array(($account_details=$this->input->post('account')))) ? $account_details : array();
			$account_info=(is_array(($account_info=$this->input->post('account_info')))) ? $account_info : array();
			$this->data=$account->set_attributes($account_details)
								 ->update();

			if(false===$this->data['error'])
			{
				$this->data=$account->save_info($account_info);

				if(false===$this->data['error'] && !$this->is_ajax_request())
				{
					$message=$this->data['message'];
					$redirect_url=base_url("dashboard/addaccountimage/$id/$aid/?type=success&msg=$message");
					redirect($redirect_url);
				}
			}

			$this->data=array_merge($account, $account_info);
		}

		$this->data['user']=$user;
		$this->data['account']=$account;
		$this->send_response($this->data, array('accounts/page-edit-account'));
	}

	/**
	 *removeaccount
	 */
	public function removeaccount($id=null, $aid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($account=$this->users->get_user($aid))) show_error('Unknown account');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$account->remove();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message=$this->data['message'];
				$redirect_url=base_url("dashboard/accounts/$id?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['account']=$account;
		$this->send_response($this->data, array('accounts/page-remove-account'));
	}

	/**
	 *activateaccount
	 */
	public function activateaccount($id=null, $aid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($account=$this->users->get_user($aid))) show_error('Unknown account');

		if($this->input->get_post('usr_ok'))
		{
			$this->data=$account->activate_account();

			if(false===$this->data['error'] && !$this->is_ajax_request())
			{
				$message="Account activated successfully!";
				$redirect_url=base_url("dashboard/accounts/$id?type=success&msg=$message");
				redirect($redirect_url);
			}
		}

		$this->data['user']=$user;
		$this->data['account']=$account;
		$this->send_response($this->data, array('accounts/page-activate-account'));
	}


	/**
	 *product
	 */
	public function account($id=null, $aid=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		if(!($account=$this->users->get_user($aid))) show_error('Unknown account');

		$this->data['user']=$user;
		$this->data['account']=$account;
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('accounts/page-account'));
	}

	/**
	 *accounts
	 */
	public function accounts($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['accounts']=$this->users->get_users();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('accounts/page-accounts'));
	}

	/**
	 *leaderboard
	 */
	public function leaderboard($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');

		$this->data['user']=$user;
		$this->data['accounts']=$this->users->get_leaderboard();
		$this->data['type']=$this->input->get_post('type');
		$this->data['message']=$this->input->get_post('msg');
		$this->send_response($this->data, array('accounts/page-accounts'));
	}

	/**
	 *start
	 *
	 *@access public
	 */
	public function start($id=null)
	{
		if($this->users->current_user('uid')!=$id
			|| !($user=$this->users->get_user($id))) show_error('Unknown user');
		$this->data['accounts']=$this->users->get_users();
		$this->data['products']=$this->products->get_products();
		$this->data['providers']=$this->providers->get_providers();
		$this->data['regions']=$this->regions->get_regions();
		$this->data['categories']=$this->categories->get_categories();
		$this->data['user']=$user;
		$this->send_response($this->data, array('dashboard/page-start'));
	}
	
	/**
	 *index
	 *
	 *@access public
	 */
	public function index($id=null)
	{
		$this->start($id);
	}
}
<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Product_category_model extends Active_Model
{
	public $product;
	public $category;
	public $created;
	protected $model_table = 'product_categories';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'product'=>array(),
			'category'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'product'=>array('model'=>'products', 'type'=>'one-to-one'),
			'category'=>array('model'=>'categories', 'type'=>'one-to-one'),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'product'=>array(),
			'category'=>array(),
			'created'=>array(),
		);
	}
}

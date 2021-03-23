<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Product_datapoints_model extends Active_Model
{
	public $product;
	public $provider;
	public $region;
	public $owner;
	public $datapoint;
	public $value;
	public $date;
	public $created;
	protected $model_table = 'product_info';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'product'=>array(),
			'provider'=>array(),
			'region'=>array(),
			'owner'=>array(),
			'datapoint'=>array(),
			'value'=>array(),
			'date'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'product'=>array('model'=>'products', 'type'=>'one-to-one'),
			'provider'=>array('model'=>'providers', 'type'=>'one-to-one'),
			'region'=>array('model'=>'regions', 'type'=>'one-to-one'),
			'owner'=>array('model'=>'users', 'type'=>'one-to-one'),
			'datapoint'=>array('model'=>'datapoints', 'type'=>'one-to-one'),
			'value'=>array(),
			'date'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'product'=>array(),
			'provider'=>array(),
			'region'=>array(),
			'owner'=>array(),
			'datapoint'=>array(),
			'value'=>array(),
			'date'=>array(),
			'created'=>array(),
		);
	}


	
	public function add_datapoint(array $datapoint)
	{
		return $this->add_one(array_merge($datapoint, array(
			'created'=>time()
		)));
	}

	public function get_datapoints(array $params=array())
	{
		return $this->where($params)->order_by('date', 'ASC')->results();
	}

	public function get_datapoint($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_datapoints($params));
	}
}

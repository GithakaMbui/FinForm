<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Preference_model extends Active_Model
{
	public $product;
	public $provider;
	public $region;
	public $datapoint;
	public $created;
	protected $model_table = 'user_preferences';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'product'=>array(),
			'provider'=>array(),
			'region'=>array(),
			'datapoint'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'product'=>array('model'=>'products', 'type'=>'one-to-one'),
			'provider'=>array('model'=>'providers', 'type'=>'one-to-one'),
			'region'=>array('model'=>'regions', 'type'=>'one-to-one'),
			'datapoint'=>array('model'=>'datapoints', 'type'=>'one-to-one'),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'product'=>array(),
			'provider'=>array(),
			'region'=>array(),
			'datapoint'=>array(),
			'created'=>array(),
		);
	}
}

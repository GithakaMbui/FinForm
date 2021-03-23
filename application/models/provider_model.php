<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Provider_model extends Active_Model
{
	public $name;
	public $country;
	public $industry;
	public $description;
	public $image;
	public $created;
	protected $model_table = 'product_providers';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'name'=>array(),
			'country'=>array(),
			'industry'=>array(),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'name'=>array(),
			'country'=>array(),
			'industry'=>array('model'=>'industries', 'type'=>'one-to-one'),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'name'=>array('required'=>true, 'alphanumeric'=>true),
			'country'=>array('required'=>true, 'alphanumeric'=>true),
			'industry'=>array('required'=>true, 'numeric'=>true),
			'description'=>array(),
			'image'=>array(),
			'created'=>array('required'=>true),
		);
	}
}

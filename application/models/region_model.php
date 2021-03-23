<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Region_model extends Active_Model
{
	public $name;
	public $country;
	public $description;
	public $image;
	public $created;
	protected $model_table = 'product_regions';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'name'=>array(),
			'country'=>array(),
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
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'name'=>array(),
			'country'=>array(),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
}

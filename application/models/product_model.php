<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Product_model extends Active_Model
{
	public $type;
	public $name;
	public $description;
	public $added_by;
	public $image;
	public $created;
	protected $model_table = 'products';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'type'=>array(),
			'name'=>array(),
			'description'=>array(),
			'added_by'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'type'=>array(),
			'name'=>array(),
			'description'=>array(),
			'added_by'=>array('model'=>'users', 'type'=>'one-to-one'),
			'image'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'type'=>array(),
			'name'=>array(),
			'description'=>array(),
			'added_by'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
}

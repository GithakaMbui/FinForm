<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Category_model extends Active_Model
{
	public $name;
	public $image;
	public $order;
	public $parent;
	public $description;
	public $created;
	protected $model_table = 'categories';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'name'=>array(),
			'image'=>array(),
			'order'=>array(),
			'parent'=>array(),
			'description'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'name'=>array(),
			'image'=>array(),
			'order'=>array(),
			'parent'=>array('model'=>'categories', 'type'=>'one-to-one'),
			'description'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'name'=>array(),
			'image'=>array(),
			'order'=>array(),
			'parent'=>array(),
			'description'=>array(),
			'created'=>array(),
		);
	}
}

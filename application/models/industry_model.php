<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Industry_model extends Active_Model
{
	public $name;
	public $description;
	public $image;
	public $created;
	protected $model_table = 'industries';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'name'=>array(),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'name'=>array(),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'name'=>array(),
			'description'=>array(),
			'image'=>array(),
			'created'=>array(),
		);
	}
}

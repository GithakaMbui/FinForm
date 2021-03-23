<?php	if(!defined('BASEPATH')) exit('Access Denied');
class User_setting_model extends Active_Model
{
	public $users;
	public $name;
	public $value;
	public $editable='yes';
	public $created;
	protected $model_table = 'users_info';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'users'=>array(),
			'name'=>array(),
			'value'=>array(),
			'editable'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'users'=>array('model'=>'users', 'type'=>'one-to-one'),
			'name'=>array(),
			'value'=>array(),
			'editable'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'users'=>array(),
			'name'=>array(),
			'value'=>array(),
			'editable'=>array(),
			'created'=>array(),
		);
	}
}

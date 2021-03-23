<?php	if(!defined('BASEPATH')) exit('Access Denied');
class User_model extends Active_Model
{
	public $type;
	public $status;
	public $email;
	public $password;
	public $pic;
	public $firstname;
	public $lastname;
	public $phone;
	public $activation_code;
	public $activation_expiry;
	public $preset_code;
	public $preset_expiry;
	public $last_login;
	public $created;
	protected $model_table = 'users';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'type'=>array(),
			'status'=>array(),
			'email'=>array(),
			'password'=>array(),
			'pic'=>array(),
			'firstname'=>array(),
			'lastname'=>array(),
			'phone'=>array(),
			'activation_code'=>array(),
			'activation_expiry'=>array(),
			'preset_code'=>array(),
			'preset_expiry'=>array(),
			'last_login'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'type'=>array(),
			'status'=>array(),
			'email'=>array(),
			'password'=>array(),
			'pic'=>array(),
			'firstname'=>array(),
			'lastname'=>array(),
			'phone'=>array(),
			'activation_code'=>array(),
			'activation_expiry'=>array(),
			'preset_code'=>array(),
			'preset_expiry'=>array(),
			'last_login'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'type'=>array('required'=>true),
			'status'=>array(),
			'email'=>array('unique'=>true, 'required'=>true, 'email'=>true, ),
			'password'=>array('alphanumeric'=>true),
			'pic'=>array('alphanumeric'=>true),
			'firstname'=>array('alphanumeric'=>true),
			'lastname'=>array('alphanumeric'=>true),
			'phone'=>array('phone'=>array('regex'=>'')),
			'activation_code'=>array(),
			'activation_expiry'=>array(),
			'preset_code'=>array('alphanumeric'=>true),
			'preset_expiry'=>array('date'=>array('regex'=>'')),
			'last_login'=>array('date'=>array('regex'=>'')),
			'created'=>array('required'=>true, 'date'=>array('regex'=>'Y-m-d')),
		);
	}
}

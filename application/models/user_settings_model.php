<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'user_setting_model.php';
class User_settings_model extends User_setting_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function save_setting($user, $name, $value)
	{
		$setting_details=array(
			'users'=>$user,
			'name'=>$name,
			'value'=>$value,
			'created'=>time()
		);

		$setting=array_pop($this->where(array('users'=>$user, 'name'=>$name))->results());
		
		if(!$setting)
		{
			return $this->add_one($setting_details);
		}
		else
		{
			return $setting->set_attributes($setting_details)
					 	   ->update();
		}
	}

	public function save_settings(array $settings, $user)
	{	
		$results=array();

		foreach ($settings as $name => $value)
		{
			$result = $this->save_setting($user, $name, $value);
		}

		return $result;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_value()
	{
		return $this->value;
	}
}

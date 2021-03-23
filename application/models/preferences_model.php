<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'preference_model.php';
class Preferences_model extends Preference_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function add_preference(array $preference)
	{
		return $this->add_one(array_merge($preference, array(
			'created'=>time()
		)));
	}

	public function get_preferences(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->results();
		return $this->results();
	}

	public function get_preference($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);

		return array_pop($this->get_preferences($params));
	}
}

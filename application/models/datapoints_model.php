<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Datapoints_model extends Active_Model
{
	public $category;
	public $name;
	public $type;
	public $units;
	public $created;
	protected $model_table = 'categories_info';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'category'=>array(),
			'name'=>array(),
			'type'=>array(),
			'units'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'category'=>array(),
			'name'=>array(),
			'type'=>array(),
			'units'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'category'=>array(),
			'name'=>array(),
			'type'=>array(),
			'units'=>array(),
			'created'=>array(),
		);
	}


	public function add_datapoint(array $info)
	{
		return $this->add_one(array_merge($info, array(
			'created'=>time()
		)));
	}

	public function get_datapoints(array $params)
	{
		return $this->where($params)->order_by('created', 'DESC')->results();
	}

	public function get_datapoint($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);
		return array_pop($this->get_datapoints($params));
	}
}

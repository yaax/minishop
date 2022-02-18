<?php

namespace AttributeModel;

class AttributeModel
{
	private $id=null;
	private $name="";
	private $value="";

	public function __construct($array)
	{
		$this->value = reset($array);
		$this->name = key($array);
	}

	public static function insert($product_id,$input) {
		$result = "";
		$db = \MysqliDb::getInstance();

		if (!empty($input['attr_names']) && !empty($input['attr_values'])) {
			if (!is_array($input['attr_names'])) {
				$input['attr_names']=[$input['attr_names']];
			}
			if (!is_array($input['attr_values'])) {
				$input['attr_values']=[$input['attr_values']];
			}
			if (count($input['attr_names'])!=count($input['attr_values'])) {
				$result = "invalid product attributes data! ";
			} else {
				$insert=[];
				$attributes = array_combine($input['attr_names'],$input['attr_values']);
				foreach ($attributes as $name=>$value) {
					$name = trim($name);
					$value = trim($value);
					if (empty($name)) {
						continue;
					}
					$insert[]=[
						"name"=>$db->escape($name),
						"value"=>$db->escape($value),
						"product_id"=>$product_id
					];
				}
				if (!empty($insert)) {
					$attr_count = $db->insertMulti('attributes', $insert);
					if(empty($attr_count)) {
						echo 'attributes insert failed: ' . $db->getLastError();
						$result=0;
					} else {
						$result=count($attr_count);
					}
				}
			}
		}

		return $result;
	}

	/**
	 * @return null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param null $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}
}
<?php
namespace ProductModel;

use AttributeModel\AttributeModel;

class ProductModel
{
	const imagePlaceholder="https://picsum.photos/300/207";
	const bannerPlaceholder="https://picsum.photos/600/300";

	private $id=null;

	private $title="";
	private $price=0;
	private $description="";
	private $image_url=self::imagePlaceholder;
	private $sale=0;
	private $sale_price=0;
	private $banner=self::bannerPlaceholder;

	private $attributes=[];

	public function __construct()
	{
		//$this->db=\MysqliDb::getInstance();
	}

	static public function getAll() {
		$sql=<<<SQL
		select p.*,concat('[',GROUP_CONCAT(concat('{"',a.name,'":"',a.value,'"}')),']') attributes
		from products p
		left join attributes a on p.id=a.product_id
		group by p.id
		order by p.id,a.id 
SQL;

		$products = \MysqliDb::getInstance()->rawQuery($sql);
		$result=[];
		foreach ($products as $product) {
			$new_product = new ProductModel();
			foreach ($product as $key=>$value) {
				$setter = "set".str_replace('_', '', ucwords($key, '_'));
				$new_product->$setter($value);
			}
			$result[]=$new_product;
		}
		unset($new_product); //free memory

		return $result;
	}

	static public function validateProduct($input) {
		$error="";
		$result=true;
		if (empty($input['title']) || !preg_match("/[a-z0-9\s\.\"\_\-']+/i",$input['title'])) {
			$error .= " invalid product title! ";
			$result=false;
		}
		if (empty($input['price']) || !is_numeric($input['price'])) {
			$error .= " invalid product price! ";
			$result=false;
		}
		if (empty($input['description'])) {
			$error .= " invalid description! ";
			$result=false;
		}
		if (empty($input['image_url']) || filter_var($input['image_url'], FILTER_VALIDATE_URL) === FALSE ) {
			$error .= " invalid image url! ";
			$result=false;
		}
		if (empty($input['sale'])) {
			$error .= " invalid sale! ";
			$result=false;
		}
		if (empty($input['banner_url']) || filter_var($input['banner_url'], FILTER_VALIDATE_URL) === FALSE ) {
			$error .= " invalid banner url ";
			$result=false;
		}
		if (empty($input['sale_price']) || !is_numeric($input['sale_price']) ) {
			$error .= " invalid sale price! ";
			$result=false;
		}
		if (!empty($input['attr_names']) && !empty($input['attr_values']) ) {
			$count_names = count(array_filter(array_map('trim', $input['attr_names'])));
			$count_values = count($input['attr_values']);

			if ($count_names!=$count_values) {
				$error .= " attribute names are invalid and not match values! ";
				$result=false;
			}

		}
		return ["result"=>$result,"error"=>$error];
	}

	static public function Add($input) {
		$result = "";
		if (!self::validateProduct($input)) {
			$result = "invalid product data!";
		} else {
			$db = \MysqliDb::getInstance();
			$data = [
				"title" => $db->escape($input['title']),
				"price" => $input['price'],
				"description" => $db->escape($input['description']),
				"image_url" => $db->escape($input['image_url']),
				"banner_url" => $db->escape($input['banner_url']),
				"sale" => empty($input['sale'])?0:1,
				"sale_price" => $input['sale_price'],
			];
			$inserted = $db->insert ('products', $data);
			$id = false;
			if ($inserted) {
				$id = $db->getInsertId();
			}

			if($id) {
				$attr_count = AttributeModel::insert($id,$input);

				$result .= " product {$input['title']} was created. With $attr_count attributes";
			}
		}

		return $result;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * @param mixed $image_url
	 */
	public function setImageUrl($image_url)
	{
		$this->image_url = $image_url;
	}

	/**
	 * @param mixed $sale
	 */
	public function setSale($sale)
	{
		$this->sale = $sale;
	}

	/**
	 * @param mixed $sale_price
	 */
	public function setSalePrice($sale_price)
	{
		$this->sale_price = $sale_price;
	}

	/**
	 * @param mixed $banner
	 */
	public function setBannerUrl($banner)
	{
		$this->banner = $banner;
	}

	/**
	 * @param mixed $attributes
	 */
	public function setAttributes($attributes)
	{
		$new_json=[];
		if (is_string($attributes)) {
			$new_json = json_decode($attributes,true);
		}
		if (!empty($new_json)) {
			foreach ($new_json as $attribute) {
				$new_attribute = new AttributeModel($attribute);
				$this->attributes[] = $new_attribute;
			}
		} else {
			$this->attributes = $attributes;
		}
	}

	/**
	 * @return mixed
	 */
	public function getDb()
	{
		return $this->db;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @return mixed
	 */
	public function getImageUrl()
	{
		if (empty($this->image_url)) {
			return self::imagePlaceholder;
		}
		return $this->image_url;
	}

	/**
	 * @return mixed
	 */
	public function getSale()
	{
		return $this->sale;
	}

	/**
	 * @return mixed
	 */
	public function getSalePrice()
	{
		return $this->sale_price;
	}

	/**
	 * @return mixed
	 */
	public function getBannerUrl()
	{
		return $this->banner;
	}

	/**
	 * @return mixed
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}
}
<?php

/**
* Корзина продуктов
*/
class Basket 
{
	/**	 
	 * Массив продуктов
	 * @var array
	 */
	private $_products;	

	/**
	 * Конструктор	 
	 */
	function __construct()
	{
		$this->_products = array();
		$this->_discounts = array();
	}	

	/**
	 * Добавляет продукт в корзину
	 * 
	 * @param Product $product
	 * @return void
	 */
	public function addProduct(Product $product)
	{
		$this->_products[] = $product;
	}

	/**
	 * Возвращает массив продуктов
	 * 
	 * @return array
	 */
	public function getProducts()
	{
		return $this->_products;
	}

	/**
	 * Возвращает массив продуктов с указанным кодом продукта
	 * 
	 * @param string $code код продукта
	 * @return array
	 */
	public function getByCode($code)
	{
		$result = array();

		foreach ($this->_products as $key => $product) {

			if ($product->getCode() == $code) {
				$result[] = $product;
			}
		}

		return $result;
	}

	/**
	 * Проверяет, есть ли в массиве продуктов продукт с заданными кодами
	 * 
	 * @param array $codes массив кодов продуктов
	 * @return bool
	 */
	public function productsExist($codes)
	{
		foreach ($codes as $code) {
			foreach ($this->_products as $product) {
				if ($product->getCode() == $code) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Возвращает массив наборов продуктов с указанными кодами
	 * 
	 * @param array $codes коды продуктов набора
	 * @return array
	 */
	public function getProductSets($codes)
	{
		$sets = array();
		
		foreach ($codes as $key => $code) {
			$search[$code] = $this->getByCode($code);
		}

		$setsCount = count($this->_products);

		foreach ($search as $code => $products) {
			$setsCount = min($setsCount, count($products));
		}

		
		for ($i=0; $i < $setsCount; $i++) { 
			$set = array();
			foreach ($codes as $code) {
				$set[] = $search[$code][$i]; 
			}		
			$sets[] = $set;
		}
		
		return $sets;
	}

	/**
	 * Возвращает ассоциативный массив, в котором в качестве ключа находится код продукта,
	 * а вкачестве значения - массив продуктов с этим кодом
	 * 
	 * @return array
	 */
	public function getProductsList()
	{
		$list = array();

		foreach ($this->_products as $product) {
			$code = $product->getCode();
			if (isset($list[$code])) {
				continue;
			}
			
			$list[$code] = $this->getByCode($code);
		}

		return $list;
	}
}
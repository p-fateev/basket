<?php

/**
* Продукт
*/
class Product 
{
	/**
	 * Код продукта
	 * $var string
	 */
	private $_code;
	
	/**
	 * Цена продукта
	 * $var float
	 */
	private $_price;
	
	/**
	 * Массив скидок, в качестве ключа содержит код скидки,
	 * а в качестве значения - размер скидки в процентах
	 * $var array
	 */
	private $_discounts;
	
	/**
	 * Максимально допустимое количество скидок для продукта
	 * $var integer
	 */
	private $_discountLimit;

	/**
	 * Конструктор
	 * 
	 * @param string $code	 
	 * @param float $price 
	 * @param integer $discountLimit
	 */
	function __construct($code, $price, $discountLimit = 1)
	{
		$this->_code = strtoupper($code);
		$this->_price = $price;
		$this->_discountLimit = $discountLimit;
		$this->_discounts = array();
	}	

	/**
	 * Преобразование в строку
	 * 	 
	 * @return string
	 */
	public function __toString()
	{		
		return $this->_code . ' [' . $this->_price . '; ' . str_replace('Array', '', print_r($this->_discounts, true)) . ']';
	}

	/**
	 * Возвращает код продукта
	 * 	 
	 * @return string
	 */
	public function getCode()
	{
		return $this->_code;
	}

	/**
	 * Добавляет скидку, если это возможно
	 * 
	 * @param string $code
	 * @param float $volume
	 * @return bool
	 */
	public function addDiscount($code, $volume)
	{
		if (count($this->_discounts) >= $this->_discountLimit) {
			return false;
		}

		$this->_discounts[$code] = $volume;
		return true;
	}

	/**
	 * Возвращает массив скидок
	 * 	 
	 * @return array
	 */
	public function getDiscounts()
	{
		return $this->_discounts;
	}

	/**
	 * Возвращает цену продукта
	 * 	 
	 * @return float
	 */
	public function getPrice()
	{
		return $this->_price;
	}

	/**
	 * Возвращает суммарный размер скидки
	 * 	 
	 * @return float
	 */
	public function getDiscountValue()
	{
		$totalVolume = array_sum($this->_discounts);
		return round($this->_price * $totalVolume / 100, 2);
	}

}
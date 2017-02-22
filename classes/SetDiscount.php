<?php

/**
* Класс, который формирует скидки для наборов продуктов
*/
class SetDiscount implements DiscountInterface {
	/**	 
	 * Массив кодов продуктов, которые образуют набор	 
	 * @var array
	 */
	private $_codes;
	
	/**	 
	 * Размер скидки для набора	 
	 * @var float
	 */
	private $_volume;

	/**
	 * Конструктор	 
	 * 
	 * @param array $codes
	 * @param float $volume
	 */
	function __construct($codes, $volume) {
		$this->_codes = $codes;
		$this->_volume = $volume;
	}

	/**
	 * Формирует скидки для продуктов корзины, которые входят в наборы	  
	 * 
	 * @param Basket &$basket
	 * @return void
	 */
	public function apply(Basket &$basket) {
		$sets = $basket->getProductSets($this->_codes);

		foreach ($sets as $set) {
			foreach ($set as $code => $product) {
				$product->addDiscount('Set ' . implode('', $this->_codes), $this->_volume/count($set));
			}
		}
	}


}
<?php

/**
* Менеджер скидок
*/
class DiscountManager {
	
	/**	 
	 * Массив формирователей скидок
	 * @var array
	 */
	private $_discounts;

	/**
	 * Конструктор	 
	 */
	function __construct() {
		$discounts =array()	;
	}	

	/**
	 * Добавляет формирователя скидок 
	 * 
	 * @param DiscountInterface $discount
	 * @return void
	 */
	public function addDiscount(DiscountInterface $discount) {
		$this->_discounts[] = $discount;
	}

	/**
	 * Устанавливает скидки для продуктов корзины 
	 * 
	 * @param Basket &$basket
	 * @return void
	 */
	public function setDiscounts(Basket &$basket) {
		foreach ($this->_discounts as $key => $discount) {
			$discount->apply($basket);
		}
	}	
}
<?php

/**
* Инвойс
*/
class Invoice {

	/**
	 * Ссылка на корзину продуктов
	 * @var
	 */
	private $_basket;

	/**
	 * Ссылка на менеджер скидок
	 * @var
	 */
	private $_discountManager;

	/**
	 * Суммарная стоимость продуктов корзины
	 * @var
	 */
	private $_totalPrice;

	/**
	 * Суммарная скидка продуктов корзины 
	 * @var
	 */
	private $_totalDiscount;

	/**
	 * Конструктор
	 * 
	 * @param Basket &$basket	 
	 * @param DiscountManager &$discountManager 	 
	 */
	function __construct(&$basket, &$discountManager) {
		$this->_basket = $basket;
		$this->_discountManager = $discountManager;		
	}

	/**
	 * Возвращает ссылку на корзину продуктов
	 * 	 
	 * @return Basket
	 */
	public function getBasket() {
		return $this->_basket;
	}

	/**
	 * Пересчитывает данные инвойса
	 * 	 
	 * @return void
	 */
	public function calculate() {
		$this->_totalPrice = 0;
		$this->_totalDiscount = 0;

		$products = $this->_basket->getProducts();

		foreach ($products as $product) {
			$this->_totalPrice += $product->getPrice();
			$this->_totalDiscount += $product->getDiscountValue();
		}
	}

	/**
	 * Возвращает суммарную стоимость продуктов без скидок
	 * 	 
	 * @return float
	 */
	public function getTotalPrice() {
		return $this->_totalPrice;		
	}

	/**
	 * Возвращает суммарный размер скидок по всем продуктам
	 * 	 
	 * @return float
	 */
	public function getTotalDiscount() {
		return $this->_totalDiscount;		
	}

	/**
	 * Возвращает суммарную стоимость продуктов с учетом скидок
	 * 	 
	 * @return float
	 */
	public function getTotalCharge() {
		return $this->_totalPrice - $this->_totalDiscount;		
	}

}
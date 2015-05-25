<?php

/**
* Класс, который формирует скидки для продуктов, 
* которые покупаются одновременно с другими продуктами
*/
class RefDiscount implements DiscountInterface
{
	/**	 
	 * Код продукта, для которого формируется скидка	 
	 * @var string
	 */
	private $_code;
	
	/**	 
	 * Массив кодов связанных продуктов	 
	 * @var array
	 */
	private $_refCodes;
	
	/**	 
	 * Размер скидки 
	 * @var float
	 */
	private $_volume;

	/**
	 * Конструктор	 
	 * 
	 * @param string $code
	 * @param array $refCodes
	 * @param float $volume
	 */
	function __construct($code, $refCodes, $volume)
	{
		$this->_code = $code;
		$this->_refCodes = $refCodes;
		$this->_volume = $volume;
	}

	/**
	 * Формирует скидки для продуктов корзины, которые 
	 * покупаются одновременно с другими продуктами
	 * 
	 * @param Basket &$basket
	 * @return void
	 */
	public function apply(Basket &$basket)
	{
		$products = $basket->getByCode($this->_code);
		$refExist = $basket->productsExist($this->_refCodes);

		foreach ($products as $product) {
			$product->addDiscount('Ref ' . $this->_code . '+' . implode('', $this->_refCodes), $this->_volume);
		}
	}
}
<?php

/**
* Интерфейс формирователя скидок
*/
interface DiscountInterface
{		
	/**
	 * Согласно заданным условиям формирует скидки для товаров
	 * 
	 * @param Basket &$basket ссылка на корзину продуктов
	 * @return void
	 */
	public function apply(Basket &$basket);
}
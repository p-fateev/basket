<?php

/**
* Класс для отображения инвойса в текстовом формате
*/
class TxtInvoiceView extends InvoiceViewAbstract
{
	/**
	 * Выводит на экран инвойс
	 * 
	 * @return void
	 */
	public function render()
	{
		$products = $this->_invoice->getBasket()->getProducts();

		/* проходим по всем продуктам */
		foreach ($products as $product) {
			echo $product, ' ', $product->getPrice(), ' / ', $product->getDiscountValue(), '<br />';
		}

		echo str_repeat('_', 30), '<br />';

		/* итог */
		echo 'Total: ', $this->_invoice->getTotalPrice(), 
			' / ', $this->_invoice->getTotalDiscount() , 
			' / ', $this->_invoice->getTotalCharge();
	}
}
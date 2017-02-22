<?php

/**
* Класс для отображения инвойса в формате HTML
*/
class HtmlInvoiceView extends InvoiceViewAbstract {
    
    /**
     * Выводит на экран инвойс в виде таблицы
     * 
     * @return void
     */
    public function render() {
        $products = $this->_invoice->getBasket()->getProducts();

        echo '<table border="1" align="center">';
        echo '<tr><th>Code</th><th>Price</th><th colspan="2">Discount</th><th>Amount</th></tr>';

        /* проходим по всем продуктам */
        foreach ($products as $product) {
            $productPrice = $product->getPrice();
            $productDiscount = $product->getDiscountValue();
            echo '<tr><td>', $product->getCode(), '</td><td>', $productPrice, '</td><td>', 
            implode(', ', array_keys($product->getDiscounts())), '</td><td>', $productDiscount, 
            '</td><td>', $productPrice - $productDiscount, '</td></tr>';
        }        

        /* итог */
        echo '<tr><td>Total:</td><td>', $this->_invoice->getTotalPrice(), 
        '</td><td></td><td>', $this->_invoice->getTotalDiscount() , 
        '</td><td>', $this->_invoice->getTotalCharge(), '</td></tr>';

        echo '</table>';
    }
}
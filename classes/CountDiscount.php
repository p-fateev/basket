<?php

/**
* Класс, который формирует скидки для товаров в зависимости от их количества в корзине 
*/
class CountDiscount implements DiscountInterface {

    /**     
     * Массив, содержащий схему формирования скидки:
     * в качестве ключа содержится количество продуктов в корзине, необходимое для скидки,
     * а в качестве значения - размер скидки в процентах
     * @var array
     */
    private $_volumes;

    /**     
     * Массив кодов продуктов, к которым данный тип скидок не применяется     
     * @var array
     */
    private $_unallowed;
        
    /**
     * Конструктор     
     * 
     * @param array $volumes
     * @param array $unallowed
     */
    function __construct($volumes, $unallowed = array()) {
        ksort($volumes);
        $this->_volumes = $volumes;
        $this->_unallowed = $unallowed;
    }

    /**
     * Формирует скидки для продуктов корзины 
     * 
     * @param Basket &$basket
     * @return void
     */
    public function apply(Basket &$basket) {
        $list = $basket->getProductsList();
        
        /* получаем максимальное количество продуктов, для которых применяется скидка */
        end($this->_volumes);
        $maxCount = key($this->_volumes);        

        foreach ($list as $code => $products) {

            if (array_search($code, $this->_unallowed) !== FALSE) {
                continue;
            }

            /* если количество товаров больше, чем максимально установленное правилами, 
                применяем скидку для максимально установленного количества    */
            if (count($products) > $maxCount) {
                foreach ($products as $product) {                    
                    $product->addDiscount('Count >' . $maxCount, $this->_volumes[$maxCount] / count($products));
                }
                continue;
            }

            foreach ($this->_volumes as $count => $volume) {
                if (count($products) == $count) {
                    foreach ($products as $product) {
                        $product->addDiscount('Count ' . $count, $volume / count($products));
                    }
                } 
            }            
        }
    }
}
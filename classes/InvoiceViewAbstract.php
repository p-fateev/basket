<?php

/**
* Абстрактный класс для отображения инвойса
*/
abstract class InvoiceViewAbstract {
    
    /**
     * Объект инвойса
     * @var    Invoice 
     */
    protected $_invoice;    

    /**
     * Конструктор
     * 
     * @param Invoice &$invoice
     */
    public function __construct(Invoice &$invoice) {
        $this->_invoice = $invoice;
    }

    /**
     * 
     * Отображает содержимое инвойса пользователю
     */
    abstract public function render();
}
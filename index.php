<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Basket</title>
</head>
<body>
<?php
	
	/* инициализируем автозагрузку классов */
	spl_autoload_register(function ($className) {        
        require_once 'classes' . DIRECTORY_SEPARATOR . $className . '.php';        
    });

	/* создаем корзину и добавляем в нее товары */
	$basket = new Basket();
	$basket->addProduct(new Product('A', 10));
	$basket->addProduct(new Product('B', 20));
	$basket->addProduct(new Product('C', 30));
	$basket->addProduct(new Product('C', 30));
	$basket->addProduct(new Product('C', 30));
	$basket->addProduct(new Product('D', 40));
	$basket->addProduct(new Product('E', 50));
	$basket->addProduct(new Product('F', 60));
	$basket->addProduct(new Product('G', 70));
	$basket->addProduct(new Product('I', 80));
	$basket->addProduct(new Product('I', 80));
	$basket->addProduct(new Product('I', 80));
	$basket->addProduct(new Product('I', 80));	
	$basket->addProduct(new Product('J', 90));
	$basket->addProduct(new Product('K', 100));
	$basket->addProduct(new Product('A', 10));	

	/* создаем менеджер скидок и добавляем в него применяемые скидки */
	$discountManager = new DiscountManager();
	$discountManager->addDiscount(new SetDiscount(array('A', 'B'), 10));
	$discountManager->addDiscount(new SetDiscount(array('D', 'E'), 5));
	$discountManager->addDiscount(new SetDiscount(array('E', 'F', 'G'), 5));
	$discountManager->addDiscount(new RefDiscount('A', array('K', 'L', 'M'), 5));
	$discountManager->addDiscount(new CountDiscount(array(3 => 5, 4 => 10, 5 => 20), array('A', 'C')));
	$discountManager->setDiscounts($basket);

	/* создаем инвойс на основании корзины и менеджера скидок и пересчитываем данные */
	$invoice = new Invoice($basket, $discountManager);
	$invoice->calculate();
	
	/* создаем представление для просмотра инвойса и просматриваем */
	$view = new HtmlInvoiceView($invoice);
	$view->render();	

?>
</body>
</html>
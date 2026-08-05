<?php
declare(strict_types=1);

function ob_include() : string
{
    extract(func_get_arg(1));
    ob_start();
    require(func_get_arg(0));
    return ob_get_clean();
}

$product_0= [
    'name' => 'L\'Oreal Шампунь для плотности длинных волос, 500 мл',
    'price' => '700', //7.00 руб
    'desc' => 'Шампунь разработан специально для тех, кто мечтает о красивых 
    и длинных волосах.'
];

$product_1 = [
    'name' => 'INSIGHT Шампунь для сухих волос, 350 мл',
    'price' => '1000',// 10.00 руб
    'desc' => 'Шампунь с питательными свойствами, гарантирует глубокое восстановление
    волосяного волокна, укрепляет волосы и улучшает общее состояние и здоровье волос.'
];
// Создаем общий массив для всех товаров
$products = [
    0 => $product_0,
    1 => $product_1
];

// Проверяем передан ли ID в запросе и являеться ли целым числом
if (isset($_GET['id']) && ($id = filter_var($_GET['id'], FILTER_VALIDATE_INT) !== false )) {  

// Сохраняем переданное ID в переменную $id
    $id = $_GET['id'];  

// Проверяем, входит ли ID в диапазон существующих товаров: если да,выводи товар
    if (0 <= $id && $id < count($products)) {
        $html_1 = ob_include('product.phtml', ['p' => $products[$id]]);
// Если ID не входит в диапазон существующих товаров: выводим 'Товар не найден'
    } else {
        $html_1 = 'Товар не найден';
    }
// Если ID вообще не передан, выводим кликабельный список всех товаров
} elseif (!isset($_GET['id'])) {
// Создаем переменную, в которую цикл будет складывать ссылки на товары
    $html_1 = '';
    foreach ($products as $key => $value) {
        $html_1 .= "<a href='index.php?id=$key'>$value[name]</a><br>";
    }                           
}
echo ob_include('layout.phtml', ['content' => $html_1]);
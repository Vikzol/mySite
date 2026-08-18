<?php
declare(strict_types=1);

function ob_include(): string
{
    extract(func_get_arg(1));
    ob_start();
    require(func_get_arg(0));
    return ob_get_clean();
}

// Создаем функцию product, которая выводит конкретный товар из базы данных, выбранный пользователем
function product($id, $products): string
{
    return ob_include('product.phtml', ['p' => $products[$id]]);
}

// Создаем функцию catalog, которая выводит список всех товаров из базы данных
function catalog($products): string
{
    ob_start();
    require 'catalog.phtml';
    return ob_get_clean();
}

// Подключаем базу данных из файла database.php
require_once 'database.php';

// Сохраняем переданное ID в переменную $id
$id = $_GET['id'] ?? null;

// Если ID не равен null, проверяем наличие товара в базе данных
if ($id !== null) {
    
    // Если товар существует в базе данных, выводим его
    if (isset($products[$id])) {
        $html_1 = product($id, $products);
    
    // Если товара нет в базе каталога
    } else {
        $html_1 = 'Товар не найден';
    }

// Если ID не был передан, выводим всю базу данных
} else {
    $html_1 = catalog($products);
}  
echo ob_include('layout.phtml', ['content' => $html_1]);
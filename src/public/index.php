<?php
declare(strict_types=1);

function ob_include() : string
{
    extract(func_get_arg(1));
    ob_start();
    require(func_get_arg(0));
    return ob_get_clean();
}
$product_1= [
    'name' => 'L\'Oreal Шампунь для плотности длинных волос, 500 мл',
    'price' => '700', //7.00 руб
    'desc' => 'Шампунь разработан специально для тех, кто мечтает о красивых 
    и длинных волосах.'
];
$html_1 = ob_include('product.phtml', ['p' => $product_1]);
echo ob_include('layout.phtml', ['content' => $html_1]);
<?php

function rupiah_format($number) {
    return number_format($number, 0, ',' , '.');
}

function discount_price($price, $discount) {
    return  $price_discount = $price - ($price *($discount / 100));
}

<?php

function rupiah_format($number) {
    return number_format($number, 0, ',' , '.');
}

function discount_price($price, $discount) {
    $price_discount = $price - ($price *($discount / 100));
    return rupiah_format($price_discount);
}

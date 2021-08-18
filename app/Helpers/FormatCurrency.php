<?php

function rupiah_format($number) {
    return number_format($number, 0, ',' , '.');
}

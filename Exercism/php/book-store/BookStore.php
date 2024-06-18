<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

function total(array $items): float
{
    $length = count($items);

    if ($length <= 1) {
        $result = 8 * $length;
    } else {
        $result = discounter($items, $length);
    }

    return $result;
}


function discounter(array $items, int $length): float
{
    //storing sets of books - new arrays


    // Find out how many unique books
    $unique = array_unique($items);

    $uniqueLength = count($unique);

    if ($uniqueLength > 3) {
        $discount = 0.05 * ($uniqueLength);
    }
    else {
        $discount = 0.05 * ($uniqueLength-1);
    }

    $discountedAmount = ($length * 8) * (1 - $discount);

    // if($uniqueLength == $length){
    //         if($uniqueLength === 2){
    //             $discountedAmount = (($length - $uniqueLength) * 8) + (0.95 * ($uniqueLength * 8));
    //         }

    //             //if 3

    //     } else {
    //     return 16;
    // }


    return $discountedAmount;
}
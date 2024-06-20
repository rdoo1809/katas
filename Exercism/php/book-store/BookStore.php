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

    if ($length > 10) {
        return priceForThreeBundles($items);
    }

    if ($length <= 1) {
        $result = 8 * $length;
    } else {
        $result = priceForOneOrTwoBundles($items, $length);
    }

    //
    return $result;
}

function priceForThreeBundles(array $items): float
{
    [$unique, $everythingElse] = splitArray($items);
    [$anotherUnique, $remainder] = splitArray($everythingElse);

    $discountedAmount = 0;
    $discountedAmount += discounter($unique);
    $discountedAmount += discounter($anotherUnique);
    $discountedAmount += discounter($remainder);

    return $discountedAmount;
}

function splitArray(array $items): array {
    $unique = [];
    $duplicates = [];
    foreach ($items as $item) {
        // is the item already in unique?
        if (in_array($item, $unique)) {
            // if so, put in $duplicate
            $duplicates[] = $item;
        } else {
            $unique[] = $item;
        }
    }

    return [$unique, $duplicates];
}


function priceForOneOrTwoBundles(array $items, int $length): float
{
    [$unique, $duplicates] = splitArray($items);
    if (count($unique) === 5 && count($duplicates) === 3) // count($unique) != count($duplicates)) {
        //only balance if needed
    {
        $balancedArrays = balancer($unique, $duplicates);
        $unique = $balancedArrays['unique'];
        $duplicates = $balancedArrays['duplicates'];
    }


    $discountedAmount = 0;

    $discountedAmount += discounter($unique);
    var_dump($discountedAmount);
    $discountedAmount += discounter($duplicates);
    var_dump('after 2', $discountedAmount);


    return $discountedAmount;
}

function discounter(array $items): float
{
    var_dump($items);
    $result = 0;
    $length = count($items);

    if ($length === 5) {
        return (8 * 0.75) * 5;
    }

    if ($length === 4) {
        return (8 * 0.80) * 4;
    }

    if ($length === 3) {
        return (8 * 0.90) * 3;
    }

    if ($length === 2) {
        return (8 * 0.95) * 2;
    }

    if ($length <= 1) {
        $result = 8 * $length;
    }

    return $result;
}

function balancer ($unique, $duplicates){

    foreach($unique as $u) {
        if (!in_array($u, $duplicates) && count($unique) !== count($duplicates)) {
            // take u out of $unique
            // put u into $duplciates;
            array_splice($unique, $u, 1);
            var_dump('unique', $unique);
            array_push($duplicates, $u);
        }
    }

    return [
        'unique' => $unique,
        'duplicates' => $duplicates,
    ];
}


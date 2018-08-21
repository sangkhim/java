<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @SWG\Definition(type="object")
 *
 */
class Product extends Model
{
    /**
     * @SWG\Property(format="string")
     * @var string
     */
    private $name;
    /**
     * @SWG\Property(format="double")
     * @var double
     */
    private $cost;
    /**
     * @SWG\Property(format="double")
     * @var double
     */
    private $price;
}

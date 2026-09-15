<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'price', 'stock', 'image'])]
class Product extends Model
{

}

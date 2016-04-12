<?php
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent {
    
     protected $collection = 'items';
    
     
}
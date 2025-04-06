<?php

namespace CMS\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=["parent","name","link"];

    public function children(){
        return $this->hasMany(self::class,"parent");
    }

}

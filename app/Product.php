<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function toString() {
        return $this->id . '. ' . $this->name . ' | ' . $this->code . ' | ' . $this->qty . ' db';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    const RULES = [
        'name' => 'required|string|max:255|filled',
        'description' => 'required|string|filled',
        'price' => 'required|numeric|gt:0',
        'city' => 'required|string|filled'
    ];

    //table name
    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'description', 'price', 'city'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

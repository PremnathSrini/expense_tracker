<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded = [];

    public function attachment(){
        return $this->hasOne(Attachment::class,'id','attachment_id');
    }

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}

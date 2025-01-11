<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $guarded = [];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}

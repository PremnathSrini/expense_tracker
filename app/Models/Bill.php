<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;

class Bill extends Model
{
    use HasFactory,Dispatchable;

    protected $table = 'bills';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // protected $casts = [
    //     'due_date' => 'datetime',  // Ensures that 'due_date' is cast to a Carbon instance
    // ];
}

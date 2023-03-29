<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

        // 割り当て許可
        protected $fillable = [
            'user_id',
            'post_id',
               'name',
               'comment', 
           ];
}

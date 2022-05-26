<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'comment', 'project_id'
    ];

    protected $table = 'comments';

    public $timestamps = true;

    protected $hidden = [
        'id', 'deleted_at', 'project_id'
    ];
}

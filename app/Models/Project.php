<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'projects';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'title', 'description'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public $timestamps = true;

    /**
     * Get the comments of the project
     */
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}

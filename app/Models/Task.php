<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'done',
    ];


    public function markAsDone()
    {
        $this->done = true;
        return $this->save();
    }
}

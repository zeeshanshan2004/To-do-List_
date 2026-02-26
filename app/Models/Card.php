<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = ['task_list_id', 'title', 'description', 'position'];
    public function taskList() {
    return $this->belongsTo(TaskList::class);
}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Task;

class Task extends Model
{
    //
    protected $fillable = ['task'];

    public function status()
    {
        return $this->belongsTo('App\Status','status_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}

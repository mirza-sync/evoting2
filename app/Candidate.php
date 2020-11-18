<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function votedBy() {
        return $this->belongsToMany('App\User', 'votes', 'candidate_id', 'student_id');
    }
}

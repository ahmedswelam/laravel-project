<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;
    
   protected $table = "tasks";

   protected $fillable = ['id','title','description','image','start_time','end_time','users_id'	];
   

   public $timestamps = false ;
}

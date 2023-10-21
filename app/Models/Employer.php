<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'employers';

    protected $fillable = ['name','email'];
	
}

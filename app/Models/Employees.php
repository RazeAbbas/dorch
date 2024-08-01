<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Employees extends Model
{
	protected $table = 'employees';
	protected $primaryKey = 'emp_id';
	public $timestamps = true;
	protected $fillable = [

		'first_name',
		'last_name',
		'email',
		'password',
		'confirm_password',
		'profile_image',
		'created_user',
		'role'
	];

}

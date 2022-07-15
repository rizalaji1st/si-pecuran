<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'id', 'users_id', 'roles_id','instansis_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id', 'id');
    }
    
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansis_id', 'id');
    }
}

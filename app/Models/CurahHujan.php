<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurahHujan extends Model
{
    use HasFactory;

    protected $fillable = ['wilayahs_id', 'curah_hujan','tahun','bulan','tanggal','created_by','updated_by'];
}

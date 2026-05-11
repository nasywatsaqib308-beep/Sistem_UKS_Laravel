<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentDetail extends Model
{
    use HasFactory;

    protected $table = 'treatment_details';

    protected $fillable = [
        'treatment_id',
        'medicine_id',
        'jumlah',
    ];

    public function treatment() {
        return $this->belongsTo(Treatment::class);
    }

    public function medicine() {
        return $this->belongsTo(Medicine::class);
    }

}

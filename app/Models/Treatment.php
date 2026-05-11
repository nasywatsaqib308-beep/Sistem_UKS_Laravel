<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'keluhan',
        'diagnosa',
        'tanggal_kunjungan'
    ];

    public function student() {
    return $this->belongsTo(Student::class);
}

public function medicines() {
    return $this->belongsToMany(Medicine::class, 'treatment_details')->withPivot('jumlah');
}
}

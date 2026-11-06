<?php

namespace App\Modules\Pacientes\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteModel extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'documento',
        'fecha_nacimiento',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}

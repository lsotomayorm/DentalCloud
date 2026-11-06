<?php

namespace App\Modules\Pacientes\Infrastructure\Persistence;

use App\Modules\Pacientes\Domain\Entities\Paciente;
use App\Modules\Pacientes\Domain\Repositories\PacienteRepository;
use App\Modules\Pacientes\Infrastructure\Persistence\Models\PacienteModel;

class EloquentPacienteRepository implements PacienteRepository
{
    public function guardar(Paciente $paciente): void
    {
        PacienteModel::create([
            'nombre' => $paciente->getNombre(),
            'documento' => $paciente->getDocumento(),
            'fecha_nacimiento' => $paciente->getFechaNacimiento()?->format('Y-m-d'),
        ]);
    }
}

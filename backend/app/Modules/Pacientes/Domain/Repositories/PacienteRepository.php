<?php

namespace App\Modules\Pacientes\Domain\Repositories;

use App\Modules\Pacientes\Domain\Entities\Paciente;

interface PacienteRepository
{
    public function guardar(Paciente $paciente): void;
}

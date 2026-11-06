<?php

namespace App\Modules\Pacientes\Application\Services;

use App\Modules\Pacientes\Domain\Entities\Paciente;
use App\Modules\Pacientes\Domain\Repositories\PacienteRepository;
use DateTimeImmutable;

class RegistrarPaciente
{
    private PacienteRepository $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    public function ejecutar(
        string $nombre,
        string $documento,
        ?DateTimeImmutable $fechaNacimiento = null
    ): void {
        $paciente = new Paciente(
            $nombre,
            $documento,
            $fechaNacimiento
        );

        $this->pacienteRepository->guardar($paciente);
    }
}

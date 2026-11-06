<?php

namespace Tests\Feature\Pacientes\Application;

use App\Modules\Pacientes\Application\Services\RegistrarPaciente;
use App\Modules\Pacientes\Infrastructure\Persistence\EloquentPacienteRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrarPacienteIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registra_un_paciente_utilizando_el_repositorio_real(): void
    {
        // Arrange
        $repository = new EloquentPacienteRepository();

        $service = new RegistrarPaciente($repository);

        // Act
        $service->ejecutar(
            'Carlos Ramirez',
            '87654321',
            new \DateTimeImmutable('1998-10-20')
        );

        // Assert
        $this->assertDatabaseHas('pacientes', [
            'nombre' => 'Carlos Ramirez',
            'documento' => '87654321',
            'fecha_nacimiento' => '1998-10-20',
        ]);
    }
}

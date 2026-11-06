<?php

namespace Tests\Feature\Pacientes\Infrastructure;

use App\Modules\Pacientes\Domain\Entities\Paciente;
use App\Modules\Pacientes\Infrastructure\Persistence\EloquentPacienteRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentPacienteRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guarda_un_paciente_en_la_base_de_datos(): void
    {
        // Arrange
        $paciente = new Paciente(
            'Juan Perez',
            '12345678',
            new \DateTimeImmutable('2000-05-15')
        );

        $repository = new EloquentPacienteRepository();

        // Act
        $repository->guardar($paciente);

        // Assert
        $this->assertDatabaseHas('pacientes', [
            'nombre' => 'Juan Perez',
            'documento' => '12345678',
            'fecha_nacimiento' => '2000-05-15',
        ]);
    }
}

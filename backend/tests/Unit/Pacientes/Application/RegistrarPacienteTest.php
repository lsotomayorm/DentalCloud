<?php

namespace Tests\Unit\Pacientes\Application;

use App\Modules\Pacientes\Application\Services\RegistrarPaciente;
use App\Modules\Pacientes\Domain\Entities\Paciente;
use App\Modules\Pacientes\Domain\Repositories\PacienteRepository;
use DateTimeImmutable;
use InvalidArgumentException;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class RegistrarPacienteTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_registra_un_paciente_correctamente(): void
    {
        $repositorio = Mockery::mock(PacienteRepository::class);

        $repositorio->shouldReceive('guardar')
            ->once()
            ->with(Mockery::on(function ($paciente) {
                return $paciente instanceof Paciente
                    && $paciente->getNombre() === 'Juan Pérez'
                    && $paciente->getDocumento() === '12345678';
            }));

        $servicio = new RegistrarPaciente($repositorio);

        $servicio->ejecutar(
            'Juan Pérez',
            '12345678',
            new DateTimeImmutable('2000-05-15')
        );
    }

    public function test_no_guarda_un_paciente_sin_nombre(): void
    {
        $repositorio = Mockery::mock(PacienteRepository::class);

        $repositorio->shouldNotReceive('guardar');

        $servicio = new RegistrarPaciente($repositorio);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'El nombre del paciente es obligatorio.'
        );

        $servicio->ejecutar('', '12345678');
    }

    public function test_no_guarda_un_paciente_sin_documento(): void
    {
        $repositorio = Mockery::mock(PacienteRepository::class);

        $repositorio->shouldNotReceive('guardar');

        $servicio = new RegistrarPaciente($repositorio);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'El documento del paciente es obligatorio.'
        );

        $servicio->ejecutar('Juan Pérez', '');
    }

    public function test_no_guarda_un_paciente_con_fecha_futura(): void
    {
        $repositorio = Mockery::mock(PacienteRepository::class);

        $repositorio->shouldNotReceive('guardar');

        $servicio = new RegistrarPaciente($repositorio);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'La fecha de nacimiento no puede ser futura.'
        );

        $servicio->ejecutar(
            'Juan Pérez',
            '12345678',
            new DateTimeImmutable('+1 day')
        );
    }
}

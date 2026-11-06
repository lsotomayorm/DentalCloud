<?php

namespace tests\Unit\Pacientes\Domain;

use App\Modules\Pacientes\Domain\Entities\Paciente;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PacienteTest extends TestCase
{
    public function test_puede_crear_un_paciente_con_datos_validos(): void
    {
        $paciente = new Paciente(
            'Juan Pérez',
            '12345678',
            new DateTimeImmutable('2000-05-15')
        );

        $this->assertSame('Juan Pérez', $paciente->getNombre());
        $this->assertSame('12345678', $paciente->getDocumento());
        $this->assertSame(
            '2000-05-15',
            $paciente->getFechaNacimiento()->format('Y-m-d')
        );
    }

    public function test_no_puede_crear_un_paciente_sin_nombre(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'El nombre del paciente es obligatorio.'
        );

        new Paciente('', '12345678');
    }

    public function test_no_puede_crear_un_paciente_sin_documento(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'El documento del paciente es obligatorio.'
        );

        new Paciente('Juan Pérez', '');
    }

    public function test_no_puede_tener_fecha_de_nacimiento_futura(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'La fecha de nacimiento no puede ser futura.'
        );

        new Paciente(
            'Juan Pérez',
            '12345678',
            new DateTimeImmutable('+1 day')
        );
    }

    public function test_puede_actualizar_sus_datos_personales(): void
    {
        $paciente = new Paciente('Juan Pérez', '12345678');

        $paciente->actualizarDatosPersonales(
            'Carlos López',
            '87654321',
            new DateTimeImmutable('1998-10-20')
        );

        $this->assertSame('Carlos López', $paciente->getNombre());
        $this->assertSame('87654321', $paciente->getDocumento());
        $this->assertSame(
            '1998-10-20',
            $paciente->getFechaNacimiento()->format('Y-m-d')
        );
    }

    public function test_no_actualiza_los_datos_si_son_invalidos(): void
    {
        $paciente = new Paciente('Juan Pérez', '12345678');

        try {
            $paciente->actualizarDatosPersonales('', '87654321');
            $this->fail('Se esperaba una excepción.');
        } catch (InvalidArgumentException $e) {
            $this->assertSame(
                'El nombre del paciente es obligatorio.',
                $e->getMessage()
            );
        }

        $this->assertSame('Juan Pérez', $paciente->getNombre());
        $this->assertSame('12345678', $paciente->getDocumento());
    }
}

<?php

namespace App\Modules\Pacientes\Domain\Entities;

use DateTimeImmutable;
use InvalidArgumentException;

class Paciente
{
    private string $nombre;
    private string $documento;
    private ?DateTimeImmutable $fechaNacimiento;

    public function __construct(
        string $nombre,
        string $documento,
        ?DateTimeImmutable $fechaNacimiento = null
    ) {
        $this->validarDatos($nombre, $documento, $fechaNacimiento);

        $this->nombre = trim($nombre);
        $this->documento = trim($documento);
        $this->fechaNacimiento = $fechaNacimiento;
    }

    private function validarDatos(
        string $nombre,
        string $documento,
        ?DateTimeImmutable $fechaNacimiento
    ): void {
        if (trim($nombre) === '') {
            throw new InvalidArgumentException(
                'El nombre del paciente es obligatorio.'
            );
        }

        if (trim($documento) === '') {
            throw new InvalidArgumentException(
                'El documento del paciente es obligatorio.'
            );
        }

        if (
            $fechaNacimiento !== null &&
            $fechaNacimiento->format('Y-m-d') >
            (new DateTimeImmutable('today'))->format('Y-m-d')
        ) {
            throw new InvalidArgumentException(
                'La fecha de nacimiento no puede ser futura.'
            );
        }
    }

    public function actualizarDatosPersonales(
        string $nombre,
        string $documento,
        ?DateTimeImmutable $fechaNacimiento = null
    ): void {
        $this->validarDatos($nombre, $documento, $fechaNacimiento);

        $this->nombre = trim($nombre);
        $this->documento = trim($documento);
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function getFechaNacimiento(): ?DateTimeImmutable
    {
        return $this->fechaNacimiento;
    }
}

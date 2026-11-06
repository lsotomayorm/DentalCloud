<?php

namespace App\Http\Controllers;

use App\Modules\Pacientes\Application\Services\RegistrarPaciente;
use DateTimeImmutable;
use Illuminate\Http\Request;
use InvalidArgumentException;

class PacienteWebController extends Controller
{
    private RegistrarPaciente $registrarPaciente;

    public function __construct(RegistrarPaciente $registrarPaciente)
    {
        $this->registrarPaciente = $registrarPaciente;
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => [
                'nullable',
                'date',
                'before_or_equal:today'
            ],
        ]);

        try {
            $fechaNacimiento = !empty($datos['fecha_nacimiento'])
                ? new DateTimeImmutable($datos['fecha_nacimiento'])
                : null;

            $this->registrarPaciente->ejecutar(
                $datos['nombre'],
                $datos['documento'],
                $fechaNacimiento
            );

            return redirect()
                ->route('pacientes.create')
                ->with('success', 'Paciente registrado correctamente.');

        } catch (InvalidArgumentException $e) {
            return back()
                ->withInput()
                ->withErrors(['paciente' => $e->getMessage()]);
        }
    }
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Pacientes\Domain\Repositories\PacienteRepository;
use App\Modules\Pacientes\Infrastructure\Persistence\EloquentPacienteRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            PacienteRepository::class,
            EloquentPacienteRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
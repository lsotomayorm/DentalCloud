# Reporte de Ejecución de Pruebas – Módulo Pacientes

## 1. Información general

| Campo | Valor |
|---|---|
| Proyecto | DentalCloud |
| Módulo | Pacientes |
| Framework | PHPUnit 12.5.43 |
| Entorno | Laravel 13 |
| Base de datos de pruebas | PostgreSQL |
| Fecha de ejecución | 06/11/2026 |

## 2. Comando ejecutado

```bash
php artisan test
```

## 3. Resultado de ejecución

| Métrica | Resultado |
|---|---:|
| Pruebas ejecutadas | 14 |
| Pruebas aprobadas | 14 |
| Pruebas fallidas | 0 |
| Aserciones | 29 |
| Duración | 2.45 segundos |

**Estado general:** Todas las pruebas finalizaron correctamente.

## 4. Resultados por componente

| Componente | Pruebas | Resultado |
|---|---:|---|
| ExampleTest (Unit) | 1 | PASS |
| RegistrarPaciente (Unit) | 4 | PASS |
| Paciente (Domain) | 6 | PASS |
| ExampleTest (Feature) | 1 | PASS |
| RegistrarPaciente (Integration) | 1 | PASS |
| EloquentPacienteRepository (Integration) | 1 | PASS |
| **Total** | **14** | **PASS** |

## 5. Conclusión

La ejecución de la suite completa de pruebas confirmó el correcto funcionamiento de los casos implementados para el módulo Pacientes.

Se verificaron las validaciones de la entidad, el comportamiento del servicio de aplicación utilizando Mockery y la persistencia de información mediante el repositorio Eloquent y PostgreSQL.
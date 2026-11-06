# Casos de Prueba – Módulo Pacientes

## 1. Información general

| Campo | Descripción |
|---|---|
| Proyecto | DentalCloud |
| Módulo | Pacientes |
| Responsable | Desarrollador del módulo Pacientes |
| Framework de pruebas | PHPUnit |
| Framework de mocking | Mockery |
| Base de datos de pruebas | PostgreSQL (`dentalcloud_test`) |

## 2. Pruebas unitarias del dominio

**Archivo:** `tests/Unit/Pacientes/Domain/PacienteTest.php`

| ID | Caso de prueba | Resultado esperado |
|---|---|---|
| PAC-DOM-01 | Crear paciente con datos válidos | El paciente se crea correctamente. |
| PAC-DOM-02 | Crear paciente sin nombre | Se lanza una excepción. |
| PAC-DOM-03 | Crear paciente sin documento | Se lanza una excepción. |
| PAC-DOM-04 | Crear paciente con fecha de nacimiento futura | Se lanza una excepción. |
| PAC-DOM-05 | Actualizar datos personales válidos | Los datos del paciente se actualizan. |
| PAC-DOM-06 | Actualizar datos con valores inválidos | Se lanza una excepción y los datos originales se conservan. |

## 3. Pruebas unitarias de aplicación

**Archivo:** `tests/Unit/Pacientes/Application/RegistrarPacienteTest.php`

Se utiliza Mockery para simular el repositorio y comprobar la interacción del servicio con su dependencia.

| ID | Caso de prueba | Resultado esperado |
|---|---|---|
| PAC-APP-01 | Registrar paciente correctamente | Se invoca el método `guardar()` una vez con una entidad Paciente. |
| PAC-APP-02 | Registrar paciente sin nombre | Se lanza una excepción y no se guarda el paciente. |
| PAC-APP-03 | Registrar paciente sin documento | Se lanza una excepción y no se guarda el paciente. |
| PAC-APP-04 | Registrar paciente con fecha futura | Se lanza una excepción y no se guarda el paciente. |

## 4. Pruebas de integración del repositorio

**Archivo:** `tests/Feature/Pacientes/Infrastructure/EloquentPacienteRepositoryTest.php`

| ID | Caso de prueba | Resultado esperado |
|---|---|---|
| PAC-REP-01 | Guardar un paciente en la base de datos | El paciente queda almacenado correctamente en la tabla `pacientes`. |

## 5. Pruebas de integración del servicio

**Archivo:** `tests/Feature/Pacientes/Application/RegistrarPacienteIntegrationTest.php`

| ID | Caso de prueba | Resultado esperado |
|---|---|---|
| PAC-INT-01 | Registrar un paciente utilizando el repositorio real | El servicio registra el paciente y sus datos quedan almacenados en PostgreSQL. |

## 6. Resumen de casos de prueba

| Componente | Tipo | Cantidad |
|---|---|---:|
| Domain | Unitarias | 6 |
| Application | Unitarias con Mockery | 4 |
| Infrastructure | Integración | 1 |
| Application | Integración | 1 |
| **Total del módulo** | | **12** |

## 7. Técnica de diseño de pruebas

Se utiliza el patrón AAA:

- **Arrange:** preparar los datos y dependencias necesarias.
- **Act:** ejecutar el método que se desea probar.
- **Assert:** verificar el resultado obtenido.

Las pruebas unitarias del servicio utilizan Mockery para aislar el repositorio. Las pruebas de integración utilizan PostgreSQL y verifican la persistencia real de los datos.

## 8. Resultado de ejecución

Última ejecución de la suite completa:

```text
Tests: 14 passed (29 assertions)
Duration: 2.45s
```

Las 14 pruebas incluyen también los tests de ejemplo generados por Laravel. El módulo Pacientes cuenta con 12 casos de prueba propios, todos aprobados.
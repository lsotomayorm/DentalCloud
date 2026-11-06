<?php

namespace Tests\Functional\Pacientes;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\TestCase;

class ValidarPacienteTest extends TestCase
{
    private RemoteWebDriver $driver;

    protected function setUp(): void
    {
        parent::setUp();

        $options = new ChromeOptions();
        $options->addArguments([
            '--headless=new',
            '--no-sandbox',
            '--disable-dev-shm-usage',
        ]);

        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(
            ChromeOptions::CAPABILITY,
            $options
        );

        $this->driver = RemoteWebDriver::create(
            'http://127.0.0.1:9515',
            $capabilities
        );
    }

    protected function tearDown(): void
    {
        if (isset($this->driver)) {
            $this->driver->quit();
        }

        parent::tearDown();
    }

    private function abrirFormulario(): void
    {
        $this->driver->get(
            'http://127.0.0.1:8000/prueba/pacientes'
        );
    }

    private function comprobarError(): void
    {
        $mensaje = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                WebDriverBy::id('mensaje-error')
            )
        );

        $this->assertNotEmpty($mensaje->getText());
    }

    public function test_no_registra_paciente_sin_nombre(): void
    {
        $this->abrirFormulario();

        $this->driver->findElement(
            WebDriverBy::id('documento')
        )->sendKeys('12345678');

        $this->driver->findElement(
            WebDriverBy::id('btn-registrar')
        )->click();

        $this->comprobarError();
    }

    public function test_no_registra_paciente_sin_documento(): void
    {
        $this->abrirFormulario();

        $this->driver->findElement(
            WebDriverBy::id('nombre')
        )->sendKeys('Paciente sin documento');

        $this->driver->findElement(
            WebDriverBy::id('btn-registrar')
        )->click();

        $this->comprobarError();
    }

    public function test_no_registra_paciente_con_fecha_futura(): void
    {
        $this->abrirFormulario();

        $this->driver->findElement(
            WebDriverBy::id('nombre')
        )->sendKeys('Paciente fecha futura');

        $this->driver->findElement(
            WebDriverBy::id('documento')
        )->sendKeys('12345679');

        $fechaFutura = date(
            'Y-m-d',
            strtotime('+1 day')
        );

        $campoFecha = $this->driver->findElement(
            WebDriverBy::id('fecha_nacimiento')
        );

        $this->driver->executeScript(
            "arguments[0].value = arguments[1];
            arguments[0].dispatchEvent(new Event('input', { bubbles: true }));
            arguments[0].dispatchEvent(new Event('change', { bubbles: true }));",
            [$campoFecha, $fechaFutura]
        );

        // Comprobar que Chrome recibió correctamente la fecha.
        $this->assertSame(
            $fechaFutura,
            $campoFecha->getAttribute('value'),
            'Selenium no ingresó correctamente la fecha futura.'
        );

        $this->driver->findElement(
            WebDriverBy::id('btn-registrar')
        )->click();

        $this->comprobarError();
    }
}

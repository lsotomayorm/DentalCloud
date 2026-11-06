<?php

namespace Tests\Functional\Pacientes;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use PHPUnit\Framework\TestCase;

class RegistrarPacienteTest extends TestCase
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

    public function test_registra_un_paciente_desde_el_formulario(): void
    {
        $this->driver->get(
            'http://127.0.0.1:8000/prueba/pacientes'
        );

        $documento = '9' . substr(
            (string) time(),
            -7
        );

        $this->driver->findElement(
            WebDriverBy::id('nombre')
        )->sendKeys('Paciente Selenium');

        $this->driver->findElement(
            WebDriverBy::id('documento')
        )->sendKeys($documento);

        $this->driver->findElement(
            WebDriverBy::id('fecha_nacimiento')
        )->sendKeys('1998-10-20');

        $this->driver->findElement(
            WebDriverBy::id('btn-registrar')
        )->click();

        $mensaje = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                WebDriverBy::id('mensaje-exito')
            )
        );

        $this->assertStringContainsString(
            'Paciente registrado correctamente.',
            $mensaje->getText()
        );
    }
}
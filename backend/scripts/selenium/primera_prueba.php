<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;

$host = 'http://localhost:9515';

$options = new ChromeOptions();
$options->addArguments([
    '--start-maximized'
]);

$capabilities = DesiredCapabilities::chrome();
$capabilities->setCapability(
    ChromeOptions::CAPABILITY,
    $options
);

$driver = null;

try {
    echo "Iniciando Selenium...\n";

    $driver = RemoteWebDriver::create(
        $host,
        $capabilities,
        5000,
        30000
    );

    $driver->get('https://www.selenium.dev/');

    $titulo = $driver->getTitle();

    echo "Titulo obtenido: " . $titulo . "\n";

    if (str_contains($titulo, 'Selenium')) {
        echo "PRUEBA EXITOSA: Chrome fue controlado por Selenium.\n";
    } else {
        echo "PRUEBA FALLIDA: El titulo no coincide.\n";
    }

} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";

} finally {
    if ($driver !== null) {
        $driver->quit();
        echo "Navegador cerrado.\n";
    }
}

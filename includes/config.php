<?php
// Ajustes del servidor. Para sobrescribir en producción crea includes/config.local.php
// (ignorado por git) devolviendo un array con las mismas claves.
$config = [
    'mail_to'   => 'tu-correo@ejemplo.com',
    'mail_from' => 'no-reply@portafolio.pdsx.org',
];

$local = __DIR__ . '/config.local.php';
if (is_file($local)) {
    $config = array_merge($config, require $local);
}

return $config;

<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function respond(int $code, string $message): never
{
    http_response_code($code);
    echo json_encode(['ok' => $code < 300, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, 'Método no permitido.');
}

// Misma procedencia: bloquea envíos desde otros sitios.
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin !== '' && parse_url($origin, PHP_URL_HOST) !== ($_SERVER['HTTP_HOST'] ?? '')) {
    respond(403, 'Origen no permitido.');
}

// Honeypot: los bots rellenan este campo.
if (!empty($_POST['website'])) {
    respond(200, 'Mensaje enviado.');
}

// Límite simple: 3 envíos por IP cada 10 minutos.
$limitFile = sys_get_temp_dir() . '/portfolio_rl_' . md5($_SERVER['REMOTE_ADDR'] ?? '');
$hits = is_file($limitFile) ? array_filter(array_map('intval', file($limitFile, FILE_IGNORE_NEW_LINES))) : [];
$hits = array_filter($hits, fn (int $t) => $t > time() - 600);
if (count($hits) >= 3) {
    respond(429, 'Demasiados intentos. Prueba más tarde.');
}

$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if (mb_strlen($name) < 2 || mb_strlen($name) > 80) {
    respond(422, 'Nombre inválido.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
    respond(422, 'Email inválido.');
}
if (mb_strlen($message) < 10 || mb_strlen($message) > 3000) {
    respond(422, 'El mensaje debe tener entre 10 y 3000 caracteres.');
}

$config = require __DIR__ . '/../includes/config.php';

// Evita inyección de cabeceras: el nombre nunca contiene saltos de línea.
$safeName = preg_replace('/[\r\n]+/', ' ', $name);
$headers  = [
    'From: ' . $config['mail_from'],
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
];
$body = "Nombre: $safeName\nEmail: $email\n\n$message\n";

if (!mail($config['mail_to'], '=?UTF-8?B?' . base64_encode('Portafolio: mensaje de ' . $safeName) . '?=', $body, implode("\r\n", $headers))) {
    respond(500, 'No se pudo enviar el mensaje.');
}

$hits[] = time();
file_put_contents($limitFile, implode("\n", $hits));
respond(200, 'Mensaje enviado. ¡Gracias!');

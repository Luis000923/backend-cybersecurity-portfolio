# Portafolio · Luis Ernesto Galdámez

Sitio personal de **Luis Ernesto Galdámez** (Junior Cybersecurity Analyst · Python & AppSec). Hecho solo con **PHP, HTML, CSS y JavaScript**, sin dependencias ni paso de build.

🌐 https://portafolio.pdsx.org

## Estructura

```
index.php          Página principal (plantilla)
includes/data.php  Todo el contenido del sitio (textos, proyectos, documentos)
includes/config.php  Ajustes del servidor; sobrescribibles con config.local.php (ignorado por git)
api/contact.php    Endpoint del formulario de contacto
assets/            CSS, JS e imágenes
files/             CV y certificados en PDF
.htaccess          Cabeceras de seguridad (CSP, nosniff, etc.) y caché
```

## Ejecutar en local

```bash
php -S 127.0.0.1:8000
```

Abre http://127.0.0.1:8000. Para que el formulario envíe correo, crea `includes/config.local.php`:

```php
<?php
return ['mail_to' => 'tu-correo@ejemplo.com'];
```

## Seguridad

- CSP restrictiva, `X-Content-Type-Options`, `X-Frame-Options` y `Referrer-Policy`.
- Formulario con validación en servidor, honeypot, límite de 3 envíos por IP cada 10 minutos y comprobación de origen.
- Salida escapada con `htmlspecialchars`; protección contra inyección de cabeceras de correo.
- `includes/` y `data/` bloqueados desde el servidor web.

## Licencia

MIT

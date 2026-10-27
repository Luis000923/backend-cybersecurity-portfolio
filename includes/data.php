<?php
// Fuente única de contenido del portafolio.
return [
    'name'     => 'Luis Ernesto Galdámez',
    'role'     => 'Junior Cybersecurity Analyst · Python & AppSec',
    'location' => 'El Salvador',
    'site_url' => 'https://portafolio.pdsx.org',
    'github'   => 'https://github.com/Luis000923',
    'linkedin' => 'https://www.linkedin.com/in/luis-ernesto-gald%C3%A1mez-vides-39a253394',
    'hackenproof' => 'https://hackenproof.com/hackers/foker',
    'whatsapp' => 'https://wa.me/50370414649',
    'phone'    => '(+503) 7041 4649',
    'cv'       => 'files/CV_Luis_Vides.pdf',

    'tagline' => 'Estudiante de Redes y Ciberseguridad. Construyo herramientas que automatizan la detección de vulnerabilidades en aplicaciones web y en código fuente, con pruebas automatizadas y CI/CD. Busco mi primera posición junior en seguridad de aplicaciones o automatización de seguridad.',

    'about' => [
        'Comencé mi camino en la tecnología en 8° grado, cuando recibí mi primera computadora a través de un programa del gobierno de El Salvador. En ese momento descubrí un video de S4VITAR que despertó mi interés por la ciberseguridad.',
        'Desde entonces aprendí de forma autodidacta, con una fuerte curiosidad por entender qué ocurre detrás de los sistemas. Desarrollé una mentalidad orientada a la automatización: cada proceso repetitivo que encontraba, intentaba automatizarlo.',
        'Hoy estudio el Técnico en Redes y Ciberseguridad en la Universidad Evangélica de El Salvador (UEES), tengo un diplomado en Ciberseguridad y aplico lo aprendido en mis propias herramientas: un escáner web asíncrono en Python y un analizador SAST en TypeScript.',
    ],

    'timeline' => [
        ['Primer contacto',         'Primera computadora y descubrimiento de la ciberseguridad.'],
        ['Aprendizaje autodidacta', 'Python, automatización y scripting.'],
        ['Herramientas de seguridad', 'Web Security Scanner y Secure-Scan, con pruebas y CI.'],
        ['Presente',                'Técnico en Redes y Ciberseguridad (UEES) · bug bounty en HackenProof.'],
    ],

    'stats' => [
        ['16',   'Testers de vulnerabilidades'],
        ['185',  'Pruebas en secure-scan'],
        ['6',    'Lenguajes analizados (SAST)'],
        ['9',    'Proyectos públicos'],
    ],

    // [nombre, proyectos públicos]
    'languages' => [
        ['Python',     5],
        ['JavaScript', 4],
        ['HTML/CSS',   4],
        ['TypeScript', 3],
        ['PHP',        1],
    ],

    'skills' => [
        'Seguridad'        => ['AppSec', 'SAST', 'OWASP Top 10', 'SQLi', 'XSS', 'SSRF', 'CSRF', 'CWE', 'MITRE ATT&CK', 'Análisis estático'],
        'Python y automatización' => ['Python', 'asyncio', 'aiohttp', 'Flask', 'Selenium', 'Web scraping', 'CLI tools', 'Bots'],
        'Calidad y DevOps' => ['Git/GitHub', 'GitHub Actions', 'Docker', 'pytest', 'Jest', 'ruff', 'mypy', 'ESLint'],
        'Backend'          => ['Node.js', 'TypeScript', 'REST APIs', 'Express', 'MySQL', 'SQLite', 'Firebase'],
        'Redes y sistemas' => ['TCP/IP', 'IPv4/IPv6', 'Linux', 'Windows'],
    ],

    'projects' => [
        ['Web_security_scanner', true, 'Escáner de seguridad web asíncrono (asyncio + aiohttp) con arquitectura de plugins. 16 testers de vulnerabilidades (SQLi, XSS, SSRF, XXE, CSRF, IDOR, Path Traversal) con niveles de confianza, protección anti-SSRF, reportes JSON y PDF, y CI en GitHub Actions.', ['Python', 'asyncio', 'AppSec', 'CI/CD'], 'https://github.com/Luis000923/Web_security_scanner'],
        ['secure-scan', true, 'Herramienta SAST que analiza código sin ejecutarlo: JavaScript, Python, PHP, Java, C/C++ y C#. Análisis de AST, hallazgos mapeados a OWASP, CWE y MITRE ATT&CK, y reportes HTML por severidad. Pruebas con Jest y ESLint.', ['TypeScript', 'SAST', 'CLI', 'Jest'], 'https://github.com/Luis000923/secure-scan'],
        ['S4VI_BOT', false, 'Bot multifuncional para Discord con integración web usando Flask, comandos avanzados, web scraping y monitoreo de recursos del sistema.', ['Python', 'Discord.js', 'Flask', 'Bot'], 'https://github.com/Luis000923/S4VI_BOT'],
        ['Bot-formulario-de-google-', false, 'Bot en Python que automatiza el llenado y envío de formularios de Google Forms con Selenium.', ['Python', 'Selenium', 'Automation'], 'https://github.com/Luis000923/Bot-formulario-de-google-'],
        ['AM-Visual', false, 'Aplicación de escritorio para aplicar una o varias marcas de agua a imágenes de forma masiva. Procesamiento batch eficiente.', ['Python', 'Desktop', 'Batch'], 'https://github.com/Luis000923/AM-Visual'],
        ['videos-a-9-16', false, 'Script que convierte videos a formato 9:16 para YouTube Shorts. Procesamiento automático con MoviePy.', ['Python', 'FFmpeg', 'Automation'], 'https://github.com/Luis000923/videos-a-9-16'],
        ['bot-grupo-whatsapp', false, 'Bot de WhatsApp para grupos con funciones de entretenimiento, interfaz de escritorio con Electron y base de datos SQLite.', ['Node.js', 'Electron', 'SQLite', 'Bot'], 'https://github.com/Luis000923/bot-grupo-whatsapp'],
        ['AviTrack', false, 'App móvil de registro y seguimiento de pollos con autenticación Google, sincronización en la nube con Firebase y exportación de datos.', ['React Native', 'Expo', 'Firebase', 'TypeScript'], 'https://github.com/Luis000923/AviTrack'],
        ['backend-cybersecurity-portfolio', false, 'Este portafolio. Sitio con PHP, HTML, CSS y JavaScript, sin dependencias ni build. Formulario con honeypot, límite de envíos y validación de origen.', ['PHP', 'HTML', 'CSS', 'JavaScript'], 'https://github.com/Luis000923/backend-cybersecurity-portfolio'],
    ],

    // [tipo, título, detalle, archivo en files/]
    'documents' => [
        ['CV', 'Currículum vitae', 'Analista Junior de Ciberseguridad · Automatización con Python', 'CV_Luis_Vides.pdf'],
        ['Diplomado', 'Diplomado en Ciberseguridad', 'Universidad Evangélica de El Salvador · 27 jun – 26 sep 2026', 'diplomado-ciberseguridad-uees.pdf'],
        ['Cisco', 'CCNA: Introducción a las redes', 'Cisco Networking Academy · UEES · 29 may 2026', 'ccna-introduccion-a-las-redes.pdf'],
        ['Cisco', 'Fundamentos de Python 1', 'Cisco Networking Academy · UEES · 9 jun 2026', 'python-essentials-1.pdf'],
    ],

    'gallery' => ['2', '3', '4', '5', '6', '7', '8'],
];

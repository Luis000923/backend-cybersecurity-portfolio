# backend-cybersecurity-portfolio

![Astro](https://img.shields.io/badge/Astro-FF5D01?style=flat-square&logo=astro&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-339933?style=flat-square&logo=nodedotjs&logoColor=white)
![Express](https://img.shields.io/badge/Express-000000?style=flat-square&logo=express&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-3178C6?style=flat-square&logo=typescript&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-5b93d2?style=flat-square)

> Este repositorio es el codigo fuente del portfolio personal en produccion. Incluye frontend estatico con Astro y TailwindCSS, y un backend REST con Node.js y Express enfocado en seguridad, validacion y arquitectura limpia.

**Sitio en produccion:** [portafolio.pdsx.org](https://portafolio.pdsx.org)

---

## Documentación Técnica

Para una comprensión profunda de los diferentes aspectos del proyecto, consulte la documentación especializada en la carpeta `/DOC`:

- [**Biografía y Perfil**](./DOC/BIOGRAPHY.md): Historia y filosofía del desarrollador.
- [**Arquitectura**](./DOC/ARCHITECTURE.md): Estructura del monorepo y flujo de datos.
- [**Seguridad**](./DOC/SECURITY.md): Medidas de Hardening, CORS y validación.
- [**Funcionalidades**](./DOC/FEATURES.md): Detalles técnicos de certificados, estrellas y contacto.
- [**Referencia API**](./DOC/API_REFERENCE.md): Guía de endpoints y esquemas de datos.

---

## Vista general

Portfolio personal de Luis Ernesto Galdamez, desarrollador backend con enfoque en ciberseguridad. El proyecto no es un template generico: expone proyectos reales, certificados dinamicos y un sistema de contacto funcional con SMTP, con metricas de visitas y valoraciones por IP unica.

El proposito es demostrar nivel tecnico real a traves del codigo mismo, no solo en su contenido visual.

---

## Tecnologias utilizadas

| Capa | Tecnologia |
|---|---|
| Frontend | Astro v6, TailwindCSS v4 |
| Backend | Node.js 22, Express v5 |
| Email | Nodemailer + SMTP Hostinger |
| Validacion | express-validator |
| Seguridad | Helmet, CORS, rate-limit |
| Gestor de paquetes | pnpm (workspace monorepo) |

---

## Arquitectura

El proyecto sigue una separacion estricta entre frontend y backend, comunicandose unicamente via HTTP sobre endpoints REST documentados.

```
cliente (navegador)
       |
       | HTTP (fetch)
       v
  [frontend — Astro SSG]        →   archivos estaticos en CDN / Hostinger
       |
       | /api/*
       v
  [backend — Express API]       →   Node.js en servidor de Hostinger
       |
       | fs / SMTP
       v
  [datos locales / email]
```

### Estructura de carpetas

```
backend-cybersecurity-portfolio/
├── frontend/                   # Aplicacion Astro
│   ├── src/
│   │   ├── components/         # Hero, Skills, Projects, Contact, StarWidget...
│   │   ├── layouts/
│   │   └── pages/
│   └── astro.config.mjs
│
├── backend/                    # API Express
│   ├── src/
│   │   ├── controllers/
│   │   ├── routes/
│   │   ├── services/           # contact, visits, stars
│   │   ├── middleware/         # error, rate-limit, sanitize
│   │   └── server.js
│   └── .env.example
│
├── public/                     # Archivos estaticos compartidos
│   ├── certificates/           # PDFs de certificados
│   └── images/                 # Fotos del desarrollador
│
└── pnpm-workspace.yaml
```

---

## Caracteristicas principales

- **Sistema de contacto real**: formulario con validacion en servidor, envio via SMTP Hostinger, reenvio a correo personal.
- **Valoraciones por IP unica**: los visitantes pueden dar una estrella al portfolio. El backend rechaza votos duplicados por IP.
- **Contador de visitas unicas**: persistencia en archivo JSON, deduplicacion por IP.
- **Certificados dinamicos**: los PDFs en `/public/certificates` se cargan y renderizan automaticamente sin configuracion adicional.
- **Seguridad aplicada**: headers HTTP con Helmet, CORS configurado por entorno, rate limiting por ruta, validacion y sanitizacion de inputs.
- **Proyectos reales de GitHub**: la seccion de proyectos carga informacion curada directamente desde los repositorios publicos del desarrollador.

---

## Instalacion y uso

### Requisitos previos

- Node.js >= 22.12
- pnpm >= 10

### Clonar e instalar

```bash
git clone https://github.com/Luis000923/backend-cybersecurity-portfolio.git
cd backend-cybersecurity-portfolio
pnpm install
```

### Variables de entorno

Copia el archivo de ejemplo y completa con tus credenciales:

```bash
cp backend/.env.example backend/.env
```

Variables requeridas:

```env
NODE_ENV=development

MAIL_HOST=smtp.tuproveedor.com
MAIL_PORT=465
MAIL_SECURE=true
MAIL_USER=tu@dominio.com
MAIL_PASS="tu-contrasena"
MAIL_FROM=tu@dominio.com
MAIL_TO=tu-correo-destino@gmail.com

CORS_ORIGIN=http://localhost:4321
```

> Nota: si la contrasena contiene caracteres especiales como `#`, encierra el valor entre comillas dobles en el `.env`.

### Ejecutar en desarrollo

```bash
pnpm run dev
```

Esto levanta en paralelo:
- Frontend en `http://localhost:4321`
- Backend en `http://localhost:3000`

---

## Seguridad

| Medida | Implementacion |
|---|---|
| HTTP Headers | Helmet con CSP restrictiva |
| CORS | Lista blanca por entorno via `.env` |
| Rate limiting | express-rate-limit por ruta (contact, visits) |
| Validacion de inputs | express-validator en todos los endpoints POST |
| Credenciales | Variables de entorno, nunca en codigo fuente |
| Certificados TLS | Conexion SMTP con SSL/TLS forzado (puerto 465) |

---

## Despliegue

El proyecto esta desplegado en Hostinger con la siguiente separacion:

| Parte | Tipo | Notas |
|---|---|---|
| Frontend | Sitio estatico | Build con `pnpm --filter frontend run build` |
| Backend | Node.js (VPS/Business) | Proceso persistente con PM2 o equivalente |

Para construir el frontend:

```bash
pnpm --filter frontend run build
```

El directorio `frontend/dist/` contiene los archivos listos para subir al servidor web.

---

## Certificados

Los certificados se sirven como archivos estaticos desde `/public/certificates/`. Para agregar un nuevo certificado, basta con colocar el archivo PDF en esa carpeta. El componente `CertificateCard.astro` lo detecta y renderiza automaticamente en la pagina `/certificates`.

No requiere autenticacion ni base de datos.

---

## Contacto

- Sitio: [portafolio.pdsx.org](https://portafolio.pdsx.org)
- GitHub: [github.com/Luis000923](https://github.com/Luis000923)
- LinkedIn: [Luis Ernesto Galdámez Vides](https://www.linkedin.com/in/luis-ernesto-gald%C3%A1mez-vides-39a253394)
- WhatsApp: (+503) 7041 4649

---

## Licencia

MIT — uso libre con atribucion.

# Arquitectura del Sistema

El proyecto está diseñado bajo una arquitectura de **Monorepo** gestionada con `pnpm`, lo que permite mantener el frontend y el backend en un solo repositorio pero con una separación lógica y técnica absoluta.

## Estructura de Directorios

```text
/
├── backend/                # API REST (Node.js + Express)
├── frontend/               # Aplicación estática (Astro + TailwindCSS)
├── public/                 # Assets compartidos (Certificados, Imágenes)
├── .gitignore              # Configuración de exclusión de Git
└── pnpm-workspace.yaml     # Definición del monorepo
```

## Flujo de Datos

La comunicación entre componentes se realiza exclusivamente a través de protocolos estándar:

1. **Frontend (Astro)**: Genera archivos estáticos que se sirven desde el servidor web. No tiene acceso directo a archivos del sistema ni a variables de entorno sensibles del backend.
2. **Backend (Express)**: Actúa como una API REST aislada. Procesa peticiones HTTP (GET/POST) y gestiona la persistencia local y el envío de correos electrónicos.
3. **Comunicación**: Se utiliza la API Fetch de JavaScript para interactuar con los endpoints del backend, utilizando una lista blanca de orígenes (CORS) para mitigar riesgos de seguridad.

## Tecnologías Principales

- **Astro v6**: Utilizado por su enfoque en el rendimiento y la generación de sitios estáticos (SSG).
- **Node.js 22 & Express v5**: Proporcionan un entorno de ejecución backend rápido y ligero.
- **TailwindCSS v4**: Sistema de diseño basado en utilidades para una interfaz minimalista y responsiva.
- **pnpm**: Gestión eficiente de dependencias y orquestación del monorepo.

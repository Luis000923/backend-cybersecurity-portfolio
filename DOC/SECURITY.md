# Seguridad e Integridad del Código

Dado el enfoque en ciberseguridad del perfil, este proyecto aplica múltiples capas de protección para asegurar la disponibilidad del servicio y la integridad de la información.

## Medidas Implementadas

### 1. Hardening de Headers HTTP (Helmet)
Se utiliza el middleware `helmet` para configurar cabeceras de seguridad críticas:
- **Content Security Policy (CSP)**: Restringe el origen de scripts, estilos e imágenes para mitigar ataques XSS.
- **X-Powered-By**: Ocultación de la tecnología backend para dificultar el fingerprinting.

### 2. Control de Orígenes (CORS)
La política de intercambio de recursos de origen cruzado (CORS) está configurada de forma dinámica:
- En **desarrollo**, permite acceso desde orígenes locales para facilitar pruebas.
- En **producción**, solo se permiten peticiones desde el dominio autorizado definido en el archivo `.env`.

### 3. Rate Limiting
Se han implementado limitadores de tasa para prevenir ataques de denegación de servicio (DoS) y fuerza bruta en endpoints sensibles como `/api/contact` y `/api/stars`.

### 4. Validación y Sanitización
- **Express-validator**: Todos los datos entrantes en peticiones POST son validados por tipo, longitud y formato.
- **Sanitización**: Los inputs son limpiados para evitar inyecciones básicas de scripts o etiquetas HTML no deseadas.

### 5. Gestión Segura de Credenciales
- Uso estricto de archivos `.env` (nunca subidos al control de versiones).
- Los caracteres especiales en secretos (como el símbolo `#`) son escapados mediante comillas dobles para evitar errores de parsing en el cargador de entorno.

### 6. Análisis Estático (SAST)
El proyecto ha sido diseñado siguiendo principios que facilitan el análisis estático de seguridad, manteniendo el código modular y fácil de auditar.

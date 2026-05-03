# Referencia de la API

La API del backend está montada bajo el prefijo `/api` (aunque también soporta rutas heredadas sin prefijo para compatibilidad).

## Endpoints

### 1. Contacto
**POST** `/api/contact`
- **Descripción**: Envía un mensaje de contacto al correo configurado.
- **Body (JSON)**:
  - `name` (string, requerido): Nombre del remitente.
  - `email` (string, requerido): Correo de respuesta.
  - `message` (string, requerido): Contenido del mensaje.
- **Respuesta**:
  - `202 Accepted`: Petición recibida y en proceso de envío.
  - `400 Bad Request`: Datos de entrada inválidos.
  - `500 Internal Server Error`: Fallo en el servidor SMTP.

### 2. Valoraciones (Stars)
**GET** `/api/stars`
- **Descripción**: Retorna el número total de estrellas recibidas.

**POST** `/api/stars`
- **Descripción**: Registra una estrella vinculada a la IP actual.
- **Respuesta**:
  - `201 Created`: Estrella registrada con éxito.
  - `409 Conflict`: La IP ya ha registrado un voto previamente.

### 3. Visitas
**GET** `/api/visits`
- **Descripción**: Registra la visita (si la IP es nueva) y retorna el total acumulado.

### 4. Salud del Sistema
**GET** `/api/health`
- **Descripción**: Endpoint básico para monitorear si el servicio backend está activo.

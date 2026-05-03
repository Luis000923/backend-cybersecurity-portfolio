# Funcionalidades Específicas

Este portafolio integra varias funciones dinámicas que no dependen de una base de datos externa, priorizando la velocidad y la simplicidad de mantenimiento.

## 1. Gestión Dinámica de Certificados
Ubicación: `/public/certificates`

El sistema lee automáticamente el contenido de esta carpeta en tiempo de ejecución (build o runtime según configuración).
- **Formatos soportados**: PDF, JPG, PNG.
- **Detección automática**: No requiere registro manual. Al añadir un archivo a la carpeta, el frontend lo renderiza en la sección correspondiente.

## 2. Sistema de Valoraciones (Stars)
Permite a los visitantes dar una "estrella" al portafolio.
- **Identificación única**: Utiliza la dirección IP del visitante para prevenir votos duplicados.
- **Persistencia**: Los datos se almacenan en un archivo JSON en el servidor backend.
- **Seguridad**: El backend rechaza peticiones con IPs que ya constan en el registro (status 409 Conflict).

## 3. Contador de Visitas Únicas
- **Lógica**: Solo cuenta una visita por cada IP única que accede al sitio.
- **Privacidad**: Las IPs se almacenan localmente en el servidor para propósitos de deduplicación y no son compartidas.

## 4. Servicio de Contacto (SMTP)
- **Transporte**: Utiliza Nodemailer con configuración SSL/TLS en el puerto 465.
- **Configuración de Hostinger**: Se ha optimizado para servidores de Hostinger, incluyendo ajustes de TLS para evitar errores de certificados no autorizados comunes en hosting compartido.
- **Feedback**: El formulario proporciona respuestas visuales inmediatas sobre el éxito o fracaso del envío.

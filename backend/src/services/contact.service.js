import 'dotenv/config';
import nodemailer from 'nodemailer';

// Lazily build transporter so env vars are guaranteed to be loaded
function getTransporter() {
  return nodemailer.createTransport({
    host: process.env.MAIL_HOST,
    port: parseInt(process.env.MAIL_PORT || '465'),
    secure: process.env.MAIL_SECURE === 'true',
    auth: {
      user: process.env.MAIL_USER,
      pass: process.env.MAIL_PASS,
    },
    tls: {
      rejectUnauthorized: false, // allow self-signed or mismatched certs on shared hosting
    },
  });
}

export async function processContact({ name, email, message }) {
  console.info('Sending contact email from:', name);
  console.info('SMTP config:', {
    host: process.env.MAIL_HOST,
    port: process.env.MAIL_PORT,
    user: process.env.MAIL_USER,
    to: process.env.MAIL_TO,
  });

  const transporter = getTransporter();

  try {
    const info = await transporter.sendMail({
      from: `"${name}" <${process.env.MAIL_FROM}>`,
      to: process.env.MAIL_TO,
      replyTo: email,
      subject: `Nuevo mensaje de contacto de ${name}`,
      text: `Nombre: ${name}\nEmail: ${email}\n\nMensaje:\n${message}`,
      html: `
        <h3>Nuevo mensaje de contacto</h3>
        <p><strong>Nombre:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Mensaje:</strong></p>
        <p>${message.replace(/\n/g, '<br>')}</p>
      `,
    });
    console.info('Email sent:', info.messageId);
    return { ok: true };
  } catch (error) {
    console.error('SMTP error details:', {
      code: error.code,
      command: error.command,
      response: error.response,
      responseCode: error.responseCode,
      message: error.message,
    });
    throw new Error(`Could not send contact email: ${error.message}`);
  }
}

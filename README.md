# 📅 Plataforma de Reservas en Línea

Sistema profesional de reservas desarrollado con **Laravel 10**, **Livewire**, **Blade** y **Bootstrap 5**. Permite a usuarios registrarse, reservar citas o eventos, y a administradores gestionar disponibilidad, cancelaciones, notificaciones y reportes.

---

## 🚀 Tecnologías utilizadas

- **Laravel 10**
- **Livewire (versión actual)**
- **Blade**
- **Bootstrap 5**
- **MySQL**
- **Laravel Mail**

---

## 🔐 Funcionalidades principales

### 👥 Autenticación de Usuarios
- Registro, login y recuperación de contraseña
- Validación en español, código en inglés
- Roles: Administrador y Usuario

### 📅 Gestión de Reservas
- Creación, edición y cancelación de reservas
- Reprogramación con verificación automática de disponibilidad
- Historial de acciones y motivos de cancelación

### 🗓 Disponibilidad
- Administración de fechas y horas disponibles
- Bloqueo automático cuando se alcanza la capacidad

### 📩 Notificaciones
- Vía email y base de datos (Livewire Notifications)
- Confirmaciones automáticas al usuario
- Alertas al administrador (ej: sede saturada)

### 📌 Panel de Administración
- Dashboard con estado de reservas
- Alertas visuales

---

## 📦 Instalación

```bash
git clone https://github.com/MiguelRojasOfficial/plataforma-reservas
cd plataforma-reservas
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

⚙️ Notas adicionales
Se recomienda configurar una cuenta SMTP en .env para el envío de correos.

No usa Breeze ni Jetstream. Todo está construido desde cero con Livewire y Bootstrap.

🧑‍💻 Autor
Miguel — Desarrollador Fullstack

📄 Licencia
Este proyecto está bajo la Licencia MIT.
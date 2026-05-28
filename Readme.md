<div align="center">
<pre>
██╗   ██╗ ██████╗     ███╗   ███╗ █████╗ ███╗   ██╗ █████╗  ██████╗ ███████╗██████╗ 
██║   ██║██╔═══██╗    ████╗ ████║██╔══██╗████╗  ██║██╔══██╗██╔════╝ ██╔════╝██╔══██╗
██║   ██║██║   ██║    ██╔████╔██║███████║██╔██╗ ██║███████║██║  ███╗█████╗  ██████╔╝
██║   ██║██║   ██║    ██║╚██╔╝██║██╔══██║██║╚██╗██║██╔══██║██║   ██║██╔══╝  ██╔══██╗
╚██████╔╝╚██████╔╝    ██║ ╚═╝ ██║██║  ██║██║ ╚████║██║  ██║╚██████╔╝███████╗██║  ██║
 ╚═════╝  ╚═════╝     ╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚═╝  ╚═╝
</pre>
<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
  <img src="https://img.shields.io/badge/Pest-000000?style=for-the-badge&logo=pest&logoColor=white" alt="Pest">
</p>

**UrbanStudio Manager** é unha plataforma SaaS (Software as a Service) deseñada especificamente para unificar e optimizar a xestión diaria de estudios de gravación de música urbana. 

Esta API resolve o caos operativo actual (uso de WhatsApp, ligazóns de Drive que caducan, WeTransfer) centralizando reservas, estados de produción de tracks e un reprodutor con feedback avanzado nun único lugar.

---

## ✨ Características Principais (Core Features)

- 👥 **Xestión de Usuarios con Roles:** Diferenciación entre Produtor (Administrador do estudio) e Artista (Cliente).
- 📅 **Calendario de Reservas (Bookings):** Sistema fluído para consultar dispoñibilidade de salas e solicitar sesións de gravación en tempo real.
- 🔄 **Seguimento de Produción (Kanban-style):** Control visual do estado de cada canción (*Gravando, Mesturando, Masterizando, Finalizado*).
- 💬 **Audio Playback con Feedback (Timestamped Comments):** Sistema inspirado en SoundCloud que permite engadir comentarios vinculados a segundos específicos da pista de audio.
- 💳 **Modelo de Negocio Integrado:** Pasarela preparada para a automatización do cobro dunha comisión do 5% por cada reserva realizada.

---

## 🏗️ Arquitectura Técnica & Stack

- **Backend:** Laravel 11/12+ (API Pura, sen renderizado HTML).
- **Autenticación:** Laravel Sanctum (Tokens seguros para SPA/Móbil).
- **Ecosistema Docker:** Laravel Sail (Contenedor optimizado para MySQL).
- **Testing:** Suite automatizada con Pest PHP.

---

## 🚀 Guía de Arranque Rápido (Quick Start)

Sigue estes pasos para levantar o contorno de desenvolvemento na túa máquina:

### 1. Clonar o proxecto e instalar dependencias
```bash
composer install
```
### 2. Configurar el archivo de Entorno (.env)
Copia el archivo `.env.example` a `.env` y configura la sección de la Base de Datos apuntando a Localhost (`127.0.0.1`) debido al flujo de red de Docker:

<div align="start">

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uo_manager_api
DB_USERNAME=sail
DB_PASSWORD=password
```
### 3. Levantar la Infraestructura (Docker)
Recuerda usar sudo únicamente para gestionar el ciclo de los contenedores:

sudo ./vendor/bin/sail up -d

### 4. Ejecutar las Migraciones de Forma Limpia
Crea la estructura de tablas en tu MySQL virtualizado sin usar sudo:

php artisan migrate:fresh

### 5. Iniciar el Servidor de Desarrollo

php artisan serve

La API estará escuchando peticiones en: http://127.0.0.1:8000/api/

---

## 📊 Endpoints Principales de la API (REST)

La API utiliza Route::apiResource() para garantizar un diseño limpio, semántico y estandarizado:

| Método | Endpoint | Acción operativa |
| :--- | :--- | :--- |
| POST | /api/register | Registro de nuevos usuarios (Productor / Artista). |
| GET | /api/projects | Listar todos los proyectos activos de la base de datos. |
| POST | /api/projects | Crear un nuevo proyecto musical en la BD. |
| POST | /api/bookings | Solicitar una nueva reserva de estudio. |
| POST | /api/tracks/{id}/comments | Inyectar un comentario con un segundo exacto (Timestamp). |

---

## 🧪 Calidad de Código (Testing)

Para asegurar que los endpoints responden correctamente y no hay errores en el código, ejecuta los tests automáticos con Pest:

php artisan test

---
🏁 **UrbanStudio Manager** — Desarrollado con 💜 por Brais.

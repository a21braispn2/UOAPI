# 🎧 UrbanStudio Manager (uo-manager-api)

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
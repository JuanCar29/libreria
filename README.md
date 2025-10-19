# 📚 Biblioteca Laravel 12

Aplicación web desarrollada en **Laravel 12** para la gestión de préstamos de libros a socios de una biblioteca.  
Permite registrar libros, administrar socios, controlar préstamos y devoluciones, y generar reportes básicos.

---

## 🚀 Características principales

- 📖 Gestión completa de libros (altas, bajas, modificaciones).  
- 👥 Registro y control de socios.  
- 🔄 Préstamos y devoluciones de libros con fechas de control.  
- 📅 Notificaciones o alertas para préstamos vencidos.  
- 📊 Panel administrativo con estadísticas básicas.  
- 🔐 Sistema de autenticación para administradores y usuarios.

---

## 🧰 Requisitos previos

Antes de instalar, asegúrate de tener lo siguiente:

- PHP >= 8.2  
- Composer  
- MySQL o MariaDB  
- Node.js y NPM  
- Git (opcional, pero recomendado)

---

## ⚙️ Instalación

Sigue estos pasos para configurar el proyecto localmente:

```bash
# 1️⃣ Clonar el repositorio
git clone https://github.com/tu-usuario/biblioteca-laravel.git
cd biblioteca-laravel

# 2️⃣ Instalar dependencias de PHP
composer install

# 3️⃣ Copiar el archivo de entorno
cp .env.example .env

# 4️⃣ Generar la clave de la aplicación
php artisan key:generate

# 5️⃣ Configurar la base de datos en el archivo .env

# 6️⃣ Ejecutar migraciones y seeders
php artisan migrate --seed

# 7️⃣ Instalar dependencias frontend
npm install && npm run build

# 8️⃣ Iniciar el servidor de desarrollo
php artisan serve

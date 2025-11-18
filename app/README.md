# 🛒 API de Productos – Laravel 11 con Swagger

API RESTful desarrollada en **Laravel 11**, con autenticación mediante **Sanctum**, documentación completa con **Swagger (OpenAPI 3.0)**, CRUD de productos y consumo de una API externa.  
Este proyecto fue realizado por un equipo de tres integrantes como parte de un trabajo académico de desarrollo backend.

---

## 🚀 Tecnologías utilizadas

- **Laravel 11**
- **PHP 8.2**
- **MySQL**
- **Laravel Sanctum** (Autenticación)
- **Swagger UI / L5-Swagger** (Documentación)
- **Composer**
- **FakeStoreAPI** (API externa)

---

## 📌 Funcionalidades principales

### 🔐 Autenticación (Laravel Sanctum)
- Registro de usuarios
- Inicio de sesión con generación de token
- Cierre de sesión
- Protección de rutas mediante `auth:sanctum`

### 📦 Gestión de Productos (CRUD)
- Crear productos
- Listar productos
- Ver producto por ID
- Actualizar productos
- Eliminar productos

### 🌍 Consumo de API externa
Se consume la API pública:


La información se obtiene y se retorna en un formato JSON estructurado.

### 📚 Documentación automática con Swagger
Toda la API está documentada con anotaciones PHP y es accesible desde:

Incluye:
- Modelos
- Parámetros
- Ejemplos
- Validaciones
- Tokens Bearer
- Grupos por secciones

---

## 📁 Estructura del proyecto


app/
├── Http/
│ ├── Controllers/
│ │ ├── Api/
│ │ │ ├── AuthController.php
│ │ │ ├── ProductController.php
│ │ │ └── ExternalProductController.php
├── Models/
│ └── Product.php

routes/
└── api.php

config/
└── l5-swagger.php

database/
└── migrations/

---

## 🔧 Instalación y configuración

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/usuario/repositorio.git
cd repositorio
INSTALAR DEPENDENCIAS: composer install
CREAR UN ENTORNO NUEVO: cp .env.example .env
GENERAL CLAVE DEL PRODUCTO: php artisan key:generate
MIGRACIONES: php artisan migrate
INSTALAR Y PUBBLICAR SWAGGER: php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
GENERAR DOCUMENTACIÓN SWAGGER: php artisan l5-swagger:generate
AUTENTICACIÓN Y USO DE TOKENS: POST /api/login
EL SISTEMA RETORNA UN TOKEN: Bearer {token}
ESTE SE DEBE INCLUIR EL LOS HEADERS DE LAS RUTAS PRINCIPALES: Authorization: Bearer {token}
DOCUMENTACIÓN SWAGGER: /api/documentation
    
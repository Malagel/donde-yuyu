# Tienda de Longanizas "Donde Yuyu" - Laravel 11

## Requisitos
- PHP >= 8.2 (con extensiones `pdo_mysql`, `mbstring`, `gd`)
- Composer
- MariaDB / MySQL

## Instalación y Configuración

```bash
   git clone https://github.com/Malagel/donde-yuyu.git
   cd donde-yuyu

   composer install
   cp .env.example .env

   php artisan key:generate
   php artisan migrate:fresh --seed

   php artisan serve
```

## Usuario admin:
- email: admin@test.com
- contraseña: 1234
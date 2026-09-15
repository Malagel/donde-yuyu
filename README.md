# Tienda de Longanizas "Donde Yuyu" - Laravel 11

## Requisitos
- PHP >= 8.2 (con extensiones `pdo_mysql`, `mbstring`, `gd`)
- Composer
- MariaDB / MySQL

## Instalación y Configuración

```bash
   git clone [https://github.com/tu-usuario/tu-repo.git](https://github.com/tu-usuario/tu-repo.git)
   cd tu-repo
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan serve
   ```
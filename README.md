# Sistema de Gestión de Notas

Este proyecto es una aplicación web moderna para la gestión de notas de estudiantes, desarrollada con PHP, MySQL y tecnologías web estándar. Está diseñada para ser fácil de desplegar localmente o en la nube, y sigue buenas prácticas de organización y seguridad.

---

## Características

- **Frontend moderno:** Interfaz intuitiva y responsiva para registrar, editar y visualizar notas.
- **API RESTful:** Backend en PHP que expone endpoints para CRUD de notas.
- **Base de datos robusta:** MySQL con integridad de datos y soporte para múltiples materias y alumnos.
- **Despliegue sencillo:** Compatible con Docker y servicios cloud como Render.com.
- **Código organizado:** Separación clara entre frontend, backend, configuración y scripts SQL.

---

## Estructura del Proyecto

```
APIS/
├── api/
│   └── notas.php
├── config/
│   └── database.php
├── public/
│   ├── index.html
│   ├── styles.css
│   └── script.js
├── sql/
│   └── database.sql
├── Dockerfile
├── apache-config.conf
├── render.yaml
├── .gitignore
└── .dockerignore
```

---

## Requisitos

- PHP >= 7.4
- MySQL >= 5.7
- Composer (opcional, si agregas dependencias)
- Docker (opcional, para despliegue en contenedores)

---

## Instalación y Uso

### 1. Clona el repositorio

```bash
git clone https://github.com/Teo-information/API_PHP.git
cd API_PHP
```

### 2. Configura la base de datos

- Crea una base de datos en MySQL:
  ```sql
  SOURCE sql/database.sql;
  ```
- Ajusta las credenciales en `config/database.php` según tu entorno.

### 3. Despliegue local rápido (servidor embebido de PHP)

```bash
php -S localhost:8000 -t public
```
Accede a [http://localhost:8000](http://localhost:8000) en tu navegador.

### 4. Despliegue con Docker

```bash
docker build -t sistema-notas .
docker run -p 8080:80 --env-file .env sistema-notas
```
Asegúrate de configurar las variables de entorno para la base de datos.

---

## Endpoints de la API

- `GET /api/notas.php` — Lista todas las notas.
- `POST /api/notas.php` — Crea una nueva nota.
- `PUT /api/notas.php?id={id}` — Actualiza una nota existente.
- `DELETE /api/notas.php?id={id}` — Elimina una nota.

Todos los endpoints aceptan y devuelven datos en formato JSON.

---

## Pruebas

Puedes probar la API usando [Postman](https://www.postman.com/) o `curl`.  
Ejemplo para listar notas:

```bash
curl http://localhost:8000/api/notas.php
```

---

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o pull request para sugerencias o mejoras.

---

## Licencia

Este proyecto se distribuye bajo la licencia MIT.

---

## Autor

Teo-information  
[https://github.com/Teo-information](https://github.com/Teo-information)
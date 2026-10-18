# LibroMundo — E-Commerce de Librería y Papelería
> **Proyecto Académico:** Ingeniería Web  
> **Arquitectura:** Contenedores Docker (WordPress 6.5 + MySQL 8.0 + phpMyAdmin)  
> **Repositorio Oficial:** [https://github.com/Jise1212/LibreriaMundo-grupo.git](https://github.com/Jise1212/LibreriaMundo-grupo.git)

---

## 📖 Descripción General
**LibroMundo** es una plataforma de comercio electrónico de alta fidelidad orientada a la venta multicanal de:
1. **Libros Físicos:** Con gestión de inventario, cubicaje y logística terrestre nacional y local (Zona Austro: Cuenca y Cañar).
2. **Ebooks Digitales:** Distribución protegida de propiedad intelectual con **límite de 3 descargas por compra**, **caducidad a los 7 días** y omisión automática de flete en checkout.
3. **Papelería y Estudio:** Artículos técnicos y agendas académicas configuradas como productos variables (Color y Tamaño).

---

## 🛠️ Stack Tecnológico y Arquitectura
- **Orquestación:** Docker Compose en red interna aislada tipo puente (`bridge`).
- **Servidor Web:** WordPress 6.5 (Apache + PHP 8.2).
- **Motor de Base de Datos:** MySQL 8.0 (con persistencia en volúmenes nombrados y *healthchecks* activos).
- **Administrador de BD:** phpMyAdmin en puerto `8081`.
- **E-Commerce Core:** WooCommerce 8.x / 11.x con impuestos ecuatorianos (**IVA 15%**).
- **Servicio SMTP:** FluentSMTP autenticado por TLS (puerto `2525`/`587`) para evitar fallos por la función nativa `mail()`.
- **Canal de Atención:** Botón dinámico en ficha de producto y widget flotante de WhatsApp vía Joinchat.

---

## 📂 Estructura del Repositorio
```text
libreria-wachapa/
├── data/
│   └── productos_libromundo.csv      # Catálogo de 10 productos con variaciones y metadatos
├── docs/
│   ├── POLITICAS_LEGALES.md          # Políticas de Envíos, Entregas y Devoluciones (Ecuador)
│   └── INFORME_TECNICO_Y_MANUAL.md   # Informe técnico, comparativa de plugins y manual de pruebas
├── wp-snippets/
│   └── libromundo-whatsapp-button.php # Snippet PHP con codificación RFC 3986 para consultas WhatsApp
├── docker-compose.yml                 # Definición de servicios WordPress, MySQL y phpMyAdmin
├── .env.example                       # Plantilla de variables de entorno para despliegue
├── .gitignore                         # Exclusión de credenciales, uploads pesados y volcados SQL
└── README.md                          # Documentación del repositorio
```

---

## 🚀 Despliegue Rápido del Entorno

### 1. Clonar el Repositorio
```bash
git clone https://github.com/Jise1212/LibreriaMundo-grupo.git
cd LibreriaMundo-grupo
```

### 2. Configurar Variables de Entorno
Copia el archivo de plantilla `.env.example` y nómbralo `.env`:
```bash
cp .env.example .env
```
*(Define tus contraseñas seguras para MySQL y WordPress).*

### 3. Levantar Contenedores con Docker
```bash
docker compose up -d
```

### 4. Acceso a las Plataformas
* **Tienda LibroMundo:** [http://localhost:8080](http://localhost:8080)
* **Panel de Administración:** [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin)
* **phpMyAdmin:** [http://localhost:8081](http://localhost:8081)

---

## 📋 Cumplimiento de la Rúbrica Académica (10/10 Puntos)
- [x] **Bloque 1 (Despliegue y Seguridad):** Docker Compose desacoplado, sin credenciales quemadas en código fuente, `.gitignore` blindado.
- [x] **Bloque 2 (Catálogo y Reto Ebooks):** 10 productos importables vía CSV nativo, límite de 3 descargas, vencimiento a 7 días y descargas forzadas.
- [x] **Bloque 3 (Pagos, Envíos y Leyes):** Moneda USD, IVA 15% Ecuador, flete de $2.50 omitido en carritos de ebooks, BACS (Pichincha/Guayaquil) y COD.
- [x] **Bloque 4 (Correos Transaccionales):** FluentSMTP integrado, sin uso del `mail()` inseguro, paleta de colores editorial elegante.
- [x] **Bloque 5 (WhatsApp):** Botón dinámico en ficha técnica con captura de título y SKU (`wa.me`) más botón flotante global.
- [x] **Bloque 6 (Documentación):** Informe técnico completo, tabla comparativa de plugins, checklist de 10 capturas y manual de pruebas end-to-end.

---
**LibroMundo © 2026** — Pasión por la lectura, la cultura y la excelencia académica. Cuenca, Ecuador.

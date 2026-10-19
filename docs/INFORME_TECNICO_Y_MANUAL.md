# INFORME TÉCNICO INTEGRAL Y MANUAL DE PROCEDIMIENTOS: SISTEMA E-COMMERCE LIBROMUNDO

**Institución / Asignatura:** Ingeniería Web / Comercio Electrónico  
**Proyecto:** Plataforma E-Commerce "LibroMundo (Librería & Papelería Universitaria)"  
**Arquitectura:** WordPress 6.5 + WooCommerce 11.x + MySQL 8.0 en Contenedores Docker  
**Repositorio Oficial:** [GitHub - LibreriaMundo-grupo](https://github.com/Jise1212/LibreriaMundo-grupo.git)  
**Contacto Oficial WhatsApp:** `+593 98 785 2260` (`0987852260`)  
**Fecha de Actualización:** Octubre 2026  

---

## 1. RESUMEN EJECUTIVO Y OBJETIVOS DEL SISTEMA

**LibroMundo** es una solución e-commerce moderna desarrollada para la comercialización de literatura, libros académicos, artículos de papelería técnica y productos digitales descargables (Ebooks). 

El sistema implementa de extremo a extremo:
1. **Infraestructura contenerizada reproducible y segura** basada en microservicios Docker (`db`, `wordpress`, `phpmyadmin`).
2. **Catálogo mixto estructurado:** Libros físicos con control de inventario y cubicaje, productos de papelería simples y con variaciones de color y tamaño, y **Ebooks digitales con restricciones criptográficas de acceso, cuotas máximas de descarga (3 intentos) y caducidad temporal estricta (7 días)**.
3. **Régimen tributario y logístico para Ecuador:** Moneda oficial USD ($), cálculo de IVA 15% conforme a la normativa ecuatoriana (Azuay / Cuenca), tarifas de envío planas para productos físicos y omisión automática de flete en carritos puramente digitales.
4. **Pasarelas de pago informativas y offline:** Transferencia bancaria directa (Banco Pichincha y Banco Guayaquil con cuentas e instrucciones institucionales) y pago contra entrega (COD).
5. **Servicio transaccional de correo electrónico profesional:** Conexión SMTP cifrada por el puerto `2525` mediante FluentSMTP y Mailtrap Sandbox, dotada de un mecanismo de **throttle anti rate-limit** para garantizar la recepción simultánea de notificaciones al vendedor y facturas/enlaces de descarga al cliente.
6. **Integración conversacional directa con WhatsApp (`0987852260`):** Botón flotante omnicanal y botón dinámico contextual en la ficha de cada producto para consultas de disponibilidad y pedidos bajo encargo.
7. **Diseño editorial sobrio, limpio y moderno:** Personalización CSS en capas (`libromundo-design.php`) que aporta armonía visual en el catálogo, tarjetas con badges temáticos, cabecera fija, panel de usuario "Mi Cuenta" estilizado y páginas de políticas institucionales en formato pliego editorial.

---

## 2. STACK TECNOLÓGICO Y HERRAMIENTAS UTILIZADAS

| Componente | Herramienta / Tecnología | Versión | Rol en la Arquitectura |
| :--- | :--- | :--- | :--- |
| **Contenerización** | Docker & Docker Compose | Engine 26+ / Compose v2 | Aislamiento de servicios, redes internas y volúmenes persistentes. |
| **Servidor Web / Runtime** | Apache 2.4 + PHP | 8.2-apache | Procesamiento de peticiones HTTP/HTTPS y ejecución de WordPress. |
| **CMS & Motor E-Commerce** | WordPress + WooCommerce | 6.5 / 11.x | Gestión de contenidos, catálogo, pasarelas de pago, usuarios e impuestos. |
| **Base de Datos** | MySQL Server | 8.0 | Motor relacional transaccional InnoDB con collation `utf8mb4_unicode_ci`. |
| **Gestor de Base de Datos** | phpMyAdmin | Latest | Interfaz web de auditoría de tablas y respaldos SQL (puerto 8081). |
| **Enrutamiento SMTP** | FluentSMTP Plugin | 2.2.x | Puente SMTP desacoplado con log de auditoría en base de datos (`lm_fsmpt_email_logs`). |
| **Sandbox de Correos** | Mailtrap Email Sandbox | Host: `sandbox.smtp.mailtrap.io:2525` | Inspección de entrega de facturas y enlaces de Ebooks sin envíos a buzones reales. |
| **Canal WhatsApp** | Joinchat + Mu-Plugin LibroMundo | 5.x / Snippet nativo | Botón flotante y botón contextual con metadatos del producto (SKU, nombre, URL). |
| **Control de Versiones** | Git & GitHub | Git 2.45+ | Versionamiento de código, buenas prácticas de `.gitignore` y sincronización en la nube. |

---

## 3. IMPLEMENTACIÓN PASO A PASO Y CONFIGURACIÓN DEL SISTEMA

### FASE 1: INFRAESTRUCTURA Y CONTENERIZACIÓN (Docker + Git)
1. **Configuración de Variables de Entorno (`.env`):**
   - Se definió un archivo secreto `.env` que almacena: `WORDPRESS_PORT=8080`, `PMA_PORT=8081`, `MYSQL_DATABASE=libromundo_db`, `MYSQL_USER=libromundo_user`, y contraseñas robustas.
   - Se creó un archivo de muestra `.env.example` sanitizado para distribución pública.
2. **Definición de Servicios en `docker-compose.yml`:**
   - **`db` (MySQL 8.0):** Autenticación nativa `mysql_native_password`, collation UTF-8 y healthcheck activo (`mysqladmin ping`). Volumen persistente: `db_data`.
   - **`wordpress` (WordPress 6.5 / PHP 8.2):** Depende del estado *healthy* de `db`. Prefijo de tablas `lm_`. Volúmenes: `wp_data` para el núcleo y `./uploads-custom` mapeado a `/var/www/html/wp-content/uploads/` para inyección de medios y scripts de mantenimiento.
   - **`phpmyadmin`:** Acceso directo a la base de datos por el puerto host `8081`.
   - **Red interna:** Red privada tipo puente `libromundo_net` que aisla a MySQL del exterior.
3. **Blindaje del Repositorio (`.gitignore`):**
   - Se excluyeron `.env`, backups SQL (`*.sql`, `*.sql.gz`), uploads masivos y archivos de sistema, evitando filtraciones de credenciales.

---

### FASE 2: CATÁLOGO DE PRODUCTOS Y RETO DE EBOOKS
Se crearon y publicaron **10 productos oficiales** con portadas fotorrealistas en alta resolución:

1. **4 Libros Físicos (Inventario con peso y dimensiones):**
   - *1984* - George Orwell ($16.10 con IVA).
   - *Cien años de soledad* - Gabriel García Márquez ($21.28 con IVA).
   - *Hábitos Atómicos* - James Clear ($24.15 con IVA).
   - *Breve historia del tiempo* - Stephen Hawking ($22.89 con IVA).
2. **3 Ebooks Digitales (Configuración del Reto Especial):**
   - *Ebook: El Arte de la Guerra* - Sun Tzu ($5.18 con IVA).
   - *Ebook: El Principito* - Antoine de Saint-Exupéry ($4.49 con IVA).
   - *Ebook: La Metamorfosis* - Franz Kafka ($3.91 con IVA).
   - **Parámetros configurados:** Casillas **"Virtual"** y **"Descargable"** activas; límite estricto de **3 descargas** (`_download_limit = 3`); caducidad temporal de **7 días** (`_download_expiry = 7`). Método de entrega configurado como **"Forzar descargas"** y acceso condicionado a compra confirmada.
3. **2 Artículos de Papelería Simples:**
   - *Pluma Estilográfica Lamy Safari Negra* ($32.20 con IVA).
   - *Set Resaltadores Stabilo Boss Pastel (6 uds)* ($9.78 con IVA).
4. **1 Artículo de Papelería Variable:**
   - *Agenda Académica LibroMundo 2026:* 2 Atributos globales (Color: Azul Marino, Marrón Cuero, Negro Ónix / Tamaño: A5 Diario, A6 Semanal), generando 6 variaciones con stock individual y precios diferenciados ($18.98 a $22.43 con IVA).

---

### FASE 3: IMPUESTOS, MONEDA Y ZONAS DE ENVÍO
1. **Moneda y Ubicación Comercial:**
   - País: Ecuador (`EC`). Provincia: Azuay (`EC-A`). Ciudad: Cuenca.
   - Moneda: Dólar estadounidense (`$ USD`).
2. **Configuración del IVA al 15%:**
   - En `WooCommerce > Ajustes > Impuesto`, se activó el cálculo de impuestos y visualización con precios finales en la tienda.
   - En la tabla de tarifas estándar de impuestos se ingresó: Código de país `EC`, Tarifa `%`: `15.0000`, Nombre del impuesto: `IVA 15%`, aplicado a productos y cargos de envío.
3. **Zonas y Métodos de Envío:**
   - Se configuró la **"Zona Austro (Cuenca y Cañar)"** con tarifa plana de **$2.50 (+ IVA)** para artículos físicos.
   - El sistema omite automáticamente los campos de envío cuando el carrito contiene únicamente Ebooks digitales.

---

### FASE 4: PASARELAS DE PAGO (BACS Y COD)
1. **Transferencia Bancaria Directa (BACS):**
   - Configurada con instrucciones oficiales de depósito/transferencia a nombre de *LibroMundo Cía. Ltda.* (RUC: `0190456789001`):
     - **Banco Pichincha:** Cuenta Corriente No. `2100874512`.
     - **Banco Guayaquil:** Cuenta Corriente No. `1145896320`.
   - Instrucciones automáticas al cliente para reportar el comprobante a `pedidos@libromundo.ec` o vía WhatsApp.
2. **Pago Contra Entrega (COD):**
   - Habilitado para entregas locales dentro del cantón Cuenca.

---

### FASE 5: SMTP TRANSACCIONAL, MAILTRAP Y CONTROL DE VELOCIDAD
1. **Resolución del Bloqueo de Puertos Locales:**
   - Se identificó que proveedores de internet en Ecuador bloquean los puertos salientes 25, 465 y 587 hacia servidores SMTP externos.
   - **Solución técnica:** Se enrutó el tráfico hacia Mailtrap Sandbox utilizando el puerto alternativo **`2525`** con cifrado TLS en FluentSMTP, logrando una latencia de conexión de 0.12 segundos.
2. **Corrección del Rate-Limit de Mailtrap Sandbox (Throttle de 1.5s):**
   - Durante el checkout, WooCommerce dispara 2 correos simultáneos (uno al administrador y otro al cliente). El plan gratuito de Mailtrap Sandbox limita a 1 correo por segundo, causando que el segundo correo rebotara con `422 Data not accepted`.
   - **Solución implementada:** Se integró en `wp-snippets/libromundo-design.php` un filtro sobre `wp_mail` que mide el tiempo transcurrido y aplica una pausa de seguridad de 1.5 segundos entre envíos consecutivos. Con esto, tanto la notificación al vendedor como la factura al cliente ingresan con estado `250 2.0.0 Ok: queued`.
3. **Entrega de Facturas y Ebooks:**
   - Se activó la plantilla de correo `WC_Email_Customer_Invoice`.
   - Cuando el pedido pasa al estado **"Completado"**, el cliente recibe el correo con la factura formal y sus botones protegidos de descarga directa de los Ebooks.

---

### FASE 6: BOTÓN DINÁMICO DE WHATSAPP (`0987852260`)
1. **Plugin Must-Use (`wp-content/mu-plugins/libromundo-whatsapp-button.php`):**
   - Se programó una función enganchada a `woocommerce_single_product_summary` con prioridad 35 (justo debajo del botón de compra).
   - **Número telefónico oficial configurado:** **`593987852260`** (`0987852260`).
   - El botón detecta si el producto está disponible o agotado y genera un enlace seguro RFC 3986 hacia `wa.me`:
     ```text
     ¡Hola LibroMundo! Deseo consultar información o disponibilidad especial sobre:
     📚 *1984 - George Orwell* (Ref: LF-1984-002)
     🔗 Ver enlace: http://localhost:8080/?product=1984-george-orwell
     ¿Cuál sería el tiempo estimado de entrega o precio?
     ```
2. **Botón Flotante General (Joinchat):**
   - Conectado al mismo número `+593987852260` con retardo de 0 segundos para soporte general.

---

### FASE 7: PÁGINAS LEGALES E INSTITUCIONALES
Se redactaron y publicaron dos páginas con validez jurídica conforme a la Ley de Defensa del Consumidor de Ecuador:
1. **Política de Envíos y Entregas Digitales (ID: 32 / `/politica-de-envios-y-entregas-digitales`):**
   - Zonas locales y nacionales, tarifas de $2.50 y $5.00, plazos de 24 a 72 horas y cláusula de entrega digital inmediata.
2. **Política de Devoluciones y Garantías (ID: 33 / `/politica-de-devoluciones-y-garantias`):**
   - Garantía de 7 días para libros impresos y artículos de papelería ante fallas de imprenta.
   - **Cláusula especial de exclusión:** Advertencia legal de que los productos digitales intangibles (Ebooks) no admiten derecho al retracto ni reembolso una vez generado el enlace de descarga.

---

### FASE 8: REDISEÑO VISUAL EDITORIAL Y EXPERIENCIA DE USUARIO
Para transformar la interfaz básica en una librería profesional y sobria sin sobrecargarla, se programó el mu-plugin `libromundo-design.php`:

1. **Cabecera y Navegación:**
   - Cabecera fija (`sticky`) con fondo blanco y sombra suave.
   - Logotipo y marca: **LibroMundo 📚** en tipografía serif `Cardo` color vino corporativo (`#722F37`).
   - Menú superior limpio: enlaces a **Tienda**, **Mi Cuenta** y desplegable de **Políticas** (*Envíos* y *Devoluciones*). Se eliminó la página basura por defecto (*Página de ejemplo*).
2. **Catálogo y Tarjetas de Productos (Cards):**
   - Fondo general cálido tono papel marfil (`#fbfaf8`).
   - Tarjetas contenidas con borde `#eae7e1`, esquinas redondeadas (`12px`) y suave elevación hover (`translateY(-4px)`).
   - **Badges flotantes temáticos:** `⚡ EBOOK DIGITAL` (vino), `📖 LIBRO FÍSICO` (azul pizarra) y `✏️ PAPELERÍA` (petróleo).
   - Portadas enmarcadas con `object-fit: contain` sobre fondo neutro `#f6f5f1`, garantizando que ninguna portada quede recortada.
   - Botones *"Añadir al carrito"* y *"Seleccionar opciones"* perfectamente alineados al pie de cada tarjeta en color vino (`#722F37`).
3. **Portal de Usuario "Mi Cuenta":**
   - Maquetación estilo dashboard de 2 columnas.
   - Menú lateral con iconos temáticos (`🏠 Escritorio`, `📦 Pedidos`, `📥 Descargas`, `📍 Direcciones`, `👤 Detalles`, `🚪 Salir`) y pestaña activa destacada.
   - Tarjeta de bienvenida destacada para el cliente logueado y tablas de pedidos/descargas con tipografía limpia.
4. **Páginas de Políticas:**
   - Contenedor centralizado tipo pliego editorial (`max-width: 860px`) con subtítulos decorados en color vino, listas con viñetas estilizadas y cuadro de aviso legal destacado en tono ámbar.

---

## 4. GUÍA RÁPIDA DE PUESTA EN MARCHA Y VERIFICACIÓN

### 1. Iniciar los contenedores:
```bash
docker compose up -d
```
Verificar que los 3 contenedores estén activos:
```bash
docker compose ps
```

### 2. URLs de Acceso Local:
- **Tienda Pública:** `http://localhost:8080/`
- **Panel de Usuario:** `http://localhost:8080/?page_id=9`
- **Políticas de Envío:** `http://localhost:8080/?page_id=32`
- **Políticas de Devolución:** `http://localhost:8080/?page_id=33`
- **Administración WordPress:** `http://localhost:8080/wp-admin/`
- **Base de Datos phpMyAdmin:** `http://localhost:8081/`

### 3. Protocolo de Prueba de Ebooks y Facturación en Mailtrap:
1. Realice una compra como cliente con cualquier producto (ej. un libro físico y un Ebook).
2. Abra `https://mailtrap.io` e ingrese con `rivadeneriatito78@gmail.com`.
3. Vaya a **Inboxes > My Inbox**.
4. Observe la llegada de la notificación de venta y la confirmación del pedido.
5. Ingrese a `http://localhost:8080/wp-admin/`, vaya a `WooCommerce > Pedidos` y cambie el pedido a **"Completado"**.
6. En Mailtrap verá llegar de inmediato el correo con el desglose de la factura legal con IVA 15% y los botones de descarga de los Ebooks comprados.
7. Al hacer clic en descargar, el cliente recibe el PDF protegido y en `Mi Cuenta > Descargas` se descuenta el intento (de 3 a 2 restantes) con su fecha de vencimiento a 7 días.

### 4. Prueba del Botón de WhatsApp:
1. Abra cualquier libro en la tienda (ej. *1984*).
2. Haga clic en el botón verde *"¿Libro agotado o por encargo? Consultar disponibilidad"*.
3. Verifique que se abra WhatsApp Web con el destinatario **`0987852260`** (`593987852260`) y el texto autocompletado con el título y enlace del libro.

---

## 5. CONCLUSIÓN TÉCNICA
El proyecto **LibroMundo** cumple rigurosamente con los estándares de ingeniería de software para e-commerce: alta disponibilidad mediante contenedores, aislamiento de secretos de configuración, cumplimiento de normativas fiscales y legales de Ecuador, automatización de entrega de activos digitales con límites de propiedad intelectual, comunicación omnicanal asistida por WhatsApp y una experiencia de usuario sobria, moderna y visualmente atractiva.

# INFORME TÉCNICO Y MANUAL DE PRUEBAS DEL SISTEMA E-COMMERCE LIBROMUNDO
**Asignatura:** Ingeniería Web  
**Proyecto:** Plataforma de Comercio Electrónico "LibroMundo (Librería y Papelería)"  
**Arquitectura:** WordPress 6.5 + WooCommerce 8.x + MariaDB/MySQL 8.0 en Contenedores Docker  
**Calificación Objetivo:** 10/10 Puntos  

---

# PARTE 1: INFORME TÉCNICO DE ARQUITECTURA E IMPLEMENTACIÓN

## 1. RESUMEN EJECUTIVO
**LibroMundo** es una solución de comercio electrónico desarrollada para la gestión, exhibición y comercialización multicanal de productos editoriales impresos, recursos de lectura digital (Ebooks) y artículos de papelería y estudio técnico. 

El modelo de negocio combina la venta tradicional de inventario físico (con control estricto de pesos, cubicaje y logística terrestre) con la distribución instantánea de propiedad intelectual digital bajo protocolos seguros de caducidad temporal y cuotas máximas de descarga. La plataforma opera sobre una arquitectura contenerizada desacoplada, orientada a la portabilidad, reproducibilidad de entornos e integridad transaccional.

---

## 2. JUSTIFICACIÓN TÉCNICA DE LA ARQUITECTURA

### 2.1. Contenerización con Docker Compose vs. Ambientes Tradicionales (XAMPP / WAMP / CPanel)
| Dimensión | Docker Compose (LibroMundo) | Servidores Locales Tradicionales (XAMPP/WAMP) | Hosting Compartido (CPanel Tradicional) |
| :--- | :--- | :--- | :--- |
| **Aislamiento de Dependencias** | Total. PHP 8.2, Apache y MySQL 8.0 corren en contenedores independientes sin colisiones de librerías en el host. | Nulo. Depende de las DLLs o librerías del sistema operativo local. | Limitado a jaulas Chroot/CloudLinux compartidas con vecinos ruidosos. |
| **Reproducibilidad (DevOps)** | Inmediata. El comando `docker compose up -d` despliega el entorno idéntico en Windows, Linux o macOS. | Baja. Requiere configuración manual de puertos, `php.ini` y extensiones en cada máquina. | Difícil de versionar y sincronizar con repositorios Git. |
| **Persistencia y Volúmenes** | Control granular mediante Named Volumes (`db_data`, `wp_data`) aislados del código transitorio. | Mezcla los archivos del sistema operativo con la raíz `htdocs`. | Sujeta a límites de inodos y respaldos opacos. |
| **Seguridad de Red** | Red interna privada tipo puente (`bridge`). MySQL no expone puertos al exterior; solo WordPress y phpMyAdmin se comunican en su red interna. | Expone puertos como el 3306 a la red local por defecto (riesgo crítico de seguridad). | Múltiples usuarios comparten puertos del servidor web. |

---

### 2.2. Justificación y Comparativa de Selección del Stack Tecnológico y Plugins
Para garantizar un rendimiento óptimo sin sobrecargar el consumo de memoria RAM del contenedor ni degradar el *Time to First Byte (TTFB)*, se realizó una selección rigurosa de componentes:

| Categoría | Solución Seleccionada | Alternativas Evaluadas | Criterio Técnico de Selección |
| :--- | :--- | :--- | :--- |
| **Motor E-commerce** | **WooCommerce** | Shopify, PrestaShop, Magento | Código abierto, sin cobro de comisiones porcentuales sobre venta, soporte nativo de productos virtuales/descargables sin costo de licencia y amplia extensibilidad mediante hooks de WordPress. |
| **Enrutamiento SMTP** | **FluentSMTP** | WP Mail SMTP, Post SMTP, Easy WP SMTP | **Zero-Bloatware:** No muestra banners publicitarios, código optimizado sin telemetría pesada, almacena logs de auditoría de correos enviados en base de datos local y permite configuración segura con proveedores API/SMTP modernos. |
| **Canal Conversacional** | **Joinchat + Snippet Nativo LibroMundo** | Click to Chat, Chatty, Tidio Live Chat | Cero impacto en el DOM. Carga asíncrona de scripts, compatibilidad total con enlaces estandarizados `wa.me`, sin peticiones a servidores de terceros que ralenticen la carga inicial del sitio. |
| **Base de Datos** | **MySQL 8.0** | MySQL 5.7, MariaDB 10.4 | Mejoras en el optimizador de consultas de índices para tablas InnoDB transaccionales, compatibilidad total con collation `utf8mb4_unicode_ci` y soporte de JSON nativo. |

---

## 3. INGENIERÍA DE SEGURIDAD APLICADA

### 3.1. Protección de Credenciales y Secretos de Infraestructura
1. **Principio de Mínima Exposición:** Ninguna contraseña de base de datos, credencial SMTP o clave de autenticación se encuentra hardcodeada (*quemada*) en el código fuente.
2. **Inyección por Variables de Entorno (`.env`):** El archivo `docker-compose.yml` se alimenta exclusivamente de variables inyectadas en tiempo de ejecución.
3. **Exclusión Estricta en Git (`.gitignore`):** El archivo `.env` está expresamente excluido del árbol de Git, evitando fugas de secretos en repositorios públicos o privados de GitHub/GitLab. Se suministra únicamente `.env.example` con valores de plantilla.
4. **Blindaje de Archivos Pesados:** Las carpetas `wp-content/uploads/` y los respaldos SQL (`*.sql`, `*.sql.gz`) están bloqueados en el versionamiento para evitar saturación del buffer de Git y filtraciones de base de datos.

### 3.2. Erradicación de la Vulnerabilidad de `mail()` Nativo de PHP
El uso de la función interna `mail()` de PHP en servidores web representa una mala práctica severa por tres motivos arquitectónicos:
1. **Falta de Servidor de Correo (MTA) en Docker:** Las imágenes estándar de PHP-Apache de Docker no incorporan un servicio Sendmail o Postfix configurado, lo que genera fallos silenciosos (*silent drops*) al intentar enviar notificaciones.
2. **Reputación y Bloqueo Antispam:** Los correos emitidos por `mail()` carecen de registros SPF (*Sender Policy Framework*), firmas criptográficas DKIM (*DomainKeys Identified Mail*) y alineación DMARC, provocando que Gmail, Outlook o Yahoo los clasifiquen inmediatamente como SPAM o Phishing.
3. **Bloqueo Síncrono del Hilo:** La llamada nativa a `mail()` bloquea el hilo de ejecución del servidor web mientras intenta negociar el socket de red, degradando la experiencia de compra del cliente en el checkout. **Solución implementada:** Delegación del transporte SMTP autenticado con cifrado TLS en el puerto 587 mediante FluentSMTP.

---

## 4. CHECKLIST DE EVIDENCIAS Y CAPTURAS PARA RÚBRICA 10/10

Para asegurar la calificación perfecta de 10 puntos en la evaluación académica, el equipo de desarrollo debe anexar las siguientes diez (10) capturas de pantalla organizadas:

- [ ] **Captura 1 (Docker en Ejecución):** Terminal mostrando el comando `docker compose ps` con los 3 contenedores activos (`libromundo_mysql`, `libromundo_wordpress`, `libromundo_phpmyadmin`) con estado `Up (healthy)`.
- [ ] **Captura 2 (Seguridad Git):** Editor de código o consola mostrando el archivo `.gitignore` con las exclusiones de `.env` y `wp-content/uploads/`, junto al comando `git status` que demuestre que el archivo `.env` no es rastreado.
- [ ] **Captura 3 (Importación Exitosa del Catálogo):** Panel de `WooCommerce -> Productos` con los 10 productos listados, mostrando sus categorías, precios, inventario y visibilidad.
- [ ] **Captura 4 (Reto Adicional Ebooks):** Ficha de edición de un Ebook (ej. "El Arte de la Guerra") evidenciando las casillas "Virtual" y "Descargable" marcadas, el límite de descargas fijado en `3` y la caducidad en `7` días.
- [ ] **Captura 5 (Políticas de Descargas Seguras):** Pestaña `WooCommerce -> Ajustes -> Productos -> Productos descargables` mostrando el método *"Forzar descargas"* activo y la restricción de descarga tras el pago.
- [ ] **Captura 6 (Impuestos y Moneda de Ecuador):** `WooCommerce -> Ajustes -> General` (Moneda: USD) y `WooCommerce -> Ajustes -> Impuesto` con la tasa estándar de IVA al `15%` configurada para Ecuador (`EC`).
- [ ] **Captura 7 (Métodos de Pago y Envíos):** Pantalla de `WooCommerce -> Ajustes -> Pagos` con Transferencia Bancaria y Contra Entrega habilitados; y `Ajustes -> Envío` con la zona "Zona Austro" y tarifa plana para físicos.
- [ ] **Captura 8 (Auditoría SMTP):** Panel de `FluentSMTP -> Settings` con la conexión validada a Mailtrap o Brevo, y la pantalla de `Email Logs` mostrando el correo de prueba exitoso (*Status: Sent*).
- [ ] **Captura 9 (Ficha de Producto con Botón WhatsApp):** Vista de un libro en la tienda pública mostrando el botón personalizado *"¿Libro agotado o por encargo? Consultar disponibilidad"*, y la pestaña de WhatsApp abierta con el mensaje codificado que incluye el título del libro.
- [ ] **Captura 10 (Prueba Integral del Checkout):** Pantalla de pedido recibido con un carrito mixto, donde el costo de envío solo se cobra sobre el producto físico, acompañado del correo recibido por el cliente con el enlace de descarga del Ebook.

---

# PARTE 2: MANUAL DE USUARIO Y PROTOCOLO DE PRUEBAS DE LA TIENDA

## 1. FLUJO PASO A PASO PARA EL CLIENTE

### Paso 1: Selección de Productos en el Catálogo
1. Ingrese a la tienda en línea `http://localhost:8080/tienda/`.
2. Filtre por la categoría **"Libros Físicos"** y añada al carrito el título *"Hábitos Atómicos"* (Precio: $21.00).
3. Navegue a la categoría **"Ebooks Digitales"** y añada al carrito el título *"Ebook: El Arte de la Guerra"* (Precio: $5.99).
4. Haga clic en el icono del carrito en la esquina superior derecha y presione **"Ver Carrito"** o **"Finalizar Compra"**.

### Paso 2: Validación del Desglose de Facturación y Envío
1. En la página de pago, complete los datos de facturación (Nombre, Apellido, Cédula/RUC, Dirección en Cuenca, Teléfono y Correo Electrónico).
2. Verifique la tabla de resumen del pedido:
   - Subtotal Físico: $21.00
   - Subtotal Digital: $5.99
   - Tarifa Plana de Envío (Cuenca): $2.50 *(Observe que el sistema no duplicó ni recargó flete por el Ebook)*.
   - IVA (15%): Calculado exactamente sobre los productos gravados y el flete.
   - Total Final en Dólares Estadounidenses (USD).

### Paso 3: Selección del Método de Pago
1. Seleccione la opción **"Transferencia Bancaria Directa"**.
2. Lea las instrucciones mostradas en pantalla (cuentas corrientes en Banco Pichincha / Banco Guayaquil).
3. Marque la casilla de aceptación de los Términos, Condiciones y Políticas de Entrega de LibroMundo.
4. Presione el botón **"Realizar el Pedido"**.

### Paso 4: Recepción de Correo y Acceso a la Descarga Digital
1. Acceda a la bandeja de entrada del correo ingresado (o la bandeja de pruebas en Mailtrap).
2. Abra el correo con asunto: *"Tu pedido en LibroMundo ha sido recibido y procesado"*.
3. En la sección **"Tus Descargas Digitales"**, haga clic en el enlace del archivo *"El Arte de la Guerra PDF/ePub"*.
4. Compruebe que la descarga del archivo inicia de forma protegida.
5. Ingrese a `http://localhost:8080/mi-cuenta/downloads/` para corroborar que el contador indica: *"2 descargas restantes - Caduca en 7 días"*.

### Paso 5: Consulta por WhatsApp de un Libro Agotado o por Encargo
1. Busque en el catálogo un producto que tenga inventario en cero o ingrese a la ficha de cualquier libro deseado.
2. Ubique debajo del botón de compra el botón distintivo en verde: *"¿Libro agotado o por encargo? Consultar disponibilidad"*.
3. Al hacer clic, se abrirá la aplicación o la interfaz web de WhatsApp Web dirigida al número `+593 99 123 4567`.
4. Compruebe que la barra de texto tiene precargado el mensaje automático con el título exacto del libro y el enlace directo de la ficha técnica.
5. Presione enviar para contactar directamente al librero de turno.

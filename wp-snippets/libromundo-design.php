<?php
/**
 * Plugin Name: LibroMundo - Diseño Editorial Sutil
 * Description: Mejora visual sutil, elegante y moderna para LibroMundo sin sobrecargar el sitio.
 * Version: 1.2.0
 * Author: LibroMundo Web Engineering Team
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_head', function() {
    ?>
    <style id="libromundo-editorial-design">
        /* ============================================================
           LIBROMUNDO - ESTILO EDITORIAL ACADÉMICO Y MODERNO
           ============================================================ */

        :root {
            --lm-burgundy: #722F37;
            --lm-burgundy-dark: #561f25;
            --lm-burgundy-light: #fbf5f5;
            --lm-slate: #1e293b;
            --lm-text: #334155;
            --lm-text-muted: #64748b;
            --lm-bg-page: #fbfaf8;
            --lm-card-bg: #ffffff;
            --lm-border: #eae7e1;
            --lm-border-hover: #d5d0c5;
            --lm-radius: 12px;
            --lm-radius-sm: 8px;
            --lm-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --lm-shadow-hover: 0 12px 24px rgba(114, 47, 55, 0.09);
        }

        /* 1. Fondo suave y tipografía */
        body {
            background-color: var(--lm-bg-page) !important;
            color: var(--lm-text) !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* 2. Cabecera fija y estilizada */
        header.wp-block-template-part {
            position: sticky;
            top: 0;
            z-index: 999;
            background-color: #ffffff !important;
            border-bottom: 1px solid var(--lm-border) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
            padding: 4px 0 !important;
        }

        /* Logo / Nombre de la librería */
        .wp-block-site-title {
            margin: 0 !important;
        }
        .wp-block-site-title a {
            font-family: 'Cardo', Georgia, serif !important;
            font-weight: 700 !important;
            font-size: 1.6rem !important;
            color: var(--lm-burgundy) !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            letter-spacing: -0.01em !important;
            transition: opacity 0.2s;
        }
        .wp-block-site-title a:hover {
            opacity: 0.9;
        }
        .wp-block-site-title a::before {
            content: "📚";
            font-size: 1.35rem;
        }

        /* Enlaces de Navegación */
        .wp-block-navigation-item a,
        .wp-block-navigation-submenu a {
            font-weight: 500 !important;
            font-size: 0.94rem !important;
            color: var(--lm-slate) !important;
            padding: 8px 14px !important;
            border-radius: var(--lm-radius-sm) !important;
            transition: all 0.2s ease !important;
            text-decoration: none !important;
        }
        .wp-block-navigation-item:hover > a,
        .wp-block-navigation-submenu:hover > a {
            color: var(--lm-burgundy) !important;
            background-color: var(--lm-burgundy-light) !important;
        }
        .wp-block-navigation__submenu-container {
            background-color: #ffffff !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius-sm) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            padding: 6px !important;
        }

        /* Iconos de Cuenta y Carrito */
        .wc-block-customer-account__visual,
        .wc-block-mini-cart__button {
            border-radius: var(--lm-radius-sm) !important;
            transition: background-color 0.2s ease, color 0.2s ease !important;
            padding: 6px !important;
        }
        .wc-block-customer-account:hover .wc-block-customer-account__visual,
        .wc-block-mini-cart__button:hover {
            background-color: var(--lm-burgundy-light) !important;
            color: var(--lm-burgundy) !important;
        }
        .wc-block-mini-cart__badge {
            background-color: var(--lm-burgundy) !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border-radius: 999px !important;
        }

        /* 3. Títulos Generales de Página */
        h1.wp-block-post-title,
        .wp-block-query-title {
            font-family: 'Cardo', Georgia, serif !important;
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            color: var(--lm-slate) !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.5rem !important;
            text-align: center !important;
        }

        .woocommerce-ordering select.orderby {
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius-sm) !important;
            padding: 8px 14px !important;
            font-size: 0.88rem !important;
            background-color: #ffffff !important;
            color: var(--lm-text) !important;
            outline: none !important;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .woocommerce-ordering select.orderby:focus {
            border-color: var(--lm-burgundy) !important;
        }
        .woocommerce-result-count {
            color: var(--lm-text-muted) !important;
            font-size: 0.9rem !important;
        }

        /* 4. Tarjetas de Productos (Catálogo) */
        ul.wc-block-product-template,
        .wc-block-product-template__responsive {
            display: grid !important;
            gap: 28px !important;
            padding: 0 !important;
            margin-top: 1.5rem !important;
            list-style: none !important;
        }
        @media (min-width: 900px) {
            ul.wc-block-product-template,
            .wc-block-product-template__responsive {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }
        @media (min-width: 600px) and (max-width: 899px) {
            ul.wc-block-product-template,
            .wc-block-product-template__responsive {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        @media (max-width: 599px) {
            ul.wc-block-product-template,
            .wc-block-product-template__responsive {
                grid-template-columns: 1fr !important;
            }
        }

        li.wc-block-product {
            background-color: var(--lm-card-bg) !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius) !important;
            padding: 16px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            height: 100% !important;
            position: relative !important;
            box-shadow: var(--lm-shadow-sm) !important;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease, border-color 0.25s ease !important;
        }
        li.wc-block-product:hover {
            transform: translateY(-4px) !important;
            border-color: var(--lm-border-hover) !important;
            box-shadow: var(--lm-shadow-hover) !important;
        }

        /* Imagen del Producto - Contenedor con marco */
        li.wc-block-product .wc-block-components-product-image {
            border-radius: var(--lm-radius-sm) !important;
            overflow: hidden !important;
            background-color: #f6f5f1 !important;
            margin-bottom: 14px !important;
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        li.wc-block-product .wc-block-components-product-image a {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
        }
        li.wc-block-product .wc-block-components-product-image img {
            width: 100% !important;
            height: 270px !important;
            object-fit: contain !important;
            aspect-ratio: 4/5 !important;
            padding: 8px !important;
            border-radius: 6px !important;
            transition: transform 0.3s ease !important;
        }
        li.wc-block-product:hover .wc-block-components-product-image img {
            transform: scale(1.03) !important;
        }

        /* Badges de Categoría en Tarjetas */
        li.wc-block-product.product_cat-libros-digitales-ebooks .wc-block-components-product-image::after {
            content: "⚡ EBOOK DIGITAL";
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(114, 47, 55, 0.92);
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 4px 8px;
            border-radius: 4px;
            backdrop-filter: blur(4px);
            z-index: 2;
        }
        li.wc-block-product.product_cat-libros-fisicos .wc-block-components-product-image::after {
            content: "📖 LIBRO FÍSICO";
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(30, 41, 59, 0.90);
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 4px 8px;
            border-radius: 4px;
            backdrop-filter: blur(4px);
            z-index: 2;
        }
        li.wc-block-product.product_cat-papeleria-y-accesorios .wc-block-components-product-image::after {
            content: "✏️ PAPELERÍA";
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(43, 76, 89, 0.90);
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 4px 8px;
            border-radius: 4px;
            backdrop-filter: blur(4px);
            z-index: 2;
        }

        /* Título del producto */
        li.wc-block-product .wp-block-post-title {
            font-family: inherit !important;
            font-size: 1.02rem !important;
            font-weight: 600 !important;
            line-height: 1.35 !important;
            min-height: 2.7em !important;
            margin: 0 0 6px 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        li.wc-block-product .wp-block-post-title a {
            color: var(--lm-slate) !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }
        li.wc-block-product:hover .wp-block-post-title a {
            color: var(--lm-burgundy) !important;
        }

        /* Precio del producto */
        li.wc-block-product .wp-block-woocommerce-product-price {
            margin-bottom: 12px !important;
            text-align: center !important;
        }
        li.wc-block-product .amount {
            color: var(--lm-burgundy) !important;
            font-weight: 700 !important;
            font-size: 1.15rem !important;
        }

        /* Botón siempre alineado al fondo de la tarjeta */
        li.wc-block-product .wp-block-woocommerce-product-button {
            margin-top: auto !important;
            width: 100% !important;
        }

        /* 5. Botones generales */
        .wp-block-button__link,
        .wc-block-components-product-button__button,
        .woocommerce button.button,
        .woocommerce a.button,
        .woocommerce input.button {
            background-color: var(--lm-burgundy) !important;
            color: #ffffff !important;
            border-radius: var(--lm-radius-sm) !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            padding: 10px 18px !important;
            border: none !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 5px rgba(114, 47, 55, 0.18) !important;
            text-decoration: none !important;
            text-align: center !important;
            cursor: pointer !important;
            display: inline-block !important;
        }
        .wp-block-button__link:hover,
        .wc-block-components-product-button__button:hover,
        .woocommerce button.button:hover,
        .woocommerce a.button:hover,
        .woocommerce input.button:hover {
            background-color: var(--lm-burgundy-dark) !important;
            box-shadow: 0 4px 12px rgba(114, 47, 55, 0.28) !important;
            transform: translateY(-1px) !important;
        }

        /* ============================================================
           6. SECCIÓN "MI CUENTA" (PORTAL DE USUARIO)
           ============================================================ */
        .woocommerce-account .entry-content {
            max-width: 1000px !important;
            width: 100% !important;
            margin: 0 auto 50px auto !important;
        }
        .woocommerce-account .woocommerce {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 30px !important;
            align-items: flex-start !important;
        }

        /* Menú lateral de navegación */
        .woocommerce-account .woocommerce-MyAccount-navigation {
            float: none !important;
            width: 250px !important;
            flex-shrink: 0 !important;
        }
        .woocommerce-MyAccount-navigation ul {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            background-color: #ffffff !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius) !important;
            overflow: hidden !important;
            box-shadow: var(--lm-shadow-sm) !important;
        }
        .woocommerce-MyAccount-navigation ul li {
            margin: 0 !important;
            border-bottom: 1px solid #f2eee8 !important;
        }
        .woocommerce-MyAccount-navigation ul li:last-child {
            border-bottom: none !important;
        }
        .woocommerce-MyAccount-navigation ul li a {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            padding: 13px 18px !important;
            color: var(--lm-slate) !important;
            font-weight: 500 !important;
            font-size: 0.93rem !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
        }
        .woocommerce-MyAccount-navigation ul li:hover a {
            background-color: var(--lm-burgundy-light) !important;
            color: var(--lm-burgundy) !important;
            padding-left: 22px !important;
        }
        .woocommerce-MyAccount-navigation ul li.is-active a {
            background-color: var(--lm-burgundy) !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }

        /* Iconos temáticos de navegación */
        .woocommerce-MyAccount-navigation-link--dashboard a::before { content: "🏠"; font-size: 1rem; }
        .woocommerce-MyAccount-navigation-link--orders a::before { content: "📦"; font-size: 1rem; }
        .woocommerce-MyAccount-navigation-link--downloads a::before { content: "📥"; font-size: 1rem; }
        .woocommerce-MyAccount-navigation-link--edit-address a::before { content: "📍"; font-size: 1rem; }
        .woocommerce-MyAccount-navigation-link--edit-account a::before { content: "👤"; font-size: 1rem; }
        .woocommerce-MyAccount-navigation-link--customer-logout a::before { content: "🚪"; font-size: 1rem; }

        /* Contenido del panel */
        .woocommerce-account .woocommerce-MyAccount-content {
            float: none !important;
            flex: 1 !important;
            min-width: 320px !important;
            background-color: #ffffff !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius) !important;
            padding: 30px !important;
            box-shadow: var(--lm-shadow-sm) !important;
            min-height: 380px !important;
        }

        /* Caja de bienvenida personalizada */
        .woocommerce-MyAccount-content > p:first-of-type {
            background-color: #fbfaf8 !important;
            border: 1px solid #edebe8 !important;
            border-left: 4px solid var(--lm-burgundy) !important;
            border-radius: var(--lm-radius-sm) !important;
            padding: 16px 20px !important;
            margin-bottom: 20px !important;
            font-size: 1.02rem !important;
            color: var(--lm-slate) !important;
            line-height: 1.5 !important;
        }
        .woocommerce-MyAccount-content > p:first-of-type strong {
            color: var(--lm-burgundy) !important;
        }
        .woocommerce-MyAccount-content a {
            color: var(--lm-burgundy) !important;
            font-weight: 600 !important;
            text-decoration: underline !important;
            text-underline-offset: 3px !important;
        }
        .woocommerce-MyAccount-content a:hover {
            color: var(--lm-burgundy-dark) !important;
        }

        /* Tablas dentro de Mi Cuenta (Pedidos y Descargas) */
        .woocommerce-MyAccount-content table.woocommerce-orders-table,
        .woocommerce-MyAccount-content table.woocommerce-table--order-downloads,
        .woocommerce-MyAccount-content table.my_account_orders {
            width: 100% !important;
            border-collapse: collapse !important;
            border-radius: var(--lm-radius-sm) !important;
            overflow: hidden !important;
            border: 1px solid var(--lm-border) !important;
            margin-top: 14px !important;
        }
        .woocommerce-MyAccount-content table th {
            background-color: #f7f5f0 !important;
            color: var(--lm-slate) !important;
            padding: 12px 16px !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.04em !important;
        }
        .woocommerce-MyAccount-content table td {
            padding: 14px 16px !important;
            border-top: 1px solid var(--lm-border) !important;
            font-size: 0.92rem !important;
            vertical-align: middle !important;
        }

        /* Formulario de Inicio de Sesión / Registro (cuando no está logueado) */
        .woocommerce form.login,
        .woocommerce form.register {
            background-color: #ffffff !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius) !important;
            padding: 32px !important;
            max-width: 480px !important;
            margin: 10px auto 40px auto !important;
            box-shadow: var(--lm-shadow-sm) !important;
        }
        .woocommerce form.login .input-text,
        .woocommerce form.register .input-text {
            border: 1px solid #d1d5db !important;
            border-radius: var(--lm-radius-sm) !important;
            padding: 10px 14px !important;
            font-size: 0.95rem !important;
            width: 100% !important;
            background-color: #fcfbf9 !important;
            transition: all 0.2s ease !important;
            margin-top: 4px !important;
        }
        .woocommerce form.login .input-text:focus,
        .woocommerce form.register .input-text:focus {
            border-color: var(--lm-burgundy) !important;
            background-color: #ffffff !important;
            outline: 2px solid rgba(114, 47, 55, 0.15) !important;
        }

        /* ============================================================
           7. PÁGINAS DE POLÍTICAS (ENVÍOS Y DEVOLUCIONES)
           ============================================================ */
        .page-id-32 .entry-content,
        .page-id-33 .entry-content {
            background-color: #ffffff !important;
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius) !important;
            box-shadow: var(--lm-shadow-sm) !important;
            padding: 36px 42px !important;
            max-width: 860px !important;
            width: 100% !important;
            margin: 10px auto 50px auto !important;
            line-height: 1.7 !important;
        }
        .page-id-32 .entry-content h2,
        .page-id-33 .entry-content h2 {
            font-family: 'Cardo', Georgia, serif !important;
            font-size: 1.45rem !important;
            font-weight: 700 !important;
            color: var(--lm-burgundy) !important;
            margin-top: 1.8rem !important;
            margin-bottom: 0.8rem !important;
            padding-bottom: 8px !important;
            border-bottom: 2px solid #f4efe9 !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }
        .page-id-32 .entry-content ul,
        .page-id-33 .entry-content ul {
            background-color: #fbfaf8 !important;
            border: 1px solid #edebe8 !important;
            border-radius: var(--lm-radius-sm) !important;
            padding: 16px 20px 16px 36px !important;
            margin: 16px 0 !important;
            list-style: square !important;
        }
        .page-id-32 .entry-content ul li,
        .page-id-33 .entry-content ul li {
            margin-bottom: 8px !important;
            color: var(--lm-text) !important;
        }
        .page-id-32 .entry-content ul li:last-child,
        .page-id-33 .entry-content ul li:last-child {
            margin-bottom: 0 !important;
        }
        .page-id-32 .entry-content strong,
        .page-id-33 .entry-content strong {
            color: var(--lm-slate) !important;
        }

        /* Cuadro de aviso legal destacado en devoluciones */
        .page-id-33 .entry-content div[style*="background-color: #FFF3CD"],
        .page-id-33 .entry-content div[style*="background-color:#FFF3CD"] {
            background-color: #fffbeb !important;
            border: 1px solid #fde68a !important;
            border-left: 5px solid #d97706 !important;
            border-radius: var(--lm-radius-sm) !important;
            color: #92400e !important;
            padding: 16px 20px !important;
            margin: 20px 0 !important;
            line-height: 1.6 !important;
        }

        .page-id-32 .entry-content hr,
        .page-id-33 .entry-content hr {
            border: none !important;
            border-top: 1px solid var(--lm-border) !important;
            margin: 30px 0 !important;
        }

        /* 8. Carrito y Finalizar Compra */
        .woocommerce-cart table.cart,
        .woocommerce-checkout #order_review {
            background-color: #ffffff !important;
            border-radius: var(--lm-radius) !important;
            border: 1px solid var(--lm-border) !important;
            overflow: hidden !important;
            box-shadow: var(--lm-shadow-sm) !important;
        }
        .woocommerce-cart table.cart th,
        .woocommerce-table--order-details th {
            background-color: #f7f5f0 !important;
            color: var(--lm-slate) !important;
            font-weight: 600 !important;
        }

        /* 9. Pie de Página Sutil */
        footer.wp-block-template-part {
            background-color: #ffffff !important;
            border-top: 1px solid var(--lm-border) !important;
            margin-top: 50px !important;
            padding: 24px 20px !important;
            text-align: center !important;
            color: var(--lm-text-muted) !important;
            font-size: 0.88rem !important;
        }
    </style>
    <?php
}, 100);

/**
 * Throttle de seguridad para Mailtrap Sandbox:
 * Mailtrap Sandbox en su plan gratuito limita a 1 correo por segundo.
 * WooCommerce dispara el correo al administrador y al cliente en el mismo milisegundo durante el checkout,
 * lo que provocaba que el correo al cliente fuera rechazado con "422 Data not accepted".
 * Con este filtro garantizamos un intervalo de 1.5 segundos entre envíos consecutivos.
 */
add_filter('wp_mail', function($args) {
    static $last_email_time = 0;
    $now = microtime(true);
    if ($last_email_time > 0) {
        $elapsed = $now - $last_email_time;
        if ($elapsed < 1.5) {
            usleep((int)((1.5 - $elapsed) * 1000000));
        }
    }
    $last_email_time = microtime(true);
    return $args;
}, 1);


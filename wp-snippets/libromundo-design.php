<?php
/**
 * Plugin Name: LibroMundo - Diseño Editorial Sutil
 * Description: Mejora visual sutil, elegante y moderna para LibroMundo sin sobrecargar el sitio.
 * Version: 1.1.0
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

        /* 3. Título de la Tienda y Filtros */
        .wp-block-query-title {
            font-family: 'Cardo', Georgia, serif !important;
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            color: var(--lm-slate) !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.25rem !important;
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

        /* 4. Tarjetas de Productos (Grid Responsivo y Equilibrado) */
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

        /* 5. Botones generales y de añadir al carrito */
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
            width: 100% !important;
            text-align: center !important;
            cursor: pointer !important;
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

        /* 6. Detalles en Ficha de Producto Individual */
        .woocommerce div.product p.price,
        .woocommerce div.product span.price {
            color: var(--lm-burgundy) !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }
        .woocommerce div.product .quantity input.qty {
            border: 1px solid var(--lm-border) !important;
            border-radius: var(--lm-radius-sm) !important;
            padding: 8px !important;
            font-weight: 600 !important;
        }
        .woocommerce-tabs ul.tabs {
            border-bottom: 1px solid var(--lm-border) !important;
        }
        .woocommerce-tabs ul.tabs li.active a {
            color: var(--lm-burgundy) !important;
            border-bottom: 2px solid var(--lm-burgundy) !important;
        }

        /* 7. Carrito y Finalizar Compra */
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

        /* 8. Pie de Página Sutil */
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

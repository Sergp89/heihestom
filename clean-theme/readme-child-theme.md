# Создание дочерней темы для Clean Theme

## 📁 Структура дочерней темы

```
your-child-theme/
├── style.css                 # Обязательный файл с заголовком
├── functions.php             # Опционально: для переопределения функций
├── screenshot.png            # Превью темы (1200x900px)
├── template-parts/           # Переопределение шаблонов
│   ├── header/
│   ├── footer/
│   └── float-buttons/
└── assets/                   # Ваши ресурсы
    ├── css/
    ├── js/
    └── images/
```

## 1. Минимальный style.css

```css
/*
Theme Name:     Your Child Theme Name
Theme URI:      https://yoursite.com/child-theme
Description:    Дочерняя тема для Clean Theme с кастомными стилями
Author:         Your Name
Author URI:     https://yoursite.com
Template:       clean-theme
Version:        1.0.0
License:        GNU General Public License v2 or later
License URI:    http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:    your-child-theme
Tags:           custom-background, custom-logo, custom-menu, featured-images, threaded-comments

This theme, like WordPress, is licensed under the GPL.
*/

/* Ваши стили ниже */
```

**Важно:** Поле `Template: clean-theme` должно точно совпадать с именем директории родительской темы!

## 2. functions.php для подключения стилей

```php
<?php
/**
 * Child Theme functions and definitions
 *
 * @package Your_Child_Theme
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue parent and child theme stylesheets
 */
function your_child_theme_enqueue_styles() {
    // Parent theme style
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( 'clean-theme' )->get( 'Version' )
    );
    
    // Child theme style (depends on parent)
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array( 'parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
    
    // Your custom CSS (optional)
    wp_enqueue_style(
        'child-custom',
        get_stylesheet_directory_uri() . '/assets/css/custom.css',
        array( 'child-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'your_child_theme_enqueue_styles' );

/**
 * Add custom body class
 */
function your_child_theme_body_classes( $classes ) {
    $classes[] = 'your-custom-class';
    return $classes;
}
add_filter( 'body_class', 'your_child_theme_body_classes' );

/**
 * Override customizer defaults
 */
function your_child_theme_customizer_defaults( $defaults ) {
    $defaults['accent_color'] = '#ff6600';
    $defaults['container_width'] = 'wide';
    $defaults['footer_style'] = 'style-2';
    return $defaults;
}
add_filter( 'clean_theme_customizer_defaults', 'your_child_theme_customizer_defaults' );
```

## 3. Переопределение шаблонов

### Переопределение footer style-1

Создайте файл `template-parts/footer/style-1.php` в дочерней теме:

```php
<?php
/**
 * Custom Footer Style 1
 * 
 * Copy from parent theme and modify as needed
 */
?>
<footer class="site-footer footer-style-1">
    <!-- Ваш кастомный футер -->
</footer>
```

### Переопределение плавающих кнопок

Создайте `template-parts/float-buttons/buttons.php`:

```php
<?php
/**
 * Custom Floating Buttons
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$fab_enabled = get_theme_mod( 'fab_enable', false );
if ( ! $fab_enabled ) {
    return;
}
?>
<div class="fab-container custom-fab">
    <!-- Ваши кнопки -->
</div>
```

## 4. Переопределение функций из inc/

Создайте файлы в `/inc/` директории дочерней темы:

### Пример: customizer.php

```php
<?php
/**
 * Custom Customizer Settings
 * 
 * This file will be loaded INSTEAD of parent's inc/customizer.php
 */

// Your custom customizer code here
```

## 5. Добавление новых областей виджетов

```php
function your_child_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Custom Sidebar', 'your-child-theme' ),
        'id'            => 'custom-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'your_child_theme_widgets_init', 20 );
```

## 6. Изменение настроек темы через фильтры

```php
// Изменить цвета по умолчанию
add_filter( 'clean_theme_customizer_defaults', function( $defaults ) {
    $defaults['accent_color'] = '#e74c3c';
    $defaults['header_bg_color'] = '#2c3e50';
    return $defaults;
});

// Добавить свои настройки в Customizer
add_action( 'customize_register', 'your_child_theme_customizer', 20 );
function your_child_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'your_custom_section', array(
        'title'    => __( 'Your Settings', 'your-child-theme' ),
        'priority' => 200,
    ) );
    
    // Добавьте свои настройки...
}
```

## 7. Переопределение image sizes

```php
// Удалить размеры родителя и добавить свои
function your_child_theme_image_sizes() {
    remove_image_size( 'clean-theme-large' );
    
    add_image_size( 'your-custom-large', 2000, 1200, true );
}
add_action( 'after_setup_theme', 'your_child_theme_image_sizes', 30 );
```

## 🔧 Полезные хуки для дочерних тем

### Действия (Actions)
- `get_template_part_{slug}` - перед загрузкой template part
- `clean_theme_before_header` - перед хедером
- `clean_theme_after_header` - после хедера
- `clean_theme_before_footer` - перед футером
- `clean_theme_after_footer` - после футера

### Фильтры (Filters)
- `clean_theme_customizer_defaults` - изменить дефолтные настройки
- `clean_theme_body_classes` - добавить классы body
- `clean_theme_excerpt_length` - изменить длину excerpt
- `locate_template` - переопределить путь к шаблонам

## 🎨 CSS переменные для кастомизации

```css
:root {
    --ct-accent-color: #your-color;
    --ct-header-bg: #your-color;
    --ct-footer-bg: #your-color;
    --ct-text-color: #your-color;
    --ct-heading-color: #your-color;
    --ct-container-width: 1200px;
}
```

## ✅ Проверка работы

1. Активируйте дочернюю тему в админке WordPress
2. Проверьте, что стили родительской темы загружаются
3. Проверьте, что ваши переопределения работают
4. Убедитесь, что Customizer работает корректно

## 📚 Документация

- [WordPress Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
- [Clean Theme Documentation](./readme.txt)

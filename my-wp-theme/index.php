<?php
/**
 * The main template file
 *
 * @package Dental_Clinic
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h2><?php esc_html_e('Здоровая улыбка — наше призвание!', 'dental-clinic'); ?></h2>
            <p><?php esc_html_e('Современные технологии лечения зубов. Профессиональная команда врачей. Индивидуальный подход к каждому пациенту.', 'dental-clinic'); ?></p>
            <a href="#contact" class="btn-primary"><?php esc_html_e('Записаться на приём', 'dental-clinic'); ?></a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section fade-in">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Наши услуги', 'dental-clinic'); ?></h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🦷</div>
                    <h3><?php esc_html_e('Терапия', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Лечение кариеса, пульпита, периодонтита. Эстетическая реставрация зубов.', 'dental-clinic'); ?></p>
                </div>
                <div class="service-card">
                    <div class="service-icon">✨</div>
                    <h3><?php esc_html_e('Отбеливание', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Профессиональное отбеливание зубов безопасными методами. Zoom, лазерное отбеливание.', 'dental-clinic'); ?></p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3><?php esc_html_e('Протезирование', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Установка коронок, мостовидных протезов, виниров. Съёмное и несъёмное протезирование.', 'dental-clinic'); ?></p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📐</div>
                    <h3><?php esc_html_e('Имплантация', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Восстановление утраченных зубов с помощью имплантов. Все виды имплантации.', 'dental-clinic'); ?></p>
                </div>
                <div class="service-card">
                    <div class="service-icon">👶</div>
                    <h3><?php esc_html_e('Детская стоматология', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Бережное лечение зубов у детей. Профилактика, герметизация фиссур.', 'dental-clinic'); ?></p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚑</div>
                    <h3><?php esc_html_e('Хирургия', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Удаление зубов любой сложности. Зубосохраняющие операции.', 'dental-clinic'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section fade-in">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3><?php esc_html_e('О нашей клинике', 'dental-clinic'); ?></h3>
                    <p><?php esc_html_e('Наша клиника работает с 2010 года и за это время помогла тысячам пациентов обрести здоровую и красивую улыбку. Мы используем только современное оборудование и материалы от ведущих мировых производителей.', 'dental-clinic'); ?></p>
                    <p><?php esc_html_e('Наши врачи регулярно проходят обучение в России и за рубежом, чтобы быть в курсе последних достижений стоматологии.', 'dental-clinic'); ?></p>
                    <a href="#contact" class="btn-primary"><?php esc_html_e('Узнать больше', 'dental-clinic'); ?></a>
                </div>
                <div class="about-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/clinic-about.jpg" alt="<?php esc_attr_e('Наша клиника', 'dental-clinic'); ?>" onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section fade-in">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Контакты', 'dental-clinic'); ?></h2>
            <div class="contact-grid">
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <h4><?php esc_html_e('Телефон', 'dental-clinic'); ?></h4>
                    <p><a href="tel:+79991234567">+7 (999) 123-45-67</a></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <h4><?php esc_html_e('Адрес', 'dental-clinic'); ?></h4>
                    <p><?php esc_html_e('г. Москва, ул. Примерная, д. 1', 'dental-clinic'); ?></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <h4><?php esc_html_e('Email', 'dental-clinic'); ?></h4>
                    <p><a href="mailto:info@dental-clinic.ru">info@dental-clinic.ru</a></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">🕐</div>
                    <h4><?php esc_html_e('Режим работы', 'dental-clinic'); ?></h4>
                    <p><?php esc_html_e('Пн-Пт: 9:00 - 20:00', 'dental-clinic'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Display posts if on blog page
    if (have_posts()) :
        echo '<section class="blog-section fade-in"><div class="container">';
        echo '<h2 class="section-title">' . esc_html__('Новости', 'dental-clinic') . '</h2>';
        echo '<div class="services-grid">';
        
        while (have_posts()) :
            the_post();
            ?>
            <article class="service-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-icon"><?php the_post_thumbnail('medium'); ?></div>
                <?php endif; ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
            </article>
            <?php
        endwhile;
        
        echo '</div></section>';
    endif;
    ?>
</main>

<?php
get_footer();
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-widget">
                <h4><?php esc_html_e('О клинике', 'dental-clinic'); ?></h4>
                <p><?php esc_html_e('Современная стоматологическая клиника с передовыми технологиями лечения и заботливым персоналом.', 'dental-clinic'); ?></p>
            </div>
            
            <div class="footer-widget">
                <h4><?php esc_html_e('Контакты', 'dental-clinic'); ?></h4>
                <p>
                    <strong><?php esc_html_e('Телефон:', 'dental-clinic'); ?></strong><br>
                    <a href="tel:+79991234567">+7 (999) 123-45-67</a>
                </p>
                <p>
                    <strong><?php esc_html_e('Адрес:', 'dental-clinic'); ?></strong><br>
                    <?php esc_html_e('г. Москва, ул. Примерная, д. 1', 'dental-clinic'); ?>
                </p>
            </div>
            
            <div class="footer-widget">
                <h4><?php esc_html_e('Режим работы', 'dental-clinic'); ?></h4>
                <p>
                    <?php esc_html_e('Пн-Пт: 9:00 - 20:00', 'dental-clinic'); ?><br>
                    <?php esc_html_e('Сб: 10:00 - 18:00', 'dental-clinic'); ?><br>
                    <?php esc_html_e('Вс: Выходной', 'dental-clinic'); ?>
                </p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Все права защищены.', 'dental-clinic'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
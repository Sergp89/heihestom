</div><!-- #content -->

<!-- Floating Buttons -->
<div class="floating-buttons">
    <button class="floating-btn feedback-btn" id="feedback-btn" aria-label="<?php esc_attr_e('Обратная связь', 'dental-clinic'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </button>
    <button class="floating-btn back-to-top-btn" id="back-to-top-btn" aria-label="<?php esc_attr_e('Вернуться наверх', 'dental-clinic'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
</div>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-widget">
                <h4><?php esc_html_e('О клинике', 'dental-clinic'); ?></h4>
                <p><?php esc_html_e('Современная стоматологическая клиника с передовыми технологиями лечения и заботливым персоналом.', 'dental-clinic'); ?></p>
            </div>
            
            <div class="footer-widget">
                <h4><?php esc_html_e('Контакты', 'dental-clinic'); ?></h4>
                <ul class="contact-list">
                    <li>
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <strong><?php esc_html_e('Телефон:', 'dental-clinic'); ?></strong>
                            <span><a href="tel:+79991234567">+7 (999) 123-45-67</a></span>
                        </div>
                    </li>
                    <li>
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <strong><?php esc_html_e('Адрес:', 'dental-clinic'); ?></strong>
                            <span><?php esc_html_e('г. Москва, ул. Примерная, д. 1', 'dental-clinic'); ?></span>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="footer-widget">
                <h4><?php esc_html_e('Режим работы', 'dental-clinic'); ?></h4>
                <ul class="contact-list">
                    <li>
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <strong><?php esc_html_e('Пн-Пт:', 'dental-clinic'); ?></strong>
                            <span><?php esc_html_e('9:00 - 20:00', 'dental-clinic'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <strong><?php esc_html_e('Сб:', 'dental-clinic'); ?></strong>
                            <span><?php esc_html_e('10:00 - 18:00', 'dental-clinic'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <strong><?php esc_html_e('Вс:', 'dental-clinic'); ?></strong>
                            <span><?php esc_html_e('Выходной', 'dental-clinic'); ?></span>
                        </div>
                    </li>
                </ul>
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
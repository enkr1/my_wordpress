<button id="ham-menu" type="button" class="p-0 bg-none d-block d-lg-none" data-custom-open="menu-modal">
    <div class="at-hb-menu">
        <div class="at-hb-menu--icon"></div>
    </div>
</button>

<!-- [1] -->
<div class="modal micromodal-slide" id="menu-modal" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container w-100" role="dialog" aria-modal="true" aria-labelledby="menu-modal-title">
            <header class="modal__header d-flex justify-content-end">
                <button class="modal__close" aria-label="<?php esc_attr_e('Close modal', 'aspro'); ?>" data-custom-close="menu-modal"></button>
            </header>
            <main class="modal__content" id="menu-modal-content">
                <div class="h-100">
                    <div class="row justify-content-end align-items-center h-100 m-0">
                        <div id="ham-navigation" class="at-ham-nav">
                            <nav id="site-navigation" class="at-ham-navigation">
                                <?php
                                wp_nav_menu([
                                    'theme_location' => 'menu-1',
                                    'menu_id' => 'primary-menu',
                                ]);
                                ?>
                            </nav><!-- #site-navigation -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

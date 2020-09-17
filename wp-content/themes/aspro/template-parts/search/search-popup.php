<button role="button" title="Search" class="btn btn--icon p-0 bg-none l-h-0 mr-3 mr-lg-0" data-custom-open="search-modal">
    <svg class="at-icon at-icon--md" id="search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.005 512.005"><path d="M505.749 475.587l-145.6-145.6c28.203-34.837 45.184-79.104 45.184-127.317C405.333 90.926 314.41.003 202.666.003S0 90.925 0 202.669s90.923 202.667 202.667 202.667c48.213 0 92.48-16.981 127.317-45.184l145.6 145.6c4.16 4.16 9.621 6.251 15.083 6.251s10.923-2.091 15.083-6.251c8.341-8.341 8.341-21.824-.001-30.165zM202.667 362.669c-88.235 0-160-71.765-160-160s71.765-160 160-160 160 71.765 160 160-71.766 160-160 160z"/>
    </svg>
</button>

<!-- [1] -->
<div class="modal micromodal-slide" id="search-modal" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container w-100" role="dialog" aria-modal="true" aria-labelledby="search-modal-title">
            <header class="modal__header d-flex justify-content-end">
                <button class="modal__close" aria-label="<?php esc_attr_e('Close modal', 'aspro'); ?>" data-custom-close="search-modal"></button>
            </header>
            <main class="modal__content" id="search-modal-content">
                <div class="at-search">
                    <div class="at-container h-100">
                        <div class="row justify-content-center align-items-center h-100 m-0">
                            <div class="at-search--form">
                                <form role="search" method="GET">
                                    <label class="m-0">
                                        <span class="screen-reader-text"><?php esc_html_e('Search for', 'aspro'); ?>:</span>
                                        <input type="search"
                                               id="custom-search-popup"
                                               class="search-field"
                                               placeholder="<?php esc_attr_e('Start Typing ...', 'aspro'); ?>"
                                               value=""
                                               name="s"/>
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

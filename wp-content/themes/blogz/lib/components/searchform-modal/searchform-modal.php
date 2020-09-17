<?php
/**
 * Search form modal.
 *
 * @package Gt Addons
 */
function blogz_searchform_modal() {
	?>

<div class="header__search">
	<a href="#" class="search-toggle"><i class="fa fa-search"></i></a>
	<div class="search-popup">
		<div class="search-popup-bg"></div>
		<div class="search-form-wrap">
			<?php get_search_form(); ?>
			<button class="close-search-toggle">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVBAMAAABbObilAAAAMFBMVEVMaXH////////////////////////////////////////////////////////////6w4mEAAAAD3RSTlMAlAX+BKLcA5+b6hJ7foD4ZP1OAAAAkUlEQVR4XkWPoQ3CUBQAL4SktoKAbCUjgAKLJZ2ABYosngTJCHSD6joUI6BZgqSoB/+Shqde7sS9x3OGk81fdO+texMtRVTia+TsQtHEUJLdohJfgNNPJHyEJPZTsWLoxShqsWITazEwqePAn69Sw2TUxk1+euPis3EwaXy8RMHSZBIlRcKKnC5hRctjMf57/wJbBlAIs9k1BAAAAABJRU5ErkJggg==">
			</button>
		</div>

	</div>
</div>

	<?php
}

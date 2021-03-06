<?php
/**
 * View: Month View Nav Disabled Next Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/mobile-events/nav/next-disabled.php
 *
 * See more documentation about our views templating system.
 *
 * @package nightingale
 *
 * @var string $link The URL to the next page, if any, or an empty string.
 * @var string $label The label for the next link.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-nav__list-item tribe-events-c-nav__list-item--next">
	<button
		class="tribe-events-c-nav__next tribe-common-b2"
		aria-label="
		<?php
		echo esc_attr(
			sprintf(
				/* translators: %s: Name of current category */
				__(
					'Next month, %1$s',
					'nightingale'
				),
				$label
			)
		);
		?>
		"
		title="
		<?php
		echo esc_attr(
			sprintf(
				/* translators: %s: Name of current category */
				__(
					'Next month, %1$s',
					'nightingale'
				),
				$label
			)
		);
		?>
		"
		disabled
	>
		<?php echo esc_html( $label ); ?>
	</button>
</li>

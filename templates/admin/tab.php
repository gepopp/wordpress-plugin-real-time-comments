<?php
/**
 * @var $id
 * @var $section
 * @var $page
 */
?>
<div class="rtc-tab" data-tab="<?php echo $id ?>">
	<?php settings_fields( $section ); ?>
	<?php do_settings_sections( $page ); ?>
</div>
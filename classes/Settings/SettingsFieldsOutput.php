<?php

namespace RealTimeComments\Settings;

trait SettingsFieldsOutput {

	public function rtc_settings_color_picker( $args ) {
		$options = get_option( 'rtc_general_settings' );
		?>
        <input type="<?php echo $args['type'] ?>"
               id="<?php echo $args['name'] ?>"
               name="rtc_general_settings[<?php echo $args['name'] ?>]"
               value="<?php echo $options[ $args['name'] ] ?? '' ?>"
               class="regular-text color-picker"
			<?php echo isset( $args['placeholder'] ) ? 'placeholder="' . $args['placeholder'] . '" ' : '' ?>
        />
		<?php
		if ( isset( $args['label'] ) ) {
			echo $args['label'];
		}

	}

	public function rtc_settings_radio_field( $args ) {
		// First, we read the options collection
		$options = get_option( 'rtc_general_settings' );

		foreach ( $args['options'] as $option ) {
			?>
            <div>
                <label>
                    <input type="radio" name="rtc_general_settings[<?php echo $args['name'] ?>]" value="<?php echo $option['value'] ?>"
						<?php checked( $options[ $args['name'] ] ?? 'ajax', $option['value'], true ) ?>
                    >
					<?php echo $option['label'] ?>
                </label>
            </div>

			<?php
		}
	}


	public function rtc_settings_input_field( $args ) {
		// First, we read the options collection
		$options = get_option( 'rtc_general_settings' );
		?>
        <input type="<?php echo $args['type'] ?>"
               id="<?php echo $args['name'] ?>"
               name="rtc_general_settings[<?php echo $args['name'] ?>]"
               value="<?php echo $options[ $args['name'] ] ?? '' ?>"
               class="regular-text"
			<?php echo isset( $args['placeholder'] ) ? 'placeholder="' . $args['placeholder'] . '" ' : '' ?>
        />
		<?php
		if ( isset( $args['label'] ) ) {
			echo $args['label'];
		}
	}

}
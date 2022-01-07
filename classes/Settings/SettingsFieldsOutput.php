<?php

namespace RealTimeComments\Settings;

use RealTimeComments\Options;



trait SettingsFieldsOutput {






	public function rtc_settings_color_picker( $args ) {

		?>
        <input type="<?php echo esc_attr( $args['type'] ) ?>"
               id="<?php echo esc_attr( $args['name'] ) ?>"
               name="<?php echo esc_attr( $args['name'] ) ?>"
               value="<?php echo  esc_attr( $args['value'] ) ?>"
               class="regular-text color-picker"
			<?php echo isset( $args['placeholder'] ) ? 'placeholder="' . esc_attr( $args['placeholder'] ) . '" ' : '' ?>
        />
		<?php
		if ( isset( $args['label'] ) ) {
			echo wp_kses( $args['label'] );
		}

	}





	public function rtc_settings_radio_field( $args ) {

		foreach ( $args['options'] as $option ) {
			?>
            <div>
                <label>
                    <input type="radio" name="<?php echo esc_attr( $args['name'] ) ?>"
                           value="<?php echo esc_attr( $option['value'] ) ?>"
						<?php checked( $args['value'], $option['value'], true ) ?>
                    >
					<?php echo $option['label'] ?>
                </label>
            </div>

			<?php
		}
	}





	public function rtc_settings_input_field( $args ) {

		?>
        <input type="<?php echo esc_attr( $args['type'] ) ?>"
               id="<?php echo esc_attr( $args['name'] ) ?>"
               name="<?php echo esc_attr( $args['name'] ) ?>"
               value="<?php echo esc_attr( $args['value'] ) ?>"
               class="regular-text"
			<?php echo isset( $args['placeholder'] ) ? 'placeholder="' . esc_attr( $args['placeholder'] ) . '" ' : '' ?>
        />
		<?php
		if ( isset( $args['label'] ) ) {
			echo esc_attr( $args['label'] );
		}
	}

}
<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pistepro.com/
 * @since      1.0.0
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php if (is_admin()) : ?>
	<div class="wrap" id="bdpp_admin">
		<h1><?php _e('Snow Forecast - Piste Pro', 'snow-forecast'); ?></h1>
		<p><?php _e('Customise our snow forecast widget for free in a few simple steps.', 'snow-forecast'); ?></p>
		<hr />
	</div>

	<div class="bdpp-contact-form">
		<div class="bdpp-WidgetWizard_widgetWizard">
			<div class="bdpp-WidgetWizard_col_left">
				<form method="post" action="options.php"  >
					<div class="bdpp-WidgetWizard_form_item">
						<p><strong>Select Country</strong></p><select id="bdpp-widget-country" name="snow-forecast_country">
							<option value="">Select Country</option>
							<?php
                            for ($i = 0; $i < count($var["api-data"]["countries"]); $i++) {
                                $country = $var["api-data"]["countries"][$i];
                                if ($var["country"] == $country["name"]) {
                                    echo '<option value="' . esc_attr($country["name"]) . '" selected>' . esc_html($country["name"]) . '</option>';
                                } else {
                                    echo '<option value="' . esc_attr($country["name"]) . '">' . esc_html($country["name"]) . '</option>';
                                }
                            }

                            ?>
						</select>
					</div>
					<div class="bdpp-WidgetWizard_form_item">
						<p><strong>Select resort</strong></p><select id="bdpp-widget-resort" name="snow-forecast_resort_encoded">
							<option value="">Select Resort</option>
							<?php
                            for ($i = 0; $i < count($var["api-data"]["resorts"]); $i++) {
                                $resorts = $var["api-data"]["resorts"][$i];
                                if ($var["country"] == $resorts["country"]) {
                                    if ($var["resort_encoded"] == $resorts["encoded_name"]) {
                                        echo '<option value="' . esc_attr($resorts["encoded_name"]) . '" selected>' . esc_html($resorts["name"]) . '</option>';
                                    } else {
                                        echo '<option value="' . esc_attr($resorts["encoded_name"]) . '">' . esc_html($resorts["name"]) . '</option>';
                                    }
                                }
                            }
                            ?>
						</select>
					</div>
					<div class="bdpp-WidgetWizard_spacer"></div>
					<div class="bdpp-WidgetWizard_form_item">
						<p><strong>Pick measurement units</strong></p>
						<div class="bdpp-WidgetWizard_radio_group">
							<div><label><input type="radio" id="bdpp-units" name="snow-forecast_units" value="imperial" <?php if ($var["units"] == "imperial") {
                                echo "checked";
                            } ?>>Imperial (ft, mph, Fº)</label></div>
							<div><label><input type="radio" id="bdpp-units" name="snow-forecast_units" value="metric" <?php if ($var["units"] == "metric") {
                                echo "checked";
                            } ?>>Metric (m, km/h, Cº)</label></div>
						</div>
					</div>
					<div class="bdpp-WidgetWizard_spacer"></div>
					<div class="bdpp-WidgetWizard_form_item">
						<p><strong>Choose size/layout</strong></p>
						<div class="bdpp-WidgetWizard_radio_group">
							<div><label><input type="radio" id="bdpp-square" name="snow-forecast_size" value="2" <?php if ($var["size"] == 2) {
                                echo "checked";
                            } ?>>300x250px</label></div>
							<div><label><input type="radio" id="bdpp-landscape" name="snow-forecast_size" value="1" <?php if ($var["size"] == "1") {
                                echo "checked";
                            } ?>>468x60</label></div>
							<div><label><input type="radio" id="bdpp-skyscrapper" name="snow-forecast_size" value="0" <?php if ($var["size"] == "0") {
                                echo "checked";
                            } ?>>120x600</label></div>
						</div>
					</div>
					<div class="bdpp-WidgetWizard_form_item">
						<p><strong>Offer full forecast link</strong></p>
						<div class="bdpp-WidgetWizard_radio_group">
							<div><label><input type="radio" id="bdpp-yes" name="snow-forecast_link" value="yes" <?php if ($var["link"] == "yes" or $var["link"] == false) {
                                echo "checked";
                            } ?>>yes</label></div>
							<div><label><input type="radio" id="bdpp-no" name="snow-forecast_link" value="no" <?php if ($var["link"] == "no") {
                                echo "checked";
                            } ?>>no</label></div>
						</div>
					</div>
					<input type="hidden" name="bdpp-widget-resort-name" id="bdpp-widget-resort-name" value="<?php echo esc_attr($var["resort"]); ?>" />
					<?php
                    settings_fields('snow-forecast-settings-group');
                    submit_button(_('Preview and get Shortcode', 'snow-forecast'));
                    ?>
				</form>
				<hr />
				<div class="bdpp-WidgetWizard_shortcode">
					<div>
						<p>Shortcode:</p>
						<textarea id="bdpp-WidgetWizard_shortcode-text"></textarea>
					</div>
					<button class="button button-primary bdpp-WidgetWizard_copy_code">Copy shortcode to Clipboard</button>
				</div>
			</div>
			<div class="bdpp-WidgetWizard_col_right">
				<p>Widget preview</p>
				<div class="bdpp-WidgetWizard_widget_preview">
				</div>
			</div>
		</div>
	</div>
	<?php

    $script = 'var resorts_list = '. json_encode($var["api-data"]["resorts"]);

    wp_register_script('resort-script', '');
    wp_enqueue_script('resort-script');
    wp_add_inline_script('resort-script', $script, 'before');
    ?>
<?php endif ?>
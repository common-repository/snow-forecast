<?php
// Creating the widget
class BDPP_snow_forecast_widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'BDPP_snow_forecast_widget',

            // Widget name will appear in UI
            __('Snow Forecast - Piste Pro Widget', 'snow-forecast'),

            // Widget description
            array('description' => __('Snow Forecast - Piste Pro Widget', 'snow-forecast'),)
        );
    }



    // Creating widget front-end

    public function widget($args, $instance)
    {
        $raw_name_and_encoded = explode('|', $instance['resort']);
        $size = $instance['size'];
        $link = $instance['link'];
        $units = $instance['units'];
        $resort = $raw_name_and_encoded[0];
        $res_name = $raw_name_and_encoded[1];
        echo do_shortcode('[snow-forecast-widget size="' . esc_attr($size) . '" units="' . esc_attr($units) . '" resort="' . esc_attr($resort) . '" res_name="' . esc_attr($res_name) . '" link="' . esc_attr($link) . '"]'); ?>
    <?php
    }

    // Widget Backend
    public function form($instance)
    {
        $api_data = $this->get_data("GET", "https://pistepro.com/widget/data");
        $countries = $api_data['countries'];
        $resorts = $api_data['resorts'];


        if (isset($instance['resort'])) {
            $resort = $instance['resort'];
        } else {
            $resort = $resorts[0]["encoded_name"] ."|". $resorts[0]["name"];
        }
            

        if (isset($instance['units'])) {
            $units = $instance['units'];
        } else {
            $units = "imperial";
        }

        if (isset($instance['size'])) {
            $size = $instance['size'];
        } else {
            $size = "2";
        }

        if (isset($instance['link'])) {
            $link = $instance['link'];
        } else {
            $link = "no";
        } ?>

        <label for="bdpp-widget-resort"><?php _e('Select resort:'); ?></label>
        <select id="bdpp-widget-resort" name="<?php echo esc_attr($this->get_field_name('resort')); ?>">
            <?php
            for ($j = 0; $j < count($countries); $j++) {
                $c = $countries[$j];
                for ($i = 0; $i < count($resorts); $i++) {
                    $r = $resorts[$i];
                    if ($c["name"] == $r["country"]) {
                        if ($resort == $r["encoded_name"]) {
                            echo '<option value="' .  esc_attr($r["encoded_name"] ."|". $r["name"]) . '" selected>' .  esc_html($r["country"] . " - " . $r["name"]) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($r["encoded_name"] ."|". $r["name"]). '">' .  esc_html($r["country"] . " - " . $r["name"]) . '</option>';
                        }
                    }
                }
            } ?>
        </select>

        <label for="<?php echo esc_attr($this->get_field_id('units')); ?>"><?php _e('Pick measurement units:'); ?></label>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('units')); ?>" value="imperial" <?php if ($units == "imperial") {
                echo "checked";
            } ?>>Imperial (ft, mph, Fº)</label></div>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('units')); ?>" value="metric" <?php if ($units == "metric") {
                echo "checked";
            } ?>>Metric (m, km/h, Cº)</label></div>

        <label for="<?php echo esc_attr($this->get_field_id('size')); ?>"><?php _e('Choose size/layout:'); ?></label>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('size')); ?>" value="2" <?php if ($size == "2") {
                echo "checked";
            } ?>>300x250px</label></div>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('size')); ?>" value="1" <?php if ($size == "1") {
                echo "checked";
            } ?>>468x60px</label></div>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('size')); ?>" value="0" <?php if ($size == "0") {
                echo "checked";
            } ?>>120x600px</label></div>

        <label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php _e('Offer full forecast link:'); ?></label>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('link')); ?>" value="yes" <?php if ($link == "yes") {
                echo "checked";
            } ?>>yes</label></div>
        <div><label><input type="radio" name="<?php echo esc_attr($this->get_field_name('link')); ?>" value="no" <?php if ($link == "no") {
                echo "checked";
            } ?>>no</label></div>                                                                                                     
        
<?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['resort'] = (!empty($new_instance['resort'])) ? strip_tags($new_instance['resort']) : '';
        $instance['units'] = (!empty($new_instance['units'])) ? strip_tags($new_instance['units']) : '';
        $instance['size'] = (!empty($new_instance['size'])) ? strip_tags($new_instance['size']) : '0';
        $instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : '';
        
        return $instance;
    }

    private function get_data($method, $url, $data = false)
    {
        $json_local_data = file_get_contents(plugin_dir_path(dirname(__FILE__)) . 'admin/data.json');

        return json_decode($json_local_data, true);
    }
}

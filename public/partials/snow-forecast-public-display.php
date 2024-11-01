<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://pistepro.com/
 * @since      1.0.0
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/public/partials
 */
?>

<?php

if ($atts == null
    || !array_key_exists("size", $atts)
    || !array_key_exists("link", $atts)
    || !array_key_exists("units", $atts)
    || !array_key_exists("resort", $atts)
    || !array_key_exists("res_name", $atts)
    || $atts["size"] == null
    || $atts["link"] == null
    || $atts["units"] == null
    || $atts["resort"] == null
    || $atts["res_name"] == null
    ) {
    return;
}

$size = $atts['size'];
$units = $atts['units'];
$resort = $atts['resort'];
$resortName = $atts['res_name'];
$link = $atts['link'] !== 'no';
$siteUrl = "https://pistepro.com/";
$widgetURL = $siteUrl.'widget/?w='.$size.'&u='.$units.'&resort='.$resort;
$showButton = false;
$showButtonUp = true;
$widgetClass = "";

switch ($size) {
    case 0:
        $height = "490";
        $width = "120";
        $holderHeight = 620;
        $widgetClass = "skyscrapper";
        break;
    case "1":
        $height = "60";
        $width = "370";
        $holderHeight = 80;
        $showButton = true;
        $showButtonUp = false;
        $widgetClass = "landscape";
        $buttonUp = '';
        break;
    case "2":
        $height = "180";
        $width = "300";
        $holderHeight = 270;
        $widgetClass = "square";
        break;
    default:
        $height = "180";
        $width = "300";
        $holderHeight = 270;
        $widgetClass = "square";
        break;
}

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="bdpp-snow-forecaset-<?php echo esc_attr($widgetClass); ?>-widget">
    <div class="bdpp-snow-forecaset-<?php echo esc_attr($widgetClass); ?>-widget-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <iframe style="border:none;" height="<?php echo esc_attr($height); ?>" width="<?php echo esc_attr($width); ?>}" allowtransparency="allowtransparency" src="<?php echo esc_attr($widgetURL); ?>" title="Pistepro"></iframe>
    <div class="bdpp-snow-forecaset-<?php echo esc_attr($widgetClass); ?>-widget-footer">
        <!--- Upper Button-->
        <?php if (!$link): ?>
            <div class="bdpp-btnUp"></div>
        <?php elseif ($showButtonUp): ?>
            <div class="bdpp-btnUp"><a target="_blank" class="bdpp-snow-forecaset-footer-button" href="<?php echo esc_attr($siteUrl); ?>snow-forecast/<?php echo esc_attr($resort); ?>"><?php echo esc_html($resortName); ?> snow forecast</a></div>
        <?php endif; ?>
        <!--- Upper Button-->
        <a  class="bdpp-snow-forecaset-footer-logo" ><img src="<?php echo esc_attr($siteUrl);?>assets/img/logo-complete-200px.webp" alt="Pistepro"></a>
        <span class="bdpp-snow-forecaset-footer-disclaimer">data supplied by <a >myforecast.com</a></span>

        <!--- Lower Button-->
        <?php if ($link && $showButton): ?>
            <a target="_blank" class="bdpp-snow-forecaset-footer-button"  href="<?php echo esc_attr($siteUrl); ?>snow-forecast/<?php echo esc_attr($resort); ?>">View Details</a>
        <?php endif; ?>
        <!--- Lower Button-->
        
    </div>
</div>
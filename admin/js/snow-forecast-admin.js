window.addEventListener('DOMContentLoaded', function() {
(function ($) {
	'use strict';



	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(window).load(function () {

		// get initial resorts
		
		// update resorts on change
		$('#bdpp-widget-country').change(bdpp_get_resorts);
		
		//console.log($('#widget-country'));
		
		$('#bdpp-widget-resort').change(bdpp_set_resort_name);

		//#select all
		$('#bdpp-WidgetWizard_shortcode-text').click(function (event) {
			event.target.select();
			console.log(event.target.select);
		}
		);

		// copy shortcode to clipboard
		$('.bdpp-WidgetWizard_copy_code').click(function () {
			let toClipboard = $('#bdpp-WidgetWizard_shortcode-text').val();
			$('#bdpp-WidgetWizard_shortcode-text').select();
			navigator.clipboard.writeText(toClipboard);
		});

		// show widget
		bdppBuildWidgetCodeHTML();

		function bdpp_set_resort_name() {
			let resort_name = $('#bdpp-widget-resort option:selected').text();
			console.log(resort_name);
			$('#bdpp-widget-resort-name').val(resort_name);
		}

		function bdpp_get_resorts() {
			
			let country = $('#bdpp-widget-country').val();

			let filtered_resorts = resorts_list.filter(function (resort) {
				return resort.country == country;
			});

			let default_option = '<option value="">Select a resort</option>';

			$('#bdpp-widget-resort').html(default_option);

			filtered_resorts.forEach(function (resort) {
				let option = '<option value="' + resort.encoded_name + '">' + resort.name + '</option>';
				$('#bdpp-widget-resort').append(option);
			});
		}




	});


	const bdppBuildWidgetCodeHTML = () => {

		let resort = $('#bdpp-widget-resort').val();
		let resortName = $('#bdpp-widget-resort option:selected').text();
		let size = $("input[name='snow-forecast_size']:checked").val();
		let units = $("input[name='snow-forecast_units']:checked").val();
		let link = $("input[name='snow-forecast_link']:checked").val();

		if (resort == '') {
			$('.bdpp-WidgetWizard_widget_preview').html('<p>Please select a resort</p>');
			$('.bdpp-WidgetWizard_shortcode').hide();
			return;
		}

		const siteUrl = "https://pistepro.com";
		let widgetURL = `${siteUrl}/widget/?w=${size}&resort=${resort}&u=${units}`;

		let code = "";

		let height = 0;
		let width = 0;
		let holderHeight = 60;

		let stylesheet = "";
		let button = "";
		let buttonUp = "";
		let widgetClass = "";


		switch (size) {
			case "0":
				height = "490";
				width = "120";
				holderHeight = 620;
				buttonUp = `<div class="bdpp-btnUp"><a target="_blank" class="bdpp-snow-forecaset-footer-button" href="${siteUrl + "/snow-forecast/" + resort}">${resortName} snow forecast</a></div>`;

				widgetClass = "skyscrapper";
				break;
			case "1":
				height = "60";
				width = "370";
				holderHeight = 80;
				button = `<a target="_blank" class="bdpp-snow-forecaset-footer-button" href="${siteUrl + "/snow-forecast/" + resort}">View Details</a>`;

				widgetClass = "landscape";
				break;
			case "2":
				height = "180";
				width = "300";
				holderHeight = 270;
				buttonUp = `<div class="bdpp-btnUp"><a target="_blank" class="bdpp-snow-forecaset-footer-button" href="${siteUrl + "/snow-forecast/" + resort}">${resortName} snow forecast</a></div>`;

				widgetClass = "square";
				break;
			default:
				height = "180";
				width = "300";
				holderHeight = 270;
				buttonUp = `<div class="bdpp-btnUp"><a target="_blank" class="bdpp-snow-forecaset-footer-button" href="${siteUrl + "/snow-forecast/" + resort}">${resortName} snow forecast</a></div>`;

				widgetClass = "square";
				break;
		}

		if(link == "no"){
			buttonUp = '<div class="bdpp-btnUp"></div>';
			button = "";
		}


		code += `${stylesheet}
                <div class="bdpp-snow-forecaset-${widgetClass}-widget">
                <div class="bdpp-snow-forecaset-${widgetClass}-widget-loader"><div></div><div></div><div></div></div>
                <iframe height="${height}" width="${width}" allowtransparency="allowtransparency"  src="${widgetURL}" title="Pistepro"></iframe>
        <div class="bdpp-snow-forecaset-${widgetClass}-widget-footer">
                        ${buttonUp}
                        <a class="bdpp-snow-forecaset-footer-logo"><img src="${siteUrl}/assets/img/logo-complete-200px.webp" alt="Pistepro"></a>
                        <span class="bdpp-snow-forecaset-footer-disclaimer">data supplied by <a>myforecast.com</a></span>
                        ${button}
                    </div>
        </div>`;

		code = code.replace(/\s\s+/g, ' ');
		console.log($('.bdpp-WidgetWizard_widget_preview'));
		$('.bdpp-WidgetWizard_widget_preview').html(code);
		
		bdppUpdateWpShortCode();
	}

	const bdppUpdateWpShortCode = () => {

		let resort = $('#bdpp-widget-resort').val();
		if(resort == '') {
			$('#bdpp-WidgetWizard_shortcode-text').val('');
			return;
		}
		let size = $("input[name='snow-forecast_size']:checked").val();
		let units = $("input[name='snow-forecast_units']:checked").val();
		let resortName = $('#bdpp-widget-resort option:selected').text();
		let link = $("input[name='snow-forecast_link']:checked").val();
		let wpShortCode = `[snow-forecast-widget size="${size}" units="${units}" resort="${resort}" res_name="${resortName}" link="${link}"]`;
		$('.bdpp-WidgetWizard_shortcode').show();
		$('#bdpp-WidgetWizard_shortcode-text').val(wpShortCode);
	}


})(jQuery);
});
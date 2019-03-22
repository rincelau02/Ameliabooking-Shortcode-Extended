<?php
/*
Plugin Name: Amelia Shortcode Extended
Plugin URI: https://wpamelia.com/
Description: This is for Amelia extended using shortcode for calendar in the backend to be able to use in the frontend
Version: 1.1
Author: Laurince G. Quijano
Author URI: https://laurincequijano.com/
Text Domain: wpamelia
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\WP\Translations\BackendStrings;

function amelia_calendar( $atts ){

    if ( is_plugin_active( 'ameliabooking/ameliabooking.php' ) ) {
        return 'Amelia Booking need to be install first';
        exit();
    }

    wp_enqueue_script(
        'amelia_booking_scripts',
        AMELIA_URL . 'public/js/backend/amelia-booking.js',
        [],
        AMELIA_VERSION
    );

    if ($page === 'wpamelia-locations' || $page === 'wpamelia-settings') {
        wp_enqueue_script(
            'google_maps_api',
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyBbdMvZlipNEI2JgauxTv37tgWoAMUGkZQ&libraries=places'
        );
    }

    // Enqueue Styles
    wp_enqueue_style(
        'amelia_booking_styles',
        AMELIA_URL . 'public/css/backend/amelia-booking.css',
        [],
        AMELIA_VERSION
    );

    // WordPress enqueue
    wp_enqueue_media();

    wp_localize_script(
        'amelia_booking_scripts',
        'localeLanguage',
        AMELIA_LOCALE
    );

    wp_localize_script(
        'amelia_booking_scripts',
        'wpAmeliaLabels',
        array_merge(
            BackendStrings::getEntityFormStrings(),
            BackendStrings::getCommonStrings(),
            BackendStrings::getAppointmentStrings(),
            BackendStrings::getUserStrings(),
            BackendStrings::getCustomerStrings(),
            BackendStrings::getCalendarStrings(),
            BackendStrings::getPaymentStrings()
        )
    );

    wp_deregister_script('jquery');

    echo '<script type="text/javascript">
		/* <![CDATA[ */
			var wpAmeliaSettings = {"capabilities":{"canRead":true,"canReadOthers":true,"canWrite":true,"canWriteOthers":true,"canDelete":true,"canWriteStatus":false},"daysOff":[],"general":{"itemsPerPage":12,"phoneDefaultCountryCode":"us","timeSlotLength":1800,"serviceDurationAsSlot":true,"defaultAppointmentStatus":"pending","gMapApiKey":"","addToCalendar":true,"requiredPhoneNumberField":false,"numberOfDaysAvailableForBooking":365,"showClientTimeZone":false,"redirectUrlAfterAppointment":""},"googleCalendar":{"clientID":"","clientSecret":""},"notifications":{"senderName":"","senderEmail":"","notifyCustomers":true,"cancelSuccessUrl":null,"cancelErrorUrl":null,"smsSignedIn":false},"payments":{"currency":"EUR","priceSymbolPosition":"before","priceNumberOfDecimals":2,"priceSeparator":2,"defaultPaymentMethod":"onSite","onSite":true,"coupons":true,"payPal":{"enabled":false,"sandboxMode":false,"testApiClientId":"","liveApiClientId":""},"stripe":{"enabled":false,"testMode":false,"livePublishableKey":"","testPublishableKey":""},"wc":{"enabled":false}},"role":"admin","weekSchedule":[{"day":"Monday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Tuesday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Wednesday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Thursday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Friday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Saturday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]},{"day":"Sunday","time":["9:00","22:00"],"periods":[{"time":["09:00","22:00"]}],"breaks":[]}],"wordpress":{"dateFormat":"j F Y","timeFormat":"H:i","startOfWeek":1},"labels":{"enabled":true},"roles":{"allowConfigureSchedule":false,"allowConfigureDaysOff":false,"allowConfigureSpecialDays":false,"allowWriteAppointments":false,"automaticallyCreateCustomer":true,"inspectCustomerInfo":true},"customization":{"primaryColor":"#1A84EE","primaryGradient1":"#1A84EE","primaryGradient2":"#0454A2","textColor":"#354052","textColorOnBackground":"#FFFFFF","font":"Lato"}};
			var localeLanguage = "nl_NL";
		/* ]]> */
    </script>
    <script>
	  var wpAmeliaPluginURL = "'.AMELIA_URL.'"
	  var wpAmeliaPluginAjaxURL = "'.AMELIA_ACTION_URL.'"
	  var menuPage = "wpamelia-calendar"
	</script>';

	return '<div id="amelia-app-backend" class="amelia-booking">
		  <transition name="fade">
		    <router-view></router-view>
		  </transition>
		</div>

		<style type="text/css">
			.am-page-header {
				display: none !important;
			}
		</style>
    '; ?>
	
<?php
}
add_shortcode( 'amelia_calendar', 'amelia_calendar' );
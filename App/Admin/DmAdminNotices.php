<?php
/**
 * Show Admin Messages and Notifications.
 */

namespace Ddev\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DmAdminNotices {

    /**
     * Show no script Message if user disabled JS.
     * @since 1.0.0
     *
     * @return void
     */
    public function show_dm_no_script_message(): void
    {
        echo '<noscript><div class="dm-no-js">' .
            esc_html__( 'Please enable JavaScript to use this plugin.', 'ddev' ) .
            '</div></noscript>';
    }

    /**
     * Displays the notification message.
     *
     * @param string $type Class name for notification success | error | warning.
     * @param string $message Message of the notification.
     * @return void Message
     *@since 1.0.0
     */
    public function show_dm_admin_notice(string $type, string $message ): void
    {
        $notify_class = 'notice-' . $type;
        if ( '' !== $message ) {
            $formatted_message = sprintf(
                '<div class="notice %s is-dismissible">
					<p>%s</p>
				</div>',
                esc_attr( $notify_class ),
                esc_html( $message )
            );
            echo wp_kses_post( $formatted_message );
        }
    }

}

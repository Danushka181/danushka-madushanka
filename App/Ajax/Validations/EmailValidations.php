<?php
/**
 * Validate Emails address before save to database.
 *
 * @since 1.0.0
 */

namespace Ddev\Ajax\Validations;

class EmailValidations {

	/**
	 * Email address.
	 */
	private string $email_address;
	public function __construct( $email) {
		$this->email_address = $email;
	}

	/**
	 * Check email is valid or invalid.
	 * @return bool
	 */
	public function is_valid_email_address(): bool {
		if ( preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->email_address ) ) {
			return true;
		} else {
			return false;
		}
	}

}
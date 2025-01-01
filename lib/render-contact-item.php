<?php
/**
 * Render contact address.
 */
function render_contact_address($slug, $address) {
	if (!empty($address)) {
		echo '<p class="' . esc_attr($slug) . '__item-address">';
		echo '<span>' . __('Address:', THEME_TD) . '</span>';
		echo esc_html($address);
		echo '</p>';
	}
}

/**
 * Render contact phones.
 */
function render_contact_phones($slug, $phones) {
	if (empty($phones) || !is_array($phones)) {
		return;
	}

	echo '<ul class="' . esc_attr($slug) . '__item-phones">';
	foreach ($phones as $phone_item) {
		render_single_phone($slug, $phone_item['phone'] ?? '');
	}
	echo '</ul>';
}

/**
 * Render a single phone item.
 */
function render_single_phone($slug, $phone) {
	if (empty($phone)) {
		return;
	}

	$phone_link = preg_replace('/[^0-9+]/', '', $phone);
	echo '<li class="' . esc_attr($slug) . '__item-phones-item">';
	echo '<span>' . __('Phone:', THEME_TD) . '</span>';
	echo '<a class="dynamic-phone-link" href="tel:' . esc_attr($phone_link) . '" data-phone="' . esc_attr($phone_link) . '">';
	echo esc_html($phone);
	echo '</a></li>';
}

/**
 * Render contact emails.
 */
function render_contact_emails($slug, $emails) {
	if (!empty($emails) && is_array($emails)) {
		echo '<ul class="' . esc_attr($slug) . '__item-emails">';
		foreach ($emails as $email) {
			echo '<li class="' . esc_attr($slug) . '__item-emails-item">';
			echo '<span>' . __('Email:', THEME_TD) . '</span>';
			echo '<a href="mailto:' . esc_attr($email['email']) . '">';
			echo esc_html($email['email']);
			echo '</a></li>';
		}
		echo '</ul>';
	}
}

/**
 * Render contact item.
 */
function render_contact_item($slug, $contacts) {
	if ($contacts) {
		render_contact_address($slug, $contacts['address'] ?? '');
		render_contact_phones($slug, $contacts['phones'] ?? []);
		render_contact_emails($slug, $contacts['emails'] ?? []);
	}
}

<?php


namespace calderawp\omni;


/**
 * Utility for collections of fields used across classes
 *
 * @package calderawp\omni
 * Copyright 2017 Josh Pollock <Josh@CalderaWP.com
 */
class Fields {

	/**
	 *  Fields for CC charge details
	 *
	 * @since 1.5.0
	 *
	 * @return array
	 */
	public static function credit_card_fields(){
		return array(
			'firstName',
			'lastName',
			'number',
			'expiryMonth',
			'expiryYear',
			'cvv',
			'email',
			'billingAddress1',
			'billingCountry',
			'billingCity',
			'billingPostcode',
			'billingState',
		);
	}

	/**
	 *  Fields for the actual charge
	 *
	 * @since 1.5.0
	 *
	 * @return array
	 */
	public static function charge_fields(){
		return array(
			'amount',
			'currency',
		);

	}

}
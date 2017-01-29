<?php
/**
 * @TODO What this does
 *
 * @package cf
 * Copyright 2017 Josh Pollock <Josh@CalderaWP.com
 */

namespace calderawp\omni;


/**
 * Class Config
 * @package calderawp\omni
 */
class Config {

	/** @var array  */
	protected $map;

	/** @var array  */

	protected $mapped;

	/**
	 * Config constructor.
	 *
	 * @param array $map Fields to Map
	 */
	public function __construct( array $map ) {
		$this->map = $map;
	}

	/**
	 * Get mapped properies
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function __get( $name ) {
		if( isset( $this->mapped[ $name ] ) ){
			return $this->mapped[ $name ];
		}
	}

	/**
	 * Get map as array
	 *
	 * @return array
	 */
	public function toArray(){
		return $this->mapped;
	}

	/**
	 * Do the actual mapping
	 */
	protected function map(){
		foreach ( $this->map_to_fields() as $field ){
			if( isset( $this->map[ $field ] ) ){
				$this->mapped[ $field ] = $this->map[ $field ];
			}else{
				$this->mapped[ $field ] = null;
			}
		}
	}

	/**
	 * Gather the fields to map on
	 *
	 * @return array
	 */
	protected function map_to_fields(){
		$fields = array_merge(
			array(
				'apiKey',
			),
			Fields::credit_card_fields(),
			Fields::charge_fields()

		);
		return apply_filters( 'cf_omni_map_to_fields', $fields );
	}

}
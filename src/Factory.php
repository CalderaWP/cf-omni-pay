<?php

namespace calderawp\omni;
use Omnipay\Common\AbstractGateway as Gateway;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;


/**
 * Class Factory
 *
 * Factory for needed objects/ collections based on given map/dataset
 * @package calderawp\omni
 */
class Factory {


	/** @var \Caldera_Forms_Processor_Get_Data  */
	protected $data;

	/**
	 * @var Config  $map
	 */
	protected  $map;

	/**
	 * Factory constructor.
	 *
	 * @param \Caldera_Forms_Processor_Get_Data $data Processor submission data
	 * @param Config $map Field map
	 */
	public function __construct( \Caldera_Forms_Processor_Get_Data $data, Config  $map ) {
		$this->data = $data;
		$this->map = $map;
	}

	/**
	 * Create Credit Card object for charges
	 *
	 * @return CreditCard
	 */
	public function createCard(){
		$args = array();
		foreach (  Fields::credit_card_fields() as $field  ){
			$args[ $field ] =$this->get_value( $field );
		}
		return new CreditCard( $args );


	}

	/**
	 * Charge a card on a given gateway
	 *
	 * @param CreditCard $card Card object
	 * @param Gateway $gateway Gateway object
	 *
	 * @return mixed
	 */
	public function chargeCard( CreditCard $card, Gateway $gateway ){
		return $gateway->purchase( array(
			'amount'   => $this->get_value( 'amount'),
			'currency' => $this->get_value( 'currency'),
			'card'     => $card,
		) );
	}

	/**
	 * Create gateway object
	 *
	 * @param string $name Gateway name
	 * @param string $apiKey API Key
	 *
	 * @return Gateway
	 */
	public function gateway( $name, $apiKey ) {
		$gateway = Omnipay::create( $name );
		$gateway->setApiKey( $apiKey );
		return $gateway;
	}

	protected function get_value( $field ){
		return $this->data->get_value( $this->map->$field );
	}


}
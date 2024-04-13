<?php


namespace Plgn024\Core\includes;

use Iterator;
use ArrayAccess;


class Options implements Iterator, ArrayAccess {


	protected $option_key;


	protected $data;


	protected $store_as_json;


	public function __construct( $option_key = '', $store_as_json = false ) {

		$this->store_as_json = $store_as_json;

		$this->data = [];

		if ( ! empty( $option_key ) ) {
			$this->set_option_key( $option_key );
		}
	}


	public function exists( $key ) {
		return array_key_exists( $key, $this->get_data() );
	}


	public function get( $key = '', $default = false ) {
		if ( 'all' === $key || empty( $key ) ) {
			$value = $this->data;
		} else {
			$value = $this->exists( $key ) ? $this->data[ $key ] : $default;
		}

		return apply_filters( strtolower( __CLASS__ ) . "_{$this->option_key}_get_{$key}", $value, $default );
	}


	public function get_path( $path = '', $default = false ) {
		if ( false === strpos( $path, '.' ) ) {
			return $this->get( $path, $default );
		}

		$value = $this->get( 'all' );

		if ( ! is_array( $value ) ) {
			return $default;
		}

		foreach ( explode( '.', $path ) as $key ) {

			if ( ! is_array( $value ) || ! array_key_exists( $key, $value ) ) {
				return $default;
			}
			$value = $value[ $key ];
		}

		return apply_filters( strtolower( __CLASS__ ) . "_{$this->option_key}_get_path_{$path}", $value, $default );
	}


	public function set( $key, $value = '' ) {

		if ( ! empty( $this->option_key ) ) {

			$this->data[ $key ] = apply_filters( strtolower( __CLASS__ ) . "_{$this->option_key}_set_{$key}", $value );

			return $this->update_data();
		}

		$this->data[ $key ] = $value;

		return $this;
	}


	public function remove( $key ) {

		unset( $this->data[ $key ] );

		return $this->update_data();
	}


	public function get_option_key() {
		return $this->option_key;
	}


	public function set_option_key( $option_key ) {
		$this->option_key = $option_key;
		$this->set_data();

		return $this;
	}


	public function get_data() {
		return (array) $this->get();
	}


	public function set_data( array $data = [], $unslash = false ) {
		if ( empty( $data ) && ! empty( $this->option_key ) ) {

			$default = $this->store_as_json ? '' : [];

			$data = get_option( $this->option_key, $default );

			if ( $this->store_as_json ) {
				$data = json_decode( $data, true );
			}
		}

		if ( $unslash ) {
			$data = wp_unslash( $data );
		}
		$this->data = (array) $data;

		return $this;
	}


	public function update_data( $unslash = false ) {

		if ( ! empty( $this->option_key ) ) {
			$data = $this->get_data();
			if ( $this->store_as_json ) {
				$data = wp_json_encode( $data );
			}
			if ( $unslash ) {
				$data = wp_unslash( $data );
			}

			return update_option( $this->option_key, $data );
		}
		return false;
	}


	public function __get( $key ) {
		return $this->get( $key );
	}


	public function __set( $key, $value ) {
		return $this->set( $key, $value );
	}


	public function __unset( $key ) {
		return $this->remove( $key );
	}


	public function __isset( $key ) {
		return $this->exists( $key );
	}


	public function __invoke( $key ) {
		return $this->get( $key );
	}


	public function __toString() {
		return wp_json_encode( $this->get_data() );
	}


	#[\ReturnTypeWillChange]
	public function offsetExists( $offset ) {
		return $this->exists( $offset );
	}


	#[\ReturnTypeWillChange]
	public function offsetGet( $offset ) {
		return $this->get( $offset );
	}


	#[\ReturnTypeWillChange]
	public function offsetSet( $offset, $value ) {
		return $this->set( $offset, $value );
	}


	#[\ReturnTypeWillChange]
	public function offsetUnset( $offset ) {
		return $this->remove( $offset );
	}


	#[\ReturnTypeWillChange]
	public function current() {
		return current( $this->data );
	}


	#[\ReturnTypeWillChange]
	public function next() {
		return next( $this->data );
	}


	#[\ReturnTypeWillChange]
	public function key() {
		return key( $this->data );
	}


	#[\ReturnTypeWillChange]
	public function valid() {
		return key( $this->data ) !== null;
	}


	#[\ReturnTypeWillChange]
	public function rewind() {
		reset( $this->data );
	}
}

<?php
 
class BaseModel extends Eloquent {
	public $errors;
	
	public function validate() {
		$v = Validator::make( $this->attributes, $this->getRules() );
		$v->setAttributeNames( static::$niceNames );
		
		if ( $v->passes() ) {
			$this->errors = $v->messages();
			return true;
		}
		
		$this->errors = $v->messages();
		
		return false;
	}
	
	public function getRules() {
		return $this->parseRules( array_map( [ $this, 'parseRules' ], static::$rules ) );
	}
	
	public function parseRules( $value ) {
		if ( is_array( $value ) ) {
			return array_map( [ $this, 'parseRules' ], $value );
		}
		
		return ( isset( $this->attributes[ 'id' ] ) ? str_replace( '{{id}}', $this->attributes[ 'id' ], $value ) : $value );
	}
}
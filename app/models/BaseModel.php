<?php
 
class BaseModel extends Eloquent {
	public $errors;
	
	public function validate() {
		$v = Validator::make( $this->attributes, static::$rules );
		$v->setAttributeNames( static::$niceNames );
		
		if ( $v->passes() ) {
			return true;
		}
		
		$this->errors = $v->messages();
		
		return false;
	}
}
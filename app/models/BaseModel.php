<?php
 
class BaseModel extends Eloquent {
	public $errors;
	
	public function validate() {
		$v = Validator::make( $this->attributes, static::$rules );
		$v->setAttributeNames( static::$niceNames );
		
		if ( $v->passes() ) {
			$this->errors = $v->messages();
			return true;
		}
		
		$this->errors = $v->messages();
		
		return false;
	}
}
<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Database model for User object.
 */
class User extends BaseModel implements UserInterface, RemindableInterface {
	public $timestamps = false;
	protected $fillable = [ 'username', 'password', 'email' ];
	public static $rules = [
		'username' => [ 'required' ],
		'password' => [ 'required' ],
		'email' => [ 'required', 'unique:users' ]
	];
	public static $niceNames = [
		'username' => 'användarnamn',
		'password' => 'lösenord',
		'email' => 'e-postadress'
	];
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array( 'password' );
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}
	
	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken( $value )
	{
		$this->remember_token = $value;
	}
	
	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}
	
	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function setPasswordAttribute( $value ) {
		$this->attributes[ 'password' ] = Hash::make( $value );
	}
}
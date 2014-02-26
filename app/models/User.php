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
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}

}
<?php
namespace App\Http\Controllers\Pub;

use Response;
use Input;
use Mail;
use Session;
use Validator;
use Config;

class SignUpController extends FormPostBaseController
{
	public $rules = [
		'email' => 'required|email'
	];

	public $subject = 'New Subscriber to Newsletter';

	public $mail_view = 'emails.sign_up';
}

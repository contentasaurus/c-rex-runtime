<?php
namespace App\Http\Controllers\Pub;

use Response;
use Input;
use Mail;
use Session;
use Validator;
use Config;

class InfoKitController extends FormPostBaseController
{
	public $rules = [
		'fname' => 'required',
		'lname' => 'required',
		'company' => 'required',
		'title' => 'required',
		'email' => 'required|email',
		'phone' => 'required'
	];

	public $subject = 'New Request for Information Kit';

	public $mail_view = 'emails.infokit';
}

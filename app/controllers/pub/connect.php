<?php
namespace App\Http\Controllers\Pub;

use Response;
use Input;
use Mail;
use Session;
use Validator;
use Config;

class ConnectController extends FormPostBaseController
{
	public $rules = [
		'fname' => 'required',
		'lname' => 'required',
		'company' => 'required',
		'title' => 'required',
		'email' => 'required|email',
		'phone' => 'required',
		'msg' => 'required'
	];

	public $subject = 'New Submission from Connect Form';

	public $mail_view = 'emails.connect';
}

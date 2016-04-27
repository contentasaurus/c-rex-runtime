<?php
namespace App\Http\Controllers\Pub;

use Response;
use Input;
use Mail;
use Session;
use Validator;
use Config;

class FormPostBaseController extends BaseController
{
	protected $response = [
		'errors' => [],
		'success' => false
	];

	public $rules = [];
	public $subject = 'Newground Form Submission';
	public $mail_view = 'emails.connect';

	public function index() {
		if($this->is_tokenized()){
			$this->validate_fields();
			$this->send_mail();
		}
		else{
			$this->reject();
		}

		return $this->respond();
	}

	protected function send_mail(){
		if(!$this->response['success']) return;

		$data = Input::all();
		Mail::queue($this->mail_view, $data, function($message) use ($data){
			$message
				->subject($this->subject)
				->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
				->to(Config::get('mail.to.address'), Config::get('mail.to.name'));
		});
	}

	protected function validate_fields(){
		$validator = Validator::make(Input::all(), $this->rules);
		if($validator->passes()){
			$this->accept();
		}
		else{
			$errors = $this->format_errors($validator, $this->rules);

			foreach ($errors as $error) {
				$this->add_error($error);
			}
		}
	}

	protected function format_errors($validator, $rules){
		$messages = $validator->errors();
		$fields = array_keys($rules); 
		$invalid_fields = array();
		foreach ($fields as $field) {
			if($messages->has($field)){
				array_push($invalid_fields, array(
					'name' => $field,
					'messages' => $messages->get($field)
				));
			}
		}
		return $invalid_fields;
	}

	protected function is_tokenized(){
		if ( Session::token() !== Input::get( '_token' ) ) {
			return false;
		}
		return true;
	}

	protected function add_error($error){
		$this->reject();
		array_push($this->response['errors'], $error);
	}

	protected function reject(){
		$this->response['success'] = false;
	}

	protected function accept(){
		$this->response['success'] = true;
	}

	protected function respond(){
		return Response::json($this->response);
	}
}

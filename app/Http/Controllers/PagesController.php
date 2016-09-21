<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Session;
use Mail;

class PagesController extends Controller {

	public function getIndex() {
		$posts = Post::orderBy('id', 'desc')->paginate(4);
		return view('myPages.welcome', ['posts' => $posts]);
	}

	public function getAbout() {
		$first = 'Ekaterina';
		$last = 'Kayashova';
		$fullname = $first . " " . $last;
		$email = 'kayash@icloud.com';

		$aboutme = [];
		$aboutme ['fullname'] = $fullname;
		$aboutme ['email'] = $email;
		return view('myPages.about')->withAboutme($aboutme);
	}

	public function getContact() {
		return view('myPages.contact');
	}

	public function postContact(Request $request) {
		
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);

		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('hello@devmarketer.io');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your Email was Sent!');

		return redirect('/');
	}
}
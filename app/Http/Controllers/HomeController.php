<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Notifications\AccountActivity;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('home');
	}

	/**
	 * Show the password update page. Allow the user to change their password from within the system
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getPasswordPage() {
		return view('user.password');
	}

	/**
	 * Process the request for updating the authenticated user password.
	 * Uses the PasswordRequest to validate the request
	 * @param PasswordRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateUserPassword(PasswordRequest $request) {
		// Extract the request data.
		$password = $request->password;
		$newPassword = $request->newPassword;
		$confirmPassword = $request->confirmPassword;

		// Get the current password
		$currentPassword = auth()->user()->password;
		// Check if current password matches the sent password.
		if (!Hash::check($password, $currentPassword)) {
			return redirect()->back()->with('error', 'The entered password does not match our records.');
		}

		// Check if new password matches current password.
		if (strcmp($newPassword, $password) == 0) {
			return redirect()->back()->with('error', 'New password cannot be same as your current password.');
		}

		// Check if the new password matches the confirmation password.
		if (strcmp($newPassword, $confirmPassword) != 0) {
			return redirect()->back()->with('error', 'The confirmation password does not match.');
		}

		// Get the current auth user and update their password.
		$user = auth()->user();
		$user->password = bcrypt($newPassword);

		$user->update();

		// Create a new password notification
		auth()->user()->notify(new AccountActivity('Password Update', 'Your password has been successfully updated. If this was not you, kindly contact the system administrator as your account might have been compromised.'));

		return redirect()->back()->with('success', 'You have successfully changed your password.');
	}

	/**
	 * Show the user notifications created by the system as notifications.
	 * Shows only the auth user notifs.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showUserInbox() {
		// Get all the unread notifications
		$unreadNotifs = auth()->user()->unreadNotifications;

		// Get count of all the user notifs
		$allNotifs = auth()->user()->notifications->count();

		return view('user.notifs.notifs', [
			'unreadNotifs' => $unreadNotifs,
			'allNotifs' => $allNotifs
		]);
	}

	/**
	 * Fetch a notif to be read.
	 * Gets only the auth user notifs
	 * @param string $id
	 * @return string
	 */
	public function readNotif(string $id){
		return auth()->user()->notifications->find($id);
	}
}

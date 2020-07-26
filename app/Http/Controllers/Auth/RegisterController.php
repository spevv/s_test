<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Mail\ConfirmationEmail;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * Create new user
     *
     * @param RegistrationRequest $request
     *
     * @return JsonResponse
     */
    public function create(RegistrationRequest $request)
    {
        $user = new User($request->only('name', 'email', 'password'));
        $message = sprintf('Name: %s, email: %s', $request->get('name'), $request->get('email'));
        if(!$user->save()) {
            Log::channel(Config::get('registrationErrorChanel'))->error($message);

            throw new RegistrationException('Can\'t save user data.'); // TODO create RegistrationException
        }

        // TODO better solution to use Observer pattern or create one event for group below
        Mail::to($user)->send(new ConfirmationEmail());
        // TODO create UserListEvent
        Event::dispatch(new UserListEvent()); // event(new UserListEvent()); in this class will be logic UserList()
        Log::channel(Config::get('registrationSuccessChanel'))->info($message);

        return response()->json(['status' => 'success'], 201);
    }
}

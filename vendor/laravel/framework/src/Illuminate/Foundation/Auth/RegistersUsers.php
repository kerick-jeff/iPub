<?php

namespace Illuminate\Foundation\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        $this->create($request->all());

        // send verification email
        $confirmation_code = str_random(30);

        $send = Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $request->input('email')], function($message) use ($request) {
            $message->from('frukerickjeff@gmail.com', 'iPub');
            $message->to($request->input('email'), $request->input('name'))
                    ->subject('Verify your email address');
        });

        return redirect('/login')->with(['status' => 'Please verify your email. Click the link in the email sent to you', 'email' => $request->input('email'), 'name' => $request->input('name')]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}

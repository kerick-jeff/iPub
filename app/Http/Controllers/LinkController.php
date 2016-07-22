<?php

namespace App\Http\Controllers;

use App\User;
use App\Link;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class LinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

      /**
       * Get a validator for an incoming registration request.
       *
       * @param  array  $data
       * @return \Illuminate\Contracts\Validation\Validator
       */
      protected function validator(array $data)
      {
          return Validator::make($data, [
              'link' => 'required|max:255',
              'caption' => 'required|max:255',
          ]);
      }

    /**
     * add a link/contact for an authenticated user
     * @param Request $request
     */
    public function add(Request $request){
        $validator = $this->validator($request->all());
        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        // validation test returned true, save link/contact now
        Link::create($request->all());
        return redirect('account');
    }

    /**
     * edit the selected link/contact
     */
    public function edit($id, $link, $caption){
        Link::where('id', $id)
            ->update(['link' => $link, 'caption' => $caption]);
        return redirect('/account');
    }

    /**
     * edit the selected link/contact
     */
    public function delete($id){
        Link::destroy($id);
        return redirect('/account');
    }
}

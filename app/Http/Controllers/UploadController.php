<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Auth;
use Image;
use App\Pub;
use Storage;
use App\User;
use Validator;
use App\PubFile;
use App\Http\Requests;

class UploadController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function storePhoto(Request $request)
    {
    	// validate the inputs
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'required'
        ]);

         // validation ends
         if($validate->fails()){
             return redirect('/upload/photo')->withErrors($validate)->withInput();
         }

        $type = 'image';
        $user_id = $request->input('user_id');
        $image = Image::make($request->file('photo'));
        $name = $request->file('photo')->getClientOriginalName();

		if($request->hasFile('photo') && $request->file('photo')->isValid() &&
		   $image->mime() != null && substr($image->mime(), 0, strlen($type)) === $type){  // check file exists and valid and mime type
		    if($image->filesize() < 10485760){  // check file size
		        if($image->width() > 510.5){ //check file dimensions
					$path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$user_id."-".User::find($user_id)->value('name').'/photo/';

		            if(!Storage::disk('public')->exists($user_id."-".User::find($user_id)->value('name').'/photo/')){
		            	Storage::disk('public')->makeDirectory($user_id."-".User::find($user_id)->value('name').'/photo/');
		            }

		            $photo = $image->resize(510,800); 
		            $photo->save($path.$name, 70);
		            $pub = Pub::create([
		                    'user_id' => $user_id,
		                    'title' => $request->input('title'),
		                    'description' => $request->input('description'),
		                    'category' => $request->input('category'),
		                    'sub_category' => $request->input('sub_category'),
		                   ]);

		            PubFile::create([
		                'pub_id' => $pub->id,
		                'filename' => $request->file('photo')->getClientOriginalName(),
		                'type' => $type,
		                'size' => $image->filesize(),
		                'extension' => $request->file('photo')->getClientOriginalExtension(),
		            ]);

		            return back()->with('success', 'Your image was successfully uploaded');
		        } // dimensions check ends
		          else{ return redirect('/upload/photo')->with('widthError', 'The file you uploaded is too small. Please get a larger one. ');}
		    } // file size check ends
		      else{ return redirect('/upload/photo')->with('sizeError', 'The file you uploaded is more than the required size. Your images must be less than 10MB.');}
		} // file exists and valid end
		  else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}

	}

	public function showPhoto()
	{
        $i = $j = 0;
        $pubs = User::find(Auth::user()->id)->pubs();
        //$pub_files = Pub::where('pub_id', $photos[$i + $j]->id)->value('filename');
        //$pub_files = new PubFile();
        $pub_files = [];
        $i = 0;
        foreach ($pubs as $pub) {
        	$pub_files[i] = PubFile::find($pub->id)->value('filename');
        	$i++;
        }

        $photos = $pubs->paginate(6);



        $storage = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".User::find(Auth::user()->id)->value('name').'/photo/';
        var_dump($pub_files);

		return view('upload.photo', [
            'i' => $i,
            'j' => $j,
            'photos' => $photos,
            'pub_files' => $pub_files,
            'storage' => $storage,
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
        ]);
	}

}

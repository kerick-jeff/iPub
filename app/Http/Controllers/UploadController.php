<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
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
        $width = $image->width();
        $height = $image->height();

		if($request->hasFile('photo') && $request->file('photo')->isValid() &&
		   $image->mime() != null && substr($image->mime(), 0, strlen($type)) === $type){  // check file exists and valid and mime type
		    if($image->filesize() < 5242880){  // check file size
		        if( $width >= 200 && $height >= 200 ){ //check file dimensions
					$path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$user_id."-".User::find($user_id)->value('name').'/photo/';

		            if(!Storage::disk('public')->exists($user_id."-".User::find($user_id)->value('name').'/photo/')){
		            	Storage::disk('public')->makeDirectory($user_id."-".User::find($user_id)->value('name').'/photo/');
		            }

                if($width > 450 && $height > 500) { 
                  $photo = $image->resize(450,500);
                  $photo->save($path.$name, 70);
                }
                else{ 
                  $image->save($path.$name, 70);
                }

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
		          else{ return redirect('/upload/photo')->with('widthError' , 'The file you uploaded is too small. Please get a larger one. ');}
		    } // file size check ends
		      else{ return redirect('/upload/photo')->with('sizeError', 'The file you uploaded is more than the required size. Your images must be less than 10MB.');}
		} // file exists and valid end
		  else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}

	}


/*
	public function showPhoto()
	{
        $i = $j = 0;
        $photos = User::find(Auth::user()->id)->pubs();

        $pub_files = [];
        foreach ($photos as $photo) {
        	$pub_files[$i] = Pub::find($photo->id)->pubFiles()->paginate(6);
        	$i++;
        }

        $storage = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".User::find(Auth::user()->id)->value('name').'/photo/';

        $tests = Image::make($storage.'login.jpg')->response("jpg");

        $image = [];
        foreach ($pub_files as $pub_file) {
        	$image[$j] = Image::make($storage.$pub_file->filename)->response("jpg");
	        echo '<br>';
	        echo '<br>';
	        $j++;
        }

	       var_dump($image);
	        //var_dump($tests);
        return view('upload.test');

		return view('upload.photo', [
            'i' => $i,
            'j' => $j,
            'photos' => $photos,
            'pub_files' => $pub_files,
            'storage' => $storage,
            'user' => Auth::user()->id."-".User::find(Auth::user()->id),
        ]); 
	}

*/
  public function editPhoto(Request $request)
  {
      Pub::where('id', $request->id)
          ->update([
            'title' => $request->title, 
            'description' => $request->description, 
            'category' => $request->category, 
            'sub_category' => $request->sub_category
          ]);
          
         return redirect('/upload/photo');
        //var_dump([$id, $title, $description, $category, $sub_category]);
  }

	public function destroyPhoto($id)
	{
        $photo = Pub::find($id);
        $pub_files = PubFile::where('pub_id', $photo->id)->first();

        $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name.'/photo';
        //$image = Image::make($path."/".$pub_files->filename);
        //$image->destroy()
        File::Delete($path . '/' . $pub_files->filename );

       if($photo->delete() && $pub_files->delete() ){
       		return redirect('/upload/photo')->with('successDelete', 'Successfully deleted image');
       }
      else{
      	return redirect('/upload/photo')->with('failDelete', 'Failed to delete image');
      }  
	}

}

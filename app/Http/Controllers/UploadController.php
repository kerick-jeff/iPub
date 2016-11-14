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
        $name = $image->getClientOriginalName();
        $width = $image->width();
        $height = $image->height();

		if($request->hasFile('photo') && $image->isValid() &&
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
		                'filename' => $image->getClientOriginalName(),
		                'type' => $type,
		                'size' => $image->filesize(),
		                'extension' => $image->getClientOriginalExtension(),
		            ]);

		            return back()->with('success', 'Your image was successfully uploaded');
		        } // dimensions check ends
		          else{ return redirect('/upload/photo')->with('widthError' , 'The file you uploaded is too small. Please get a larger one. ');}
		    } // file size check ends
		      else{ return redirect('/upload/photo')->with('sizeError', 'The file you uploaded is more than the required size. Your images must be less than 10MB.');}
		} // file exists and valid end
		  else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}

	}

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

  public function storeVideo(Request $request){
      // validate the inputs
      $validate = Validator::make($request->all(), [
                    'title' => 'required|max:255',
                    'description' => 'required',
                    'video' => 'required'
                  ]);

      // validation ends
      if($validate->fails()){
        return redirect('/upload/video')->withErrors($validate)->withInput();
      }
     // phpinfo();

      $type = 'video/mp4';
      $user_id = $request->input('user_id');
      $videoFile = $request->file('video');
      var_dump($videoFile);
      $mime = $videoFile->getClientMimeType();
      $name = $videoFile->getClientOriginalName();

      if($request->hasFile('video') && $videoFile->isValid() && substr($videoFile->getClientMimeType(), 0, strlen($type)) === $type){  // check video exists and valid and mime type
        if($videoFile->getClientSize() < 524288000){  // check video size
          $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$user_id."-".User::find($user_id)->value('name').'/video/';

                if(!Storage::disk('public')->exists($user_id."-".User::find($user_id)->value('name').'/video/')){
                  Storage::disk('public')->makeDirectory($user_id."-".User::find($user_id)->value('name').'/video/');
                }

                $path->put($name, file_get_contents($videoFile->getRealPath()));

                $pub = Pub::create([
                        'user_id' => $user_id,
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'category' => $request->input('category'),
                        'sub_category' => $request->input('sub_category'),
                       ]);

                PubFile::create([
                    'pub_id' => $pub->id,
                    'filename' => $videoFile->getClientOriginalName(),
                    'type' => $type,
                    'size' => $videoFile->getClientSize(),
                    'extension' => $videoFile->getClientOriginalExtension(),
                ]);

                return back()->with('success', 'Your videoFile was successfully uploaded');
        } // video size check ends
          else{ return redirect('/upload/video')->with('sizeError', 'The video you uploaded is more than the required size. Your videoFile must be less than 10MB.');}
    } // video exists and valid end
      else{ return redirect('/upload/video')->with('fileError', 'No valid video has been uploaded.');}

  }

  public function destroyVideo($id)
  {
    $video = Pub::find($id);
    $pub_files = PubFile::where('pub_id', $video->id)->first();

    $path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().Auth::user()->id."-".Auth::user()->name.'/video';
    File::Delete($path . '/' . $pub_files->filename );

    if($video->delete() && $pub_files->delete() ){
      return redirect('/upload/video')->with('successDelete', 'Successfully deleted video');
    }
    else{
      return redirect('/upload/video')->with('failDelete', 'Failed to delete video');
    }  
  }






}

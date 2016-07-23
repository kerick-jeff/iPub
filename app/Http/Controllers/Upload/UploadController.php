<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;

use Auth;
use App\Pub;
use Storage;
use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $title = $request->input('title');
        $description = $request->input('description');
        $user_id = $request->input('user_id');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $photo = $request->file('photo');
        $user_name = User::find($user_id)->value('name');
        $mime_type = $photo->getClientMimeType();
        $filename = $photo->getClientOriginalName();
        $size = Storage::size($photo);
        $data = getimagesize($photo);
        $width = $data[0];
        $height = $data[1];

        if($request->hasFile('photo') && $photo->isValid() ){  // check file exists and valid
            if( $size > 10485760){  // check file size
                if($width >= 510.5){ //check file dimensions
                    if ($mime_type != null && substr($mime_type, 0, strlen($type)) === $type) {   // check mime type
                        $destination_path = $user_id . '-' . $user_name . '/photo/' . $filename;
                        Storage::disk('public')->put($destination_path ,file_get_contents($photo->getRealPath()) );
                        Pub::create([
                            'user_id' => $user_id,
                            'title' => $title,
                            'description' => $description,
                            'type' => $type,
                            'filename' => $filename,
                            'category' => $category,
                            'sub_category' => $sub_category,
                        ]);
                        return back()->with('success', 'Your image was successfully uploaded');
                    }   // mime type check ends
                    else{ return redirect('/upload/photo')->with('typeError', 'The file you uploaded is not an image. Please upload an image.');}
                } // dimensions check ends
                else{ return redirect('/upload/photo')->with('widthError', 'The file you uploaded is too small. Please get a larger one. ');}
            } // file size check ends
            else{ return redirect('/upload/photo')->with('sizeError', 'The file you uploaded is more than the required size. Your images must be less than 10MB.');}
        }   // file exists and valid end
        else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}
    }

    public function showPhoto()
    {
        $i = $j = 0;
        $photos = User::find(Auth::user()->id)->pubs()->paginate(6);
        //$storage = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        return view('uploads.photo', [
            'i' => $i,
            'j' => $j,
            'photos' => $photos,
            //'storage' => $storage,
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
        ]);
    }

    public function deletePhoto($photo_id)
    {
        $delete = Pub::findOrFail($photo_id)->value('filename');
        $check = Storage::delete(storage_path($delete));
        if($check){
            return back()->with('deleteSuccess', 'Your photo has been deleted successfully.');
        }else{
            return back()->with('deleteFail', 'Photo could not be deleted. Please check your connection');
        }
    }

    












    public function storeVideo(Request $request)
    {
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

        $type = 'video';
        $title = $request->input('title');
        $description = $request->input('description');
        $user_id = $request->input('user_id');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $video = $request->file('video');
        $user_name = User::find($user_id)->value('name');
        $mime_type = $video->getClientMimeType();
        $filename = $video->getClientOriginalName();
        ///$length = $video->getClientLength();   GET THE LENGTH OF THE VIDEO

        if($request->hasFile('video') && $video->isValid() ){  // check file exists and valid
                if(1){ //check file length
                    if ($mime_type != null && substr($mime_type, 0, strlen($type)) === $type) {   // checkong mime type
                        $destination_path =$user_id . '-' . $user_name . '/video/'. $filename;
                        $video->move($destination_path, file_get_contents($filename->getRealPath()) );

                        Pub::create([
                            'user_id' => $user_id,
                            'title' => $title,
                            'description' => $description,
                            'type' => 1,
                            'filename' => $filename,
                            'category' => $category,
                            'sub_category' => $sub_category
                        ]);
                        return back()->with('success', 'Your video was successfully uploaded');
                    }   // mime type check ends
                    else{ return redirect('/upload/video')->with('typeError', 'The file you uploaded is not a video. Please upload a video.');}
                } // length check ends
                else{ return redirect('/upload/video')->with('lengthError', 'The videos you uploaded is more than 120secs. Please get a shorter video.');}
        }   // file exists and valid end
        else{ return redirect('/upload/video')->with('fileError', 'No valid file has been uploaded.');}
    }

}

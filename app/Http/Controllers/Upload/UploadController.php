<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;

use App\Pub;
use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
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
        $size = $photo->getClientSize();
        $data = getimagesize($photo);
        $width = $data[0];
        $height = $data[1];

        if($request->hasFile('photo') && $photo->isValid() ){  // check file exists and valid
            if( $size > 10240){  // check file size
                if($width >= 510.5){ //check file dimensions
                    if ($mime_type != null && substr($mime_type, 0, strlen($type)) === $type) {   // checkong mime type
                        // It starts with 'http'
                        $destination_path = 'storage/app/public/' . $user_id . '-' . $user_name . '/photo';
                        $photo->move($destination_path, $filename);

                        Pub::create([
                            'user_id' => $user_id,
                            'title' => $title,
                            'description' => $description,
                            'type' => $type,
                            'filename' => $filename,
                            'category' => $category,
                            'sub_category' => $sub_category
                        ]);
                        return back()->with('success', 'Your image was successfully uploaded');
                    }   // mime type check ends
                    else{ return redirect('/upload/photo')->with('typeError', 'The file you uploaded is not an image. Please upload an image.');}
                } // dimensions check ends
                else{ return redirect('/upload/photo')->with('widthError', 'The image you uploaded is too small. Please get a larger image. ');}
            } // file size check ends
            else{ return redirect('/upload/photo')->with('sizeError', 'The image you uploaded is more than the required size. Your images must be less than 10MB.');}
        }   // file exists and valid end
        else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}
    }



}

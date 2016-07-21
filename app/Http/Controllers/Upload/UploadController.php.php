<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;

use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController.php extends Controller
{
    public function storePhoto(Request $request)
    {
        // validate the inputs
        $validate = Validator::make($request, [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
         // validation ends
         if(!$validate){
             return redirect('/upload/photo')->withErrors()->withInput();
         }

        $type = 'image';
        $title = $request->input('title');
        $description = $request->input('description');
        $user_id = $request->input('user_id');
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $photo = Request::file('photo');
        $userName = User::find('$userId')->value('name');
        $mimeType = $photo->getClientMimeType();
        $filename = $photo->getClientOriginalName();
        $size = $photo=>getClientSize();
        $data = getimagesize($photo);
        $width = $data[0];
        $height = $data[1];

        if(Request::hasFile('photo') && $photo->isValid() ){  // check file exists and valid
            if( $size > 10240){  // check file size
                if($width >= 510.5){ //check file dimensions
                    if ($mimeType != null && substr($mimeType, 0, strlen($type)) === '$type')) {   // checkong mime type
                        // It starts with 'http'
                        $destinationPath = 'storage/app/public/' . $user_id . '-' . $userName . '/photo';
                        $photo->move($destinationPath, $name);

                        Pub::create([
                            'user_id' => $user_id,
                            'title' => $title,
                            'description' => $description,
                            'type' => $type,
                            'filename' => $filename,
                            'category' => $category,
                            'subcategory' => $subcategory
                        ]);
                    }   // mime type check ends
                    else{ return redirect('/upload/photo')->with('typeError', 'The image you uploaded is not an image. Please upload an image.');}
                } // dimensions check ends
                else{ return redirect('/upload/photo')->with('widthError', 'The image you uploaded is too small. Please get a larger image. ');}
            } // file size check ends
            else{ return redirect('/upload/photo')->with('sizeError', 'The image you uploaded is more than the required size. Your images must be less than 10MB.');}
        }   // file exists and valid end
        else{ return redirect('/upload/photo')->with('fileError', 'No valid file has been uploaded.');}
    }



}

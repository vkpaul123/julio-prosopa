<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUploadForms()
    {
    	ini_set('upload_max_filesize', '24M');
      	ini_set('post_max_size', '32M');
    	return view('User.uploadImage');
    }

    public function uploadImage(Request $request)
    {
    	$this->validate($request, [
    		'address' => 'required',
    		'districtName' => 'required',
    		'stateName' => 'required'
    	]);
    	$imageType = $request->image_type;
    	$user = Auth::user();

    	if($imageType == "leaf") {
    		if($request->hasFile('image_leaf')){
    			$imagename = $request->image_leaf->store('public/'.$user->id);
    			$imagename2 = $imagename;

    			$user->push('images', [
    				'image_id' => $user->id."_".str_replace("public/".$user->id."/", "", $imagename2),
    				'imageType' => $imageType,
    				'address' => $request->address,
    				'districtName' => $request->districtName,
    				'stateName' => $request->stateName,
    				'path' => 'storage/'.str_replace("public/", "", $imagename)
    			]);
    		}
    		else
    			Session::flash('messageFail', '<strong>No Image Uploaded!</strong> Please use <code>Choose file</code> to upload an Image of a Leaf.');
    	} elseif ($imageType == "thorn") {
    		if($request->hasFile('image_thorn')){
    			$imagename = $request->image_thorn->store('public/'.$user->id);
    			$imagename2 = $imagename;

    			$user->push('images', [
    				'image_id' => $user->id."_".str_replace("public/".$user->id."/", "", $imagename2),
    				'imageType' => $imageType,
    				'address' => $request->address,
    				'districtName' => $request->districtName,
    				'stateName' => $request->stateName,
    				'path' => 'storage/'.str_replace("public/", "", $imagename)
    			]);
    		}
    		else
    			Session::flash('messageFail', '<strong>No Image Uploaded!</strong> Please use <code>Choose file</code> to upload an Image of a Thorn.');
    	} elseif($imageType == "bud") {
    		if($request->hasFile('image_bud')){
    			$imagename = $request->image_bud->store('public/'.$user->id);
    			$imagename2 = $imagename;

    			$user->push('images', [
    				'image_id' => $user->id."_".str_replace("public/".$user->id."/", "", $imagename2),
    				'imageType' => $imageType,
    				'address' => $request->address,
    				'districtName' => $request->districtName,
    				'stateName' => $request->stateName,
    				'path' => 'storage/'.str_replace("public/", "", $imagename)
    			]);
    		}
    		else
    			Session::flash('messageFail', '<strong>No Image Uploaded!</strong> Please use <code>Choose file</code> to upload an Image of a Bud.');
    	}

		return redirect()->back();
    }
}

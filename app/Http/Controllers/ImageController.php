<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    public function upload(Request $request) {
        if ($request->hasFile('image')) {

            $data = $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);

            $file_name = Storage::put('gallery', $request->file('image'), 'public');

            return [
                "code" => 200,
                "status" => "success",
                "file_name" => $file_name
            ];
        }

        return [
            "code" => 404,
            "status" => "no file"
        ];
    }
}

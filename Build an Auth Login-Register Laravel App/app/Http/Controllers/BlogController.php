<?php

namespace App\Http\Controllers;


use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BlogController extends Controller
{
    public function create(Request $request)
    {

           $validate = $request->validate(
            [
                'title' => ['required' , 'string'],
                'content' => ['required' , 'min:1'],
                'image' => ['required' , 'image' , 'mimes:png,jpeg,jpg'],
            ]);


            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/images'),$image_name);

             $image_path = "/images/" . $image_name;

            $cookie = cookie('title',  $request->input('title') , 120);
            $cookie = cookie('content', $request->input('content'), 120);
            $cookie = cookie('image', $image_path, 120);
            return response('Done')->cookie($cookie);
    }


}

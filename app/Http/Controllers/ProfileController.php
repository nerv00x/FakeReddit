<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */ public function store(Request $request)
    {
        $request->validate([
            'imageUpload' => 'file|image|max:200'
        ]);

        if ($request->imageUpload) {$requestImage = $request->file('imageUpload');

            $img = Image::make($requestImage);
            
            $img->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            });
            
            $name = $requestImage->hashName();
            $path = config('filesystems.disks.public.root') . '/images/' . $name;
            $img->save($path);

            return back()->with('success', 'Imagen subida correctamente');
        } else {
            return back()->with('error', 'Fallo en la imagen');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profile $profile)
    {

        return view("profile.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profile $profile)
    {
        //
    }
}

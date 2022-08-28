<?php

namespace App\Http\Controllers;

use App\Models\Flip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Imagick;

class FlipController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function list()
    {
        $data['flip'] = Flip::where('type', 'public')->get();

        return view('pages.list', $data);
    }

    public function details($id)
    {
        $data['flip'] = Flip::find($id);
        $data['share'] = \Share::page(
            'https://www.itsolutionstuff.com',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        return view('pages.details', $data);
    }

    public function generate(Request $request)
    {
        $pdf = $request->file('filePdf');
        $name = $request->title;
        $type = $request->type;
        $sector = $request->sector;
        $desc = $request->desc;
        $imagick = new Imagick();

        $imagick->readImage($pdf);
        File::ensureDirectoryExists(storage_path('app/public'.'/'.$name));

        $imagick->writeImages(storage_path('app/public'.'/'.$name.'/'.$name.'.jpg'), true);

        $files = File::files(storage_path('app/public'.'/'.$name));

        $save = new Flip();
        $save->name = $name;
        $save->title = $name;
        $save->type = $type;
        $save->sector = $sector;
        $save->desc = $desc;
        $save->count = count($files);
        $save->save();

        $last = Flip::orderBy('created_at', 'desc')->first();

        return redirect()->route('details', ['id' => $last->id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Flip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Imagick;

class FlipController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function find(Request $request)
    {
        $data['flip'] = Flip::where('type', 'public');
        $data['flip'] = $data['flip']->where('name', 'like', '%'.$request->find.'%')->get();
        $data['sector'] = Flip::where('type', 'public')->pluck('sector', 'sector');

        return view('pages.list', $data);
    }

    public function list($sector)
    {
        if ($sector == 'all') {
            $data['flip'] = Flip::where('type', 'public')->orderBy('created_at', 'desc')->get();
        } else {
            $data['flip'] = Flip::where(['type' => 'public', 'sector' => $sector])->orderBy('created_at', 'desc')->get();
        }
        $data['sector'] = Flip::where('type', 'public')->pluck('sector', 'sector');

        return view('pages.list', $data);
    }

    public function private(Request $request)
    {
        $data['flip'] = Flip::where(['type' => 'private', 'password' => $request->password])->orderBy('created_at', 'desc')->get();
        $data['sector'] = Flip::where('type', 'public')->pluck('sector', 'sector');

        return view('pages.private', $data);
    }

    public function details($id)
    {
        $data['flip'] = Flip::where('slug', $id)->first();

        return view('pages.details', $data);
    }

    public function generate(Request $request)
    {
        $pdf = $request->file('filePdf');
        $name = $request->title;
        $type = $request->type;
        $email = $request->email;
        $sector = $request->sector;
        $password = $request->password;
        $desc = $request->desc;
        $imagick = new Imagick();

        $imagick->readImage($pdf);
        File::ensureDirectoryExists(storage_path('app/public'.'/'.$name));

        $imagick->writeImages(storage_path('app/public'.'/'.$name.'/'.$name.'.jpg'), true);

        $files = File::files(storage_path('app/public'.'/'.$name));

        $save = new Flip();
        $save->name = $name;
        $save->title = $name;
        $save->email = $email;
        $save->type = $type;
        $save->sector = $sector;
        $save->desc = $desc;
        $save->password = $password;
        $save->slug = $type.Str::random(50);
        $save->count = count($files);
        $save->save();

        $last = Flip::orderBy('created_at', 'desc')->first();

        return redirect()->route('details', ['id' => $last->slug]);
    }
}

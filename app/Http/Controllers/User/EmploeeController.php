<?php

namespace App\Http\Controllers\User;

use App\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsImage;


class EmploeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user.emploee.index', [
            'emploee' => Block::typeEmploee()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.emploee.create', [
            'emploee' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'type' => 'required|integer',
            'title' => 'required|string|max:50',
            'img' => ['required', new IsImage],
            'text' => 'required|string|max:150',
        ]);

        $imageData = Block::parsePhoto($request->img);

        $path = $imageData['path'];
        $base64 = $imageData['base64'];

        Storage::disk('public')->put( $path, base64_decode($base64) );

        $emploee = Block::create([
            'title' => $request->title,
            'img' => $path,
            'text' => $request->text,
            'type' => $request->type,
        ]);

        return redirect()->route('user.emploee.show', $emploee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function show(Block $emploee)
    {
        return view('user.emploee.show', [
            'emploee' => $emploee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $emploee)
    {
        return view('user.emploee.edit', [
            'emploee' => $emploee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $emploee)
    {
        $dataValidate = $request->validate([
            'title' => 'required|string|max:50',
            'img' => ['nullable', new isImage],
            'text' => 'required|string|max:150',
            'type' => 'required|integer'
        ]);

        if ($request->img) {
            $dataImg = Block::parsePhoto($request->img);
            $path = $dataImg['path'];
            $base64 = $dataImg['base64'];
            Storage::disk('public')->put( $path, base64_decode($base64) );

            if (Storage::disk('public')->exists($emploee->img) )  {
                Storage::disk('public')->delete($emploee->img);
            }
        } else {
            $path = $emploee->img;
        }

        $emploee->update([
            'title' => $request->title,
            'img' => $path,
            'text' => $request->text,
            'type' => $request->type
        ]);

        return redirect()->route('user.emploee.show', $emploee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $emploee)
    {
        if (Storage::disk('public')->exists($emploee->img) ) {
            Storage::disk('public')->delete($emploee->img);
        }
        $emploee->delete();

        return redirect()->route('user.emploee.index');
    }
}

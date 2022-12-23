<?php

namespace App\Http\Controllers\User;

use App\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user.blocks.index', [
            'blocks' => Block::infoBlocks()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.blocks.create', [
            'block' => []
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
            'title' => 'required|string|max:255',
            'link' => 'required_if:type,0',
            'img' => 'required_if:type,0|image|max:2048', // image
            'text' => 'required|string',
            'link' => 'required_if:type,0|max:255',
        ]);
        

        if ($request->hasFile('img') ) {
            $path = $request->file('img')->store('uploads', 'public');
        } else {
            $path = null;
        }

        $block = Block::create([
            'title' => $request->title,
            'img' => $path,
            'text' => $request->text,
            'link' => $request->link,
            'type' => $request->type,
        ]);

        return redirect()->route('user.blocks.show', $block);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        return view('user.blocks.show', [
            'block' => $block,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        return view('user.blocks.edit', [
            'block' => $block,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block)
    {
        if ($block->type == 1) {
            $dataValidate = $request->validate([
                'title' => 'required|string|max:255',
                'text' => 'required|string',
                'type' => 'required|boolean'
            ]);
        } else {
            $dataValidate = $request->validate([
                'title' => 'required|string|max:255',
                'img' => 'nullable|image|max:2048',
                'text' => 'required|string',
                'link' => 'required|url|max:255',
                'type' => 'required|boolean'
            ]);
        }
        
        if ($request->hasFile('img') ) {
            $file = $request->img->store('uploads', 'public');
            if (Storage::disk('public')->exists($block->img) )  {
                Storage::disk('public')->delete($block->img);
            }
        } else {
            $file = $block->img;  
        }

        if ($block->type == 1) {
            $block->update([
                'title' => $request->title,
                'text' => $request->text,
                'type' => $request->type
            ]);
        } else {
            $block->update([
                'title' => $request->title,
                'img' => $file,
                'text' => $request->text,
                'link' => $request->link,
                'type' => $request->type
            ]);
        }
        
        
        return redirect()->route('user.blocks.show', $block);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        if (Storage::disk('public')->exists($block->img) ) {
            Storage::disk('public')->delete($block->img);
        }
        $block->delete();

        return redirect()->route('user.blocks.index');
    }
}

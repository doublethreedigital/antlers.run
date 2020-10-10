<?php

namespace App\Http\Controllers;

use App\SharedFiddle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SharedFiddleController extends Controller
{
    public function store(Request $request): string
    {
        // $this->validate([
        //     'template' => ['required', 'string'],
        //     'frontMatter' => ['required', 'string'],
        // ]);

        $code = Str::random(6);

        SharedFiddle::create([
            'code' => $code,
            'template' => $request->template,
            'front_matter' => $request->frontMatter,
        ]);

        return $code;
    }

    public function show(SharedFiddle $fiddle)
    {
        return $fiddle->toArray();
    }
}

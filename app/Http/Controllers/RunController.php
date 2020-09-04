<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

class RunController extends Controller
{
    public function __invoke(Request $request)
    {
        $randomId = Uuid::uuid4();

        $content = $request->template;
        File::put(resource_path("views/{$randomId}.antlers.html"), $content);

        $data = [
            'current_date' => $now = now(),
            'now' => $now,
            'today' => $now,
        ];

        if ($request->frontMatter !== '' && $request->frontMatter !== null) {
            $data = array_merge(Yaml::parse($request->frontMatter), $data);
        }

        return view($randomId, $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class RunController extends Controller
{
    public string $requestId = '';
    public string $viewPath = '';
    public string $viewContents = '';
    public Request $request;
    public string $response = '';

    public function __invoke(Request $request)
    {
        $this->request = $request;

        $this
            ->initialPrep()
            ->storeTempView()
            ->parseView()
            ->removeTempView();

        return $this->response;
    }

    protected function initialPrep(): self
    {
        $this->requestId = Uuid::uuid4();
        $this->viewPath = resource_path('views/'.$this->requestId.'.antlers.html');
        $this->viewContents = '---'.PHP_EOL.$this->request->frontMatter.PHP_EOL.'---'.PHP_EOL.$this->request->template;

        return $this;
    }

    protected function storeTempView(): self
    {
        File::put($this->viewPath, $this->viewContents);

        return $this;
    }

    protected function parseView(): self
    {
        $this->response = view(
            $this->requestId,
            array_merge(\Symfony\Component\Yaml\Yaml::parse($this->request->frontMatter), [
                'current_date' => $now = now(),
                'now' => $now,
                'today' => $now,
            ])
        )->render();

        return $this;
    }

    protected function removeTempView(): self
    {
        File::delete(str_replace('html.', 'html', $this->viewPath));

        return $this;
    }
}

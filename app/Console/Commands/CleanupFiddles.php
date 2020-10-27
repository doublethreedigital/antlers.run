<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class CleanupFiddles extends Command
{
    protected $signature = 'app:cleanup-fiddles';

    protected $description = 'Clean up fiddles';

    public function handle()
    {
        $this->info('Cleaing up fiddle views');

        collect(File::allFiles(resource_path('views/fiddles')))
            ->each(function (SplFileInfo $file) {
                File::delete($file->getPathname());
            });
    }
}

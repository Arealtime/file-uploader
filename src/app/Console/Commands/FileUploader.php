<?php

namespace Arealtime\FileUploader\App\Console\Commands;

use Illuminate\Console\Command;

class FileUploader extends Command
{
    protected $signature = 'arealtime:file_uploader';
    protected $description = 'Command for FileUploader module';
    public function handle()
    {
        $this->info('FileUploader executed successfully.');
    }
}

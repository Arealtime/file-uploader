<?php

namespace Taskio\FileUploader\Traits;

use Carbon\Carbon;

trait FileUploaderAction
{
    private bool $isDatePathEnabled = false;

    public function enableDatePath(): self
    {
        $this->isDatePathEnabled = true;
        return $this;
    }

    private function generateDatePath(): string
    {
        return  Carbon::now()->format('Y/m/d');
    }
}

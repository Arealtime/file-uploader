<?php

namespace Taskio\FileUploader\Services;

use Taskio\FileUploader\Traits\FileUploaderAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploaderService
{
    use FileUploaderAction;

    private string $disk = 'public';
    private string $folder = 'uploads';

    /**
     * Set disk property.
     *
     * @param string $disk
     * @return $this
     */
    public function setDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Set folder property.
     *
     * @param string $folder
     * @return $this
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }


    /**
     * Upload a file to disk and return its stored path.
     *
     * @param UploadedFile $file
     */
    public function upload(UploadedFile $file): object
    {
        $folder = $this->folder;

        if ($this->isDatePathEnabled) {
            $folder = $this->generateDatePath();
        }

        $path = $file->store($folder, $this->disk);

        return  (object)[
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'extension' => $file->getClientOriginalExtension(),
        ];
    }

    /**
     * Delete a file from disk.
     *
     * @return bool
     */
    public function delete(string $filePath): bool
    {
        return Storage::disk($this->disk)->delete($filePath);
    }
}

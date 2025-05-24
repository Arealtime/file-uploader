<?php

namespace Arealtime\FileUploader\App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{

    private string $disk;
    private string $basePath;
    private string $folder;
    private string $filePath;

    private ?string $extension = null;
    private int $size = 0;
    private ?string $mimeType = null;

    /**
     * Set disk property.
     *
     * @param string $disk
     * @return $this
     */
    public function setDisk(string $disk): self
    {
        $this->disk = $disk ?? 'public';

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
        $this->folder = $folder ?? 'uploads';

        return $this;
    }


    /**
     * Set basePath property.
     *
     * @param string $basePath
     * @return $this
     */
    public function setBasePath(string $basePath): self
    {
        $this->basePath = $basePath ?: Carbon::now()->format('Y-m-d');

        return $this;
    }

    /**
     * Set filePath property.
     *
     * @param string $filePath
     * @return $this
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Upload a file to disk and return its stored path.
     *
     * @param UploadedFile $file
     * @return string // The path that should be stored in DB
     */
    public function upload(UploadedFile $file): string
    {
        $path = $file->store($this->folder, $this->disk);

        return $path;
    }

    /**
     * Delete a file from disk.
     *
     * @return bool
     */
    public function delete(): bool
    {
        return Storage::disk($this->disk)->delete($this->filePath);
    }
}

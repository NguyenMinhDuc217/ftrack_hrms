<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Upload a file to the specified disk and path.
     */
    public function upload(UploadedFile $file, Image $image, ?string $path = null, ?string $disk = null): Image
    {
        $disk = $disk ?? config('filesystems.default');
        $rootPath = env('DEFAULT_UPLOAD_PATH', 'uploads/default');

        $path = $path ? $rootPath.'/'.trim($path, '/') : $rootPath;

        // Store the file
        // putFile automatically generates a unique ID for the filename
        $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->extension();
        $filename = Str::slug($fileNameWithoutExtension).'.'.md5(strtotime('now').$fileNameWithoutExtension).'.'.$extension;
        $filePath = Storage::disk($disk)->putFileAs($path, $file, $filename);

        // Create database record
        // dd(Image::create([
        //     'name' => $image->name,
        //     'type' => $image->type,
        //     'file_url' => $filePath,
        //     'file_name_original' => $file->getClientOriginalName(),
        //     'size' => $file->getSize(),
        //     'extension' => $file->extension(),
        //     'mime_type' => $file->getClientMimeType(),
        // ]));

        return Image::create([
            'name' => $image->name,
            'type' => $image->type,
            'file_url' => $filePath,
            'file_name_original' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'extension' => $file->extension(),
            'mime_type' => $file->getClientMimeType(),
            'status' => $image->status,
        ]);
    }

    public function delete(Image $file): void
    {
        Storage::disk($file->disk)->delete($file->file_url);
        $file->delete();
    }

    public function deletebyId(int $id): void
    {
        $file = Image::where('id', $id)->first();
        if ($file) {
            $this->delete($file);
        }
    }
}

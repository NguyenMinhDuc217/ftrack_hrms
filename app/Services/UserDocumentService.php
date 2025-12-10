<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserDocumentService
{
    /**
     * Upload a file to the specified disk and path.
     *
     * @param UploadedFile $file
     * @param string|null $path
     * @param string|null $disk
     * @return UserDocument
     */
    public function upload(UploadedFile $file, User $userOwner = null, ?string $path = null, ?string $disk = null): UserDocument
    {
        $userUploaded = auth()->user();

        $disk = $disk ?? config('filesystems.default');
        $rootPath = env('DEFAULT_UPLOAD_PATH', 'uploads/default');

        $path = $path ? $rootPath.'/'.trim($path,'/') : $rootPath;

        // Store the file
        // putFile automatically generates a unique ID for the filename
        $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->extension();
        $filename =  Str::slug($fileNameWithoutExtension).".".md5(strtotime('now').$fileNameWithoutExtension).".".$extension;
        $filePath = Storage::disk($disk)->putFileAs($path, $file, $filename);


        // Create database record
        return UserDocument::create([
            'user_id' => $userOwner ? $userOwner->user_id : $userUploaded->user_id,
            'uploaded_by' => $userUploaded ? $userUploaded->user_id : null,
            'document_type' => 'profile_picture',
            'document_title' => 'Profile Picture',
            'confidential' => 0,
            'file_url' => $filePath,
            'file_name_original' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'extension' => $file->extension(),
            'mime_type' => $file->getClientMimeType(),
            'org_id' => $userOwner ? $userOwner->org_id : $userUploaded->org_id,

        ]);
    }

    public function delete(UserDocument $file): void
    {
        Storage::disk($file->disk)->delete($file->file_url);
        $file->delete();
    }

    public function deletebyId(int $id): void
    {
        $file = UserDocument::where('id', $id)->first();
        if ($file) {
            $this->delete($file);
        }
    }
}

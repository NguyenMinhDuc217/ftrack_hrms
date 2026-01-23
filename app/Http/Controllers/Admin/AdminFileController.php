<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use App\Services\UserDocumentService;
use Illuminate\Http\Request;

class AdminFileController extends Controller
{
    protected $fileService;

    public function __construct(UserDocumentService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('admin.files.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'disk' => ['required', 'string'],
            'path' => ['nullable', 'string'],
            'file' => ['required', 'file'],
        ]);

        try {
            $file = $this->fileService->upload($request->file('file'), $request->get('path'), $request->get('disk'));

            return redirect()->back()->with('success', 'File uploaded successfully!')->with('file_url', $file->url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'File upload failed: '.$e->getMessage());
        }
    }

    public function uploadEditorImage(Request $request, ImageService $imageService)
    {
        if ($request->hasFile('upload')) {
            $type = $request->input('type');
            $image = $request->file('upload');
            $fileName = time().'_'.$image->getClientOriginalName();

            $new_image = new Image([
                'name' => $fileName,
                'type' => $type,
                'file_name_original' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'status' => 1,

            ]);
            $file = $imageService->upload($image, $new_image, 'jobs');

            $url = $file->url;

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        return response()->json(['uploaded' => false, 'error' => ['message' => __('org.txt_failed_image')]], 400);
    }
}

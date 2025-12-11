<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}

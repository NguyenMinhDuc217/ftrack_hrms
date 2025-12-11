<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocument;
use App\Services\UserDocumentService;

class CvManagementController extends Controller
{
    protected $documentService;

    public function __construct(UserDocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index()
    {
        $user = auth()->user();
        $cv = UserDocument::where('user_id', $user->user_id)
            ->where('document_type', 'cv_file')
            ->latest() // Get the most recent one
            ->first();

        return view('cv.manage', compact('cv'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:doc,docx,pdf|max:3072', // Max 3MB
        ]);

        $user = auth()->user();
        
        $userDocument = new UserDocument([
            'user_id' => $user->user_id,
            'uploaded_by' => $user->user_id,
            'document_type' => 'cv_file',
            'document_title' => __('cv.user_cv_title'),
            'confidential' => false,
            'org_id' => $user->org_id,
        ]);
        // Upload new CV
        $this->documentService->upload(
            $request->file('cv_file'),
            $userDocument,
            'cvs',
            null
        );

        return redirect()->back()->with('success', __('cv.upload_success'));
    }

    public function delete($id)
    {
        $user = auth()->user();
        $cv = UserDocument::where('user_id', $user->user_id)
            ->where('id', $id)
            ->firstOrFail();

        $this->documentService->delete($cv);

        return redirect()->back()->with('success', __('cv.delete_success'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use App\Services\UserDocumentService;
use Illuminate\Http\Request;

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
        $cvs = UserDocument::where('user_id', $user->user_id)
            ->where('document_type', 'cv_file')
            ->latest()
            ->get();

        return view('cv.manage', compact('cvs'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:doc,docx,pdf|max:3072', // Max 3MB
            'cv_name' => 'required|string|max:255',
        ], [
            'cv_file.required' => __('cv.cv_file_required'),
            'cv_file.mimes' => __('cv.cv_file_mimes'),
            'cv_file.max' => __('cv.cv_file_max'),
            'cv_name.required' => __('cv.cv_name_required'),
            'cv_name.max' => __('cv.cv_name_max'),
        ]);

        $user = auth()->user();

        $userDocument = new UserDocument([
            'user_id' => $user->user_id,
            'uploaded_by' => $user->user_id,
            'document_type' => 'cv_file',
            'document_title' => $request->input('cv_name'),
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('cv.upload_success'),
                'data' => $userDocument,
            ]);
        }

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

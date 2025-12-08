<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminBlogController extends Controller
{
    public function index()
    {
        $user = auth()->guard()->user();
        $user_role = $user->roles()->first();

        $blogs = Blog::whereNull('deleted_at')->paginate(10);
        // dd($blogs);
        
        return view('admin.blog.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        $data['breadcrumbs'] = [
            // Note: The original code used 'role.heading_title_create' here, which now works
            ['label' => __('role.heading_title_create'), 'url' => route("admin.role.index")],
            ['label' => __('role.create')], // Use a more general 'create' key for the last breadcrumb
        ];
        return view(
            'admin.blog.add',$data
        );
    }

    public function show($blog_id)
    {
        $blog = Blog::where('blog_id', $blog_id)->first();

        $breadcrumbs = [
            ['label' => 'Blogs', 'url' => route("admin.blog.index")],
            ['label' => 'Edit Blog: ' ."{$blog->blog_id} - {$blog->title}", 'url' => route("admin.blog.show", $blog_id)],
        ];

        return view(
            'admin.blog.edit',
            [
                'blog' => $blog,
                'breadcrumbs' => $breadcrumbs,
            ]
        );
    }

    public function update(Request $request, ?Blog $blog = null): RedirectResponse
    {
        $data = $request->validated();

        if ($blog) {
            $blog->update($data);
            return redirect()->route('admin.blog.index')->with('success', "Blog updated successfully.");
        } else {
            $blog = Blog::create($data);
            return redirect()->route('admin.blog.index')->with('success', "Blog added successfully.");
        }
    }

    public function delete($blog_id): RedirectResponse
    {
        $blog = Blog::find($blog_id);
        if (!$blog) {
            return redirect()->route('admin.blog.index')->with('error', "Blog not found.");
        }
        $blog->delete();
        // $blogs_deleted = Blog::onlyTrashed()->get(); // Get all deleted blogs
        return redirect()->route('admin.blog.index')->with('success', "Blog deleted successfully.");
    }
}

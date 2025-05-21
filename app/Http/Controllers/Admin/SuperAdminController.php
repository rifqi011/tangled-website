<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of master data resources.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'admins');
        $perPage = 10;
        $search = $request->query('search', '');

        if ($tab === 'admins') {
            $admins = User::where('role', 'admin')
                ->when($request->query('search'), function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->query('search') . '%')
                        ->orWhere('email', 'like', '%' . $request->query('search') . '%');
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString();

            $categories = collect(); // Empty collection when on admins tab
            $classes = collect(); // Empty collection when on admins tab
        } else if ($tab === 'categories') {
            $categories = Category::query()
                ->when($request->query('search'), function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->query('search') . '%');
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            $classes = collect(); // Empty collection when on categories tab
            $admins = collect(); // Empty collection when on categories tab
        } else {
            $classes = ClassModel::query()
                ->when($request->query('search'), function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->query('search') . '%');
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString();

            $categories = collect(); // Empty collection when on classes tab
            $admins = collect(); // Empty collection when on classes tab
        }


        return view('admin.superadmin.masterdata.index', compact('admins', 'categories', 'classes', 'tab', 'search'));
    }

    /**
     * Store a newly created admin in storage.
     */
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('masterdata.index', ['tab' => 'admins'])
            ->with('success', 'Admin created successfully');
    }

    /**
     * Show the form for creating a new admin.
     */
    public function createAdmin()
    {
        return view('admin.superadmin.masterdata.admin_create');
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function editAdmin(User $admin)
    {
        return view('admin.superadmin.masterdata.admin_edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function updateAdmin(Request $request, User $admin)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);

            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('masterdata.index', ['tab' => 'admins'])
            ->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroyAdmin(User $admin)
    {
        $admin->delete();

        return redirect()->route('masterdata.index', ['tab' => 'admins'])
            ->with('success', 'Admin deleted successfully');
    }

    /**
     * Store a newly created category in storage.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('masterdata.index', ['tab' => 'categories'])
            ->with('success', 'Category created successfully');
    }

    /**
     * Update the specified category in storage.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('masterdata.index', ['tab' => 'categories'])
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroyCategory(Category $category)
    {
        if ($category->report_count > 0) {
            return redirect()->route('masterdata.index', ['tab' => 'categories'])
                ->with('error', 'Cannot delete category with existing reports.');
        }

        $category->delete();

        return redirect()->route('masterdata.index', ['tab' => 'categories'])
            ->with('success', 'Category deleted successfully');
    }

    /**
     * Store a newly created class in storage.
     */
    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        ClassModel::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('masterdata.index', ['tab' => 'classes'])
            ->with('success', 'Class created successfully');
    }

    /**
     * Update the specified class in storage.
     */
    public function updateClass(Request $request, ClassModel $class)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $class->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('masterdata.index', ['tab' => 'classes'])
            ->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroyClass(ClassModel $class)
    {
        if ($class->total_reports > 0) {
            return redirect()->route('masterdata.index', ['tab' => 'classes'])
                ->with('error', 'Cannot delete class with existing reports.');
        }

        $class->delete();

        return redirect()->route('masterdata.index', ['tab' => 'classes'])
            ->with('success', 'Class deleted successfully');
    }
}

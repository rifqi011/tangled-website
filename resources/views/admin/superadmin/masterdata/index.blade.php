<x-admin.app-layout>
    <x-slot name="title">
        {{ __('Master Data Management') }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Master Data Management') }}
            </h2>

            <x-admin.search-form route="masterdata" :searchTerm="$search" placeholder="Search {{ $tab === 'admins' ? 'admins' : ($tab === 'categories' ? 'categories' : 'classes') }}" :hiddenInputs="['tab' => $tab]" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="relative mb-4 rounded border bg-green px-4 py-3 text-white" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tab Navigation -->
                    <div class="mb-6 border-b border-gray-200">
                        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
                            <li class="mr-2">
                                <a href="{{ route('masterdata.index', ['tab' => 'admins']) }}" class="{{ $tab === 'admins' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Admins
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('masterdata.index', ['tab' => 'categories']) }}" class="{{ $tab === 'categories' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Categories
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('masterdata.index', ['tab' => 'classes']) }}" class="{{ $tab === 'classes' ? 'text-purple border-b-2 border-purple rounded-t-lg active' : 'text-gray-500 hover:text-gray-600 hover:border-gray-300 border-b-2 border-transparent rounded-t-lg' }} inline-block p-4">
                                    Classes
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    @if ($tab === 'admins')
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-lg font-medium">Admin Management</h3>
                            <a href="{{ route('masterdata.admin.create') }}">
                                <x-admin.secondary-button>
                                    Create Admin
                                </x-admin.secondary-button>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Created At
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($admins as $admin)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                {{ $admin->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                {{ $admin->email }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                {{ $admin->created_at->format('Y-m-d') }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('masterdata.admin.edit', $admin) }}" class="text-purple hover:underline">
                                                        Edit
                                                    </a>
                                                    <form id="delete-admin-form-{{ $admin->id }}" action="{{ route('masterdata.admin.destroy', $admin) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="text-red hover:underline" onclick="confirmDeleteAdmin({{ $admin->id }})">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                                No admin users found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4 px-4 py-3 sm:px-6">
                                {{ $admins->links() }}
                            </div>
                        </div>
                    @elseif ($tab === 'categories')
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-lg font-medium">Category Management</h3>
                            <button type="button" class="rounded-md bg-purple px-4 py-2 text-white hover:bg-purple" onclick="toggleCategoryModal()">
                                Create Category
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Total Reports
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                {{ $category->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                <span class="{{ $category->status ? 'bg-green text-white' : 'bg-red text-white' }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $category->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                {{ $category->report_count }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button type="button" class="text-purple hover:underline" onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->status }}')">
                                                        Edit
                                                    </button>
                                                    @if ($category->report_count == 0)
                                                        <form id="delete-category-form-{{ $category->id }}" action="{{ route('masterdata.category.destroy', $category) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="text-red hover:underline" onclick="confirmDeleteCategory({{ $category->id }})">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                                No categories found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4 px-4 py-3 sm:px-6">
                                {{ $categories->links() }}
                            </div>
                        </div>

                        <!-- Category Modal - For both Create and Edit -->
                        <div id="categoryModal" class="fixed inset-0 flex hidden h-full w-full items-center justify-center overflow-y-auto bg-gray-600 bg-opacity-50">
                            <div class="relative w-full max-w-md rounded-lg bg-white p-5 shadow-xl">
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="text-lg font-medium" id="categoryModalTitle">Create Category</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="toggleCategoryModal()">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form id="categoryForm" method="POST" action="{{ route('masterdata.category.store') }}">
                                    @csrf
                                    <div id="categoryMethodDiv">
                                        <!-- Method will be added dynamically for edits -->
                                    </div>
                                    <div class="mb-4">
                                        <x-admin.input-label for="name" :value="__('Name')" />
                                        <x-admin.text-input id="categoryName" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required />
                                    </div>
                                    <div class="mb-4">
                                        <x-admin.input-label for="name" :value="__('Status')" />
                                        <select name="status" id="categoryStatus" class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-purple focus:ring-purple">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" class="mr-2 rounded-md bg-gray-200 px-4 py-2 text-gray-700" onclick="toggleCategoryModal()">Cancel</button>
                                        <button type="submit" class="rounded-md bg-purple px-4 py-2 text-white">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @elseif ($tab === 'classes')
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-lg font-medium">Class Management</h3>
                            <button type="button" class="rounded-md bg-purple px-4 py-2 text-white hover:bg-purple" onclick="toggleClassModal()">
                                Create Class
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Total Reports
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($classes as $class)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                {{ $class->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                <span class="{{ $class->status ? 'bg-green text-white' : 'bg-red text-white' }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
                                                    {{ $class->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                {{ $class->total_reports }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button type="button" class="text-purple hover:underline" onclick="editClass({{ $class->id }}, '{{ $class->name }}', '{{ $class->status }}')">
                                                        Edit
                                                    </button>
                                                    @if ($class->total_reports == 0)
                                                        <form id="delete-class-form-{{ $class->id }}" action="{{ route('masterdata.class.destroy', $class) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="text-red hover:underline" onclick="confirmDeleteClass({{ $class->id }})">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                                No classes found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4 px-4 py-3 sm:px-6">
                                {{ $classes->links() }}
                            </div>
                        </div>

                        <!-- Class Modal - For both Create and Edit -->
                        <div id="classModal" class="fixed inset-0 flex hidden h-full w-full items-center justify-center overflow-y-auto bg-gray-600 bg-opacity-50">
                            <div class="relative w-full max-w-md rounded-lg bg-white p-5 shadow-xl">
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="text-lg font-medium" id="classModalTitle">Create Class</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="toggleClassModal()">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form id="classForm" method="POST" action="{{ route('masterdata.class.store') }}">
                                    @csrf
                                    <div id="classMethodDiv">
                                        <!-- Method will be added dynamically for edits -->
                                    </div>
                                    <div class="mb-4">
                                        <x-admin.input-label for="name" :value="__('Name')" />
                                        <x-admin.text-input id="className" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required />
                                    </div>
                                    <div class="mb-4">
                                        <x-admin.input-label for="name" :value="__('Status')" />
                                        <select name="status" id="classStatus" class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-purple focus:ring-purple">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" class="mr-2 rounded-md bg-gray-200 px-4 py-2 text-gray-700" onclick="toggleClassModal()">Cancel</button>
                                        <button type="submit" class="rounded-md bg-purple px-4 py-2 text-white">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Admin deletion confirmation
        function confirmDeleteAdmin(adminId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-admin-form-' + adminId).submit();
                }
            });
        }

        // Category modal functions
        function toggleCategoryModal() {
            const modal = document.getElementById('categoryModal');
            console.log("Toggle Category Modal called");
            if (modal) {
                modal.classList.toggle('hidden');

                // Reset form when opening for create
                if (!modal.classList.contains('hidden')) {
                    document.getElementById('categoryForm').reset();
                    document.getElementById('categoryForm').action = "{{ route('masterdata.category.store') }}";
                    document.getElementById('categoryModalTitle').textContent = 'Create Category';
                    document.getElementById('categoryMethodDiv').innerHTML = '';
                }
            }
        }

        function editCategory(id, name, status) {
            try {
                console.log("Edit Category called with:", id, name, status);

                // Set form values
                const nameInput = document.getElementById('categoryName');
                const statusSelect = document.getElementById('categoryStatus');
                const form = document.getElementById('categoryForm');
                const methodDiv = document.getElementById('categoryMethodDiv');
                const modalTitle = document.getElementById('categoryModalTitle');
                const modal = document.getElementById('categoryModal');

                if (nameInput) nameInput.value = name;
                if (statusSelect) statusSelect.value = status ? "1" : "0";

                // Change form action and method for update
                if (form) form.action = "/masterdata/category/" + id;
                if (methodDiv) methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                if (modalTitle) modalTitle.textContent = 'Edit Category';

                // Show modal
                if (modal) modal.classList.remove('hidden');
            } catch (e) {
                console.error("Error in editCategory function:", e);
                alert("Error opening edit modal: " + e.message);
            }
        }

        function confirmDeleteCategory(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-category-form-' + categoryId).submit();
                }
            });
        }

        // Class modal functions
        function toggleClassModal() {
            const modal = document.getElementById('classModal');
            if (modal) {
                modal.classList.toggle('hidden');

                // Reset form when opening for create
                if (!modal.classList.contains('hidden')) {
                    document.getElementById('classForm').reset();
                    document.getElementById('classForm').action = "{{ route('masterdata.class.store') }}";
                    document.getElementById('classModalTitle').textContent = 'Create Class';
                    document.getElementById('classMethodDiv').innerHTML = '';
                }
            }
        }

        function editClass(id, name, status) {
            try {
                console.log("Edit Class called with:", id, name, status);

                // Set form values
                const nameInput = document.getElementById('className');
                const statusSelect = document.getElementById('classStatus');
                const form = document.getElementById('classForm');
                const methodDiv = document.getElementById('classMethodDiv');
                const modalTitle = document.getElementById('classModalTitle');
                const modal = document.getElementById('classModal');

                if (nameInput) nameInput.value = name;
                if (statusSelect) statusSelect.value = status ? "1" : "0";

                // Change form action and method for update
                if (form) form.action = "/masterdata/class/" + id;
                if (methodDiv) methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                if (modalTitle) modalTitle.textContent = 'Edit Class';

                // Show modal
                if (modal) modal.classList.remove('hidden');
            } catch (e) {
                console.error("Error in editClass function:", e);
                alert("Error opening edit modal: " + e.message);
            }
        }

        function confirmDeleteClass(classId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-class-form-' + classId).submit();
                }
            });
        }
    </script>
</x-admin.app-layout>

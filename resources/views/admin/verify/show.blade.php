<x-admin.app-layout>
    <x-slot name="title">
        {{ __('View Report Details') }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">{{ $item->title }}</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div class="w-full max-w-full overflow-hidden rounded-3xl bg-center object-cover">
                            <img src="{{ asset($item->photo) }}" alt="Item photo">
                        </div>

                        <div>
                            <dl class="grid grid-cols-1 gap-4">
                                @if ($type === 'lost')
                                    <div>
                                        <dt class="font-semibold">Reporter</dt>
                                        <dd>{{ $item->username }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Phone</dt>
                                        <dd>{{ $item->userphone }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Class</dt>
                                        <dd>{{ $item->class->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Lost Date</dt>
                                        <dd>{{ $item->lost_date }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Last Location</dt>
                                        <dd>{{ $item->last_location }}</dd>
                                    </div>
                                @else
                                    <div>
                                        <dt class="font-semibold">Found Date</dt>
                                        <dd>{{ $item->found_date }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-semibold">Found Location</dt>
                                        <dd>{{ $item->found_location }}</dd>
                                    </div>
                                @endif
                                <div>
                                    <dt class="font-semibold">Category</dt>
                                    <dd>{{ $item->category->name }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold">Status</dt>
                                    <dd>
                                        <span class="{{ $item->status === 'diproses' ? 'bg-red' : ($item->status === 'hilang' ? 'bg-purple' : ($item->status === 'disimpan' ? 'bg-blue-600' : 'bg-green')) }} inline-flex rounded-full px-2 text-xs font-semibold leading-5 text-white">
                                            {{ $item->status }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-semibold">Description</dt>
                                    <dd class="whitespace-pre-wrap">{{ $item->description }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <form method="POST" action="{{ route('reports.verify', ['type' => $type, 'slug' => $item->slug]) }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-md bg-purple px-4 py-2 text-white">Verify</button>
                        </form>
                        <button onclick="openDeclineDialog('{{ $type }}', '{{ $item->slug }}')" class="inline-flex items-center rounded-md bg-red px-4 py-2 text-white">Decline</button>
                        <a href="{{ route('verify') }}" class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openDeclineDialog(type, slug) {
            Swal.fire({
                title: 'Decline Report',
                text: 'Please provide a reason for declining this report:',
                input: 'textarea',
                inputPlaceholder: 'Enter reason for rejection...',
                inputAttributes: {
                    'aria-label': 'Rejection reason',
                    'required': 'true'
                },
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Decline & Delete',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    if (!reason || reason.trim() === '') {
                        Swal.showValidationMessage('You must enter a reason for declining the report');
                        return false;
                    }

                    return fetch(`/reports/${type}/${slug}/decline`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                reason: reason
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Declined!',
                        'The report has been declined and deleted.',
                        'success'
                    ).then(() => {
                        window.location.href = "{{ route('verify') }}";
                    });
                }
            });
        }
    </script>
</x-admin.app-layout>

@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="row mt-2 mb-2">
                <div class="col-lg-6 mb-2">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('user.add') }}" class="btn btn-sm shadow-sm myBtn border rounded" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Add User">
                            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <form class="d-flex" method="GET" action="{{route('user.search')}}">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search"
                            name="q" value="{{old('q')}}">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" style="white-space: nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                        href="{{ route('user.edit', ['user' => $user->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                        href="#" user-id="{{ $user->id }}"
                                                        user-name="{{ $user->name }}"
                                                        user-url="{{ route('user.destroy', ['user' => $user->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Delete User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                        href="/user/detail/{{ $user->id }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Detail User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>User</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                    <div class="pagination-block">
                        {{ $users->onEachSide(1)->appends(['customers' => $customers->currentPage()])->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row mt-2 mb-2">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6 mb-2">
                    <form class="d-flex" method="POST" action="#">
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search"
                            name="search" value="">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" style="white-space: nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $user)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($customers->currentpage() - 1) * $customers->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                        href="{{ route('user.edit', ['user' => $user->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                        href="#" user-id="{{ $user->id }}"
                                                        user-name="{{ $user->name }}"
                                                        user-url="{{ route('user.destroy', ['user' => $user->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Delete User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 disabled"
                                                        href="/user/detail/{{ $user->id }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Detail User">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($customers->count() == 0)
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    There's no data in this table
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>Customer</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-sm-10 d-flex justify-content-md-center">
                    {{ $customers->onEachSide(1)->appends(['users' => $users->currentPage()])->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $('.delete').click(function() {
            var user_id = $(this).attr('user-id');
            var user_name = $(this).attr('user-name');
            var user_url = $(this).attr('user-url');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: user_name + " will be deleted, You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = user_url;
                }
            })
        });

    </script>
@endsection

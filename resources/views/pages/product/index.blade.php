@extends('layouts.be_main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Product List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                    <li class="breadcrumb-item">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    {{-- flash --}}
                    {{-- @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif --}}
                    <div class="card">
                        <div class="card-body">
                            {{-- search --}}
                            <form action="{{ route('search') }}" method="get">
                                <input name="search" type="text" class="my-3 col-md-10 form-control form-control-sm"
                                    placeholder="Search">
                            </form>
                            <div class="card-title d-flex justify-content-between py-2">
                                Data products
                                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Create
                                    Product</a>
                            </div>

                            <table class="table table-sm table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ asset('storage/assets/images/' . $item->image) }}"
                                                    alt="{{ $item->image }}" width="50">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>Rp. {{ number_format($item->price, 2, ',', '.') }}</td>
                                            <td>
                                                {{-- csrf --}}
                                                <form action="/products/{{ $item->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- show --}}
                                                    <a href="/products/{{ $item->id }}"
                                                        class="bi bi-eye btn btn-sm btn-info"></a>
                                                    {{-- edit --}}
                                                    <a href="/products/{{ $item->id }}/edit"
                                                        class="bi bi-pencil btn btn-sm btn-warning"></a>
                                                    {{-- delete --}}
                                                    <button id="deleteData" type="submit"
                                                        class="bi bi-trash btn btn-sm btn-danger"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- pagination --}}
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- sweet Alert --}}
    <script>
        @if (session('message'))
            Swal.fire({
                icon: "success",
                title: "{{ session('message') }}",
                showConfirmButton: true,
                timer: 1500
            });
        @endif

        // confirm delete with sweet Alert
        document.getElementById('deleteData').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.parentNode.submit();
                }
            });
        });
    </script>
@endpush

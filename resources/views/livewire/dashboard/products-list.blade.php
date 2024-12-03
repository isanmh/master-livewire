<main id="main" class="main">

    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between py-2">
                            {{-- search --}}
                            <h5>Products List</h5>
                            <div class="d-flex col-md-8 col-sm-6">
                                <input wire:model.live.debounce.1000ms="search" type="text"
                                    class="form-control form-control-sm" placeholder="Search">
                            </div>
                            <a wire:navigate href="/create" class="btn btn-sm btn-primary">Create Product</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <th class="align-middle">{{ $products->firstItem() + $loop->index }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/assets/images/' . $item->image) }}"
                                                width="50">

                                            {{-- <img src="{{ Storage::url('public/assets/images/' . $item->image) }}"
                                                alt="{{ $item->name }}" width="50"> --}}
                                        </td>
                                        <td>$. {{ $item->price }}</td>
                                        <td>
                                            <a wire:navigate href="/products/show/{{ $item->id }}"
                                                class="bi bi-eye btn btn-sm btn-primary"> View</a>
                                            <a wire:navigate href="/products/{{ $item->id }}/edit"
                                                class="bi bi-pencil btn btn-sm btn-warning"> Edit</a>
                                            <button wire:click="destroy({{ $item->id }})"
                                                wire:confirm="Are you sure?" class="bi bi-trash btn btn-sm btn-danger">
                                                Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- pagination --}}
                        {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
                        {{ $products->links() }}
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

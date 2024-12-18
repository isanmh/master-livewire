<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            {{-- notif berhasil --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    Dashboard | Data Products
                    {{-- search --}}
                    <div class="d-flex col-md-8 col-sm-6">
                        <input wire:model.live.debounce.1000ms="search" type="text"
                            class="form-control form-control-sm" placeholder="Search">
                    </div>
                    <a wire:navigate href="/crud/create" class="btn btn-primary float-right">Create</a>
                </div>
                {{-- table --}}
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        {{-- cek data --}}
                        @if ($products->isEmpty() == false)
                            {{-- looping data --}}
                            @foreach ($products as $item)
                                <tr>
                                    {{-- <th class="align-middle">{{ $loop->iteration }}</th> --}}
                                    <th class="align-middle">{{ $products->firstItem() + $loop->index }}</th>
                                    <td class="align-middle">
                                        <img src="{{ asset('storage/assets/images/' . $item->image) }}" width="50">
                                    </td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">$. {{ $item->price }}</td>
                                    <td class="align-middle">
                                        {{-- livewire --}}
                                        <a wire:navigate href="/crud/show/{{ $item->id }}"
                                            class="btn btn-sm btn-info">Show</a>
                                        <a wire:navigate href="/crud/{{ $item->id }}/edit"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="destroy({{ $item->id }})" wire:confirm="Are you sure?"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Data produk kosong</td>
                            </tr>
                        @endif
                    </table>
                    {{-- pagination --}}
                    {{ $products->links() }}
                </div>
                {{-- end tables --}}
            </div>
        </div>
    </div>
</div>

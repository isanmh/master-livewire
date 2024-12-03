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

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Edit Products</h5>

                        <form wire:submit.prevent="update">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input wire:model="name" type="text" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input wire:model='price' type="number" class="form-control">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input wire:model='image' class="form-control" type="file" id="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- loading wire --}}
                                    <div wire:loading wire:target='image' class="mt-2">
                                        <span class="text-success">
                                            {{-- icon bi loading --}}
                                            <i class="bi bi-arrow-clockwise"></i>
                                            uploading...
                                        </span>
                                    </div>

                                    {{-- image temporary --}}
                                    @if ($image && is_object($image))
                                        <div class="col-sm-10 mt-2">
                                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="image"
                                                width="70">
                                        </div>
                                    @else
                                        <div class="col-sm-10 mt-2">
                                            <img src="{{ asset('storage/assets/images/' . $image) }}" class="img-fluid"
                                                alt="image" width="70">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea wire:model='description' class="form-control" style="height: 100px"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <a wire:navigate class="btn btn-outline-secondary"
                                        href="{{ route('products') }}">Back</a>
                                    <button type="submit" class="btn btn-primary float-end">Update </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

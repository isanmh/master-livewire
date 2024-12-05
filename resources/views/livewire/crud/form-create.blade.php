<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    Dashboard | Data Products
                    <a wire:navigate href="/crud" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="card-body my-2">
                    <form wire:submit.prevent="store">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input wire:model="name" type="text" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input wire:model='price' type="number" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input wire:model='image' class="form-control" type="file">
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
                                @if ($image)
                                    <div class="col-sm-10 mt-2">
                                        <img src="{{ $image->temporaryUrl() }}" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea wire:model='description' class="form-control" style="height: 100px"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary float-end">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

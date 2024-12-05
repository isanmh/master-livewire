@extends('layouts.be_main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/categories">Product</a></li>
                    <li class="breadcrumb">Data</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">Edit Product</h5>

                            <form action="{{ route('products.update', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control"
                                            value="{{ old('name') ? old('name') : $product->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-select">
                                            <option
                                                value="{{ old('category_id') ? old('category_id') : $product->category_id }}">
                                                {{-- old from item database --}}
                                                {{ old('category_id') ? $categories->find(old('category_id'))->name : $product->category->name }}

                                            </option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input name="price" type="text" class="form-control"
                                            value="{{ old('price') ? old('price') : $product->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- images with preview --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input name="image" type="file" class="form-control"
                                            value="{{ $product->image }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- image --}}
                                        <div class="col-sm-10 mt-2">
                                            <img src="{{ asset('storage/assets/images/' . $product->image) }}"
                                                class="img-fluid" alt="image" width="70">
                                        </div>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" value="{{ old('description') }}" cols="30" rows="5">{{ old('description') ? old('description') : $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <a class="btn btn-outline-secondary" href="{{ route('products.index') }}">Back</a>
                                        <button type="submit" class="btn btn-primary float-end">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection

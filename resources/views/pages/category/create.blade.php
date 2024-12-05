@extends('layouts.be_main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/categories">Category</a></li>
                    <li class="breadcrumb-item">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">Create Category</h5>

                            <form action="{{ route('categories.store') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <a class="btn btn-outline-secondary" href="{{ route('categories') }}">Back</a>
                                        <button type="submit" class="btn btn-primary float-end">Create</button>
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

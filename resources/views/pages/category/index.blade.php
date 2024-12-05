@extends('layouts.be_main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Categories</h1>
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
                                Data Categories
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Create
                                    Category</a>
                            </div>

                            <table class="table table-sm table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>

                                            <td>{{ $item->name }}</td>
                                            <td>
                                                {{-- csrf --}}
                                                <form action="/categories/{{ $item->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="/categories/{{ $item->id }}/edit"
                                                        class="bi bi-pencil btn btn-sm btn-warning"> Edit</a>
                                                    <button type="submit" class="bi bi-trash btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')"> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

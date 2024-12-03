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
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Details Product</h5>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/assets/images/' . $image) }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $name }}</h4>
                                    <p>
                                        $. {{ $price }}
                                    </p>
                                    <p class="card-text">{{ $description }}</p>
                                    </p>
                                    {{-- button --}}
                                    <a wire:navigate href="{{ route('products') }}"
                                        class="btn btn-sm btn-outline-info">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

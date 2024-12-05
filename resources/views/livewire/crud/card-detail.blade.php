<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    Dashboard | Detail Product
                    <a wire:navigate href="/crud" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="card-body my-2">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Details Product</h5>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/assets/images/' . $image) }}" class="img-fluid rounded-start"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">{{ $name }}</h4>
                                <p>
                                    $. {{ $price }}
                                </p>
                                <p class="card-text">{{ $description }}</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

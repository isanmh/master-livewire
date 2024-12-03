<div class="card mb-3">
    <div class="card-body">
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Sign up Your Account</h5>
        </div>

        {{-- error login --}}
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form wire:submit.prevent='registerUser' class="row g-3">
            <div class="col-12">
                <label for="yourname" class="form-label">Name</label>
                <input type="text" wire:model="name" class="form-control" id="yourname">
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-12">
                <label for="youremail" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" wire:model="email" class="form-control" id="youremail" required="">
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" wire:model="password" class="form-control" id="yourPassword" required="">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-12">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" wire:model="password_confirmation" class="form-control"
                    id="password_confirmation" required="">
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100">Register</button>
            </div>
            <div class="col-12">
                <p class="small mb-0">You already have account? <a wire:navigate href="/login">Login</a></p>
            </div>
        </form>
    </div>
</div>

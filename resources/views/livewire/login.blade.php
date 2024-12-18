<div class="card mb-3">
    <div class="card-body">
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
            <p class="text-center small">Enter your email &amp; password to login</p>
        </div>

        {{-- error login --}}
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form wire:submit.prevent='loginUser' class="row g-3">
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
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="remember" value="true"
                        id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100">Login</button>
            </div>
            <div class="col-12">
                <p class="small mb-0">Don't have account? <a wire:navigate href="/register">Create an account</a></p>
            </div>
        </form>
    </div>
</div>

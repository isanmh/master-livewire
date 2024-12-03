<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a wire:navigate class="navbar-brand text-primary" href="/">
                <strong>LiveWire App</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- tenarry if --}}
                    {{-- (kondisi == true) ? true : false --}}
                    <li class="nav-item">
                        {{-- livewire navigation --}}
                        <a wire:navigate class="nav-link {{ Request::is('/') ? 'active text-primary' : '' }}"
                            aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        {{-- livewire navigation --}}
                        <a wire:navigate class="nav-link {{ Request::is('about') ? 'active text-primary' : '' }}"
                            href="/about">About</a>
                    </li>
                </ul>
                <a wire:navigate class="btn btn-outline-primary" href="/login">Login</a>
            </div>
        </div>
    </nav>
</div>

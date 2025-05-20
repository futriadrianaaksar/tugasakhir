@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto mt-5 p-4 shadow-sm">
        <h1 class="card-title h3 mb-3">Daftar</h1>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror" style="padding-right: 40px;">
                <span class="position-absolute" style="right: 10px; top: 65%; transform: translateY(-50%); cursor: pointer; z-index: 10; pointer-events: auto;" onclick="togglePassword('password', 'togglePasswordIcon')">
                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" style="padding-right: 40px;">
                <span class="position-absolute" style="right: 10px; top: 65%; transform: translateY(-50%); cursor: pointer; z-index: 10; pointer-events: auto;" onclick="togglePassword('password_confirmation', 'togglePasswordConfirmationIcon')">
                    <i id="togglePasswordConfirmationIcon" class="fas fa-eye"></i>
                </span>
            </div>
            <input type="hidden" name="role" value="mahasiswa">
            <div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function togglePassword(inputId, iconId) {
                console.log('togglePassword called for:', inputId, iconId); // Debugging
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                if (!input || !icon) {
                    console.error('Element not found:', inputId, iconId);
                    return;
                }
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    @endpush
@endsection

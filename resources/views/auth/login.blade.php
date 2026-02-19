<form action="{{ url('/login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Telefon raqam</label>
        <input type="tel" name="phone" class="form-control" required>
        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-3">
        <label>Parol</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Kirish</button>
</form>
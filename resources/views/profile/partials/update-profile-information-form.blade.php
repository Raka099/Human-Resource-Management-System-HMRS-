<form
    method="POST"
    action="{{ route('profile.update') }}"
>
    @csrf
    @method('PATCH')

    {{-- Nama --}}

    <div style="margin-top:20px;">

        <label>
            Nama
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                border:1px solid #ccc;
                border-radius:7px;
            "
        >

        @error('name')
            <p style="color:#D5322F;">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Email --}}

    <div style="margin-top:20px;">

        <label>
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                border:1px solid #ccc;
                border-radius:7px;
            "
        >

        @error('email')
            <p style="color:#D5322F;">
                {{ $message }}
            </p>
        @enderror

    </div>


    <button
        type="submit"
        class="btn-primary"
        style="margin-top:20px;"
    >
        Simpan Perubahan
    </button>

</form>
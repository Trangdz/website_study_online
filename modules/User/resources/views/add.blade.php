@extends('layouts.backend')

@section('content')
<form action="" method="POST">
    @csrf
    <div class="row">

        <div class="col-6">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="name..." value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="email..." value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="group_id">Group</label>
                <select name="group_id" id="group_id"
                    class="form-control @error('group_id') is-invalid @enderror">
                    <option value="">Select group</option>
                    {{-- Example options --}}
                    <option value="1" {{ old('group_id') == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('group_id') == 2 ? 'selected' : '' }}>User</option>
                </select>
                @error('group_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password...">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @csrf
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Cancel</a>
        </div>

    </div>
</form>
@endsection

@extends('admin.layouts.adminMaster')

@push('css')
<style>
    .form-check-label {
    cursor: pointer;
}

</style>

@endpush

@section('content')
@include('alerts.alerts')

<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Team Member</h3>
        </div>

        <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                {{-- Name --}}
                <div class="form-group">
                    <label>Name *</label>
                    <input name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label>Username *</label>
                    <input name="username"
                           value="{{ old('username') }}"
                           class="form-control"
                           required>
                </div>


                {{-- Designation --}}
                <div class="form-group">
                    <label>Designation *</label>
                    <input name="designation" value="{{ old('designation') }}" class="form-control" required>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                {{-- Phone --}}
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" value="{{ old('phone') }}" class="form-control">
                </div>

                {{-- Qualification --}}
                <div class="form-group">
                    <label>Qualification</label>
                    <input name="qualification" value="{{ old('qualification') }}" class="form-control">
                </div>

                {{-- Location --}}
                <div class="form-group">
                    <label>Location</label>
                    <input name="location" value="{{ old('location') }}" class="form-control">
                </div>

                {{-- Age --}}
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" value="{{ old('age') }}" class="form-control">
                </div>

                {{-- Gender --}}
                <div class="form-group">
                    <label>Gender *</label><br>
                    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" id="gender_male" name="gender" value="male" required>
    <label class="form-check-label" for="gender_male">Male</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" id="gender_female" name="gender" value="female">
    <label class="form-check-label" for="gender_female">Female</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" id="gender_other" name="gender" value="other">
    <label class="form-check-label" for="gender_other">Other</label>
</div>

                </div>

                {{-- Bio --}}
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" rows="4" class="form-control">{{ old('bio') }}</textarea>
                </div>

                {{-- Social Links --}}
                <div class="form-group">
                    <label>Social Links</label>
                    <input name="social_links[facebook]" class="form-control mb-2" placeholder="Facebook URL">
                    <input name="social_links[twitter]" class="form-control mb-2" placeholder="Twitter URL">
                    <input name="social_links[linkedin]" class="form-control mb-2" placeholder="LinkedIn URL">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label>Image (Square 1:1)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="validateSquareImage(this)">
                    <small class="text-danger d-block mt-1">
                        Image must be square (e.g. 300x300, 500x500)
                    </small>
                </div>

                {{-- Status --}}
<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           id="status"
           name="status"
           value="1"
           checked>

    <label class="form-check-label" for="status">
        Active
    </label>
</div>

{{-- Featured --}}
<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           id="featured"
           name="featured"
           value="1">

    <label class="form-check-label" for="featured">
        Featured
    </label>
</div>


            </div>

            <div class="card-footer">
                <button class="btn btn-success">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>

        </form>
    </div>
</div>


@endsection


@push('js')
{{-- Square Image Validation --}}
<script>
function validateSquareImage(input) {
    const file = input.files[0];
    if (!file) return;

    const img = new Image();
    img.src = URL.createObjectURL(file);

    img.onload = function () {
        if (this.width !== this.height) {
            alert('Image must be square (1:1 ratio)');
            input.value = '';
        }
    };
}
</script>

<script>
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')       // space → -
        .replace(/[^\w\-]+/g, '')   // remove non-word
        .replace(/\-\-+/g, '-');    // multiple - → single -
}

// Name → Username auto fill
document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.querySelector('input[name="name"]');
    const usernameInput = document.querySelector('input[name="username"]');

    if (!nameInput || !usernameInput) return;

    nameInput.addEventListener('keyup', function () {
        if (!usernameInput.dataset.edited) {
            usernameInput.value = slugify(this.value);
        }
    });

    // If admin edits username manually
    usernameInput.addEventListener('input', function () {
        this.dataset.edited = true;
        this.value = slugify(this.value);
    });
});
</script>

@endpush

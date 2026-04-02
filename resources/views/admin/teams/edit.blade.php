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
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Team Member</h3>
        </div>

        <form method="POST" action="{{ route('teams.update', $team->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Name --}}
                <div class="form-group">
                    <label>Name *</label>
                    <input name="name" value="{{ old('name', $team->name) }}" class="form-control" required>
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label>Username *</label>
                    <input name="username"
                    value="{{ old('username', $team->username) }}"
                    class="form-control"
                    required>
                </div>


                {{-- Designation --}}
                <div class="form-group">
                    <label>Designation *</label>
                    <input name="designation" value="{{ old('designation', $team->designation) }}" class="form-control" required>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email', $team->email) }}" class="form-control" required>
                </div>

                {{-- Phone --}}
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" value="{{ old('phone', $team->phone) }}" class="form-control">
                </div>

                {{-- Qualification --}}
                <div class="form-group">
                    <label>Qualification</label>
                    <input name="qualification" value="{{ old('qualification', $team->qualification) }}" class="form-control">
                </div>

                {{-- Location --}}
                <div class="form-group">
                    <label>Location</label>
                    <input name="location" value="{{ old('location', $team->location) }}" class="form-control">
                </div>

                {{-- Age --}}
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" value="{{ old('age', $team->age) }}" class="form-control">
                </div>

                {{-- Gender --}}
                <div class="form-group">
                    <label>Gender *</label><br>

                    @php
                    $gender = old('gender', $team->gender);
                    @endphp

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                        type="radio"
                        id="gender_male"
                        name="gender"
                        value="male"
                        {{ $gender == 'male' ? 'checked' : '' }}>

                        <label class="form-check-label" for="gender_male">
                            Male
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                        type="radio"
                        id="gender_female"
                        name="gender"
                        value="female"
                        {{ $gender == 'female' ? 'checked' : '' }}>

                        <label class="form-check-label" for="gender_female">
                            Female
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                        type="radio"
                        id="gender_other"
                        name="gender"
                        value="other"
                        {{ $gender == 'other' ? 'checked' : '' }}>

                        <label class="form-check-label" for="gender_other">
                            Other
                        </label>
                    </div>
                </div>


                    {{-- Bio --}}
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio"
                              id="bio_editor"
                              rows="6"
                              class="form-control">
                        {{ old('bio', $team->bio) }}
                    </textarea>
                </div>


                {{-- Social Links --}}
                <div class="form-group">
                    <label>Social Links</label>
                    <input name="social_links[facebook]" class="form-control mb-2"
                    value="{{ $team->social_links['facebook'] ?? '' }}"
                    placeholder="Facebook URL">

                    <input name="social_links[twitter]" class="form-control mb-2"
                    value="{{ $team->social_links['twitter'] ?? '' }}"
                    placeholder="Twitter URL">

                    <input name="social_links[linkedin]" class="form-control mb-2"
                    value="{{ $team->social_links['linkedin'] ?? '' }}"
                    placeholder="LinkedIn URL">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label>Image (Square 1:1)</label><br>

                    @if($team->image)
                    <img src="{{ asset('storage/'.$team->image) }}" width="80" class="mb-2">
                    @endif

                    <input type="file" name="image" class="form-control" accept="image/*"
                    onchange="validateSquareImage(this)">
                </div>

                {{-- Status --}}
                <div class="form-check">
                    <input class="form-check-input"
                    type="checkbox"
                    id="status"
                    name="status"
                    value="1"
                    {{ $team->status ? 'checked' : '' }}>

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
                    value="1"
                    {{ $team->featured ? 'checked' : '' }}>

                    <label class="form-check-label" for="featured">
                        Featured
                    </label>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-warning">
                    <i class="fas fa-sync"></i> Update
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('js')

<script>
    function validateSquareImage(input) {
        const file = input.files[0];
        if (!file) return;

        const img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function () {
            if (this.width !== this.height) {
                alert('Image must be square (1:1)');
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

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
ClassicEditor
    .create(document.querySelector('#bio_editor'), {
        toolbar: [
            'bold', 'italic', 'underline',
            '|',
            'bulletedList', 'numberedList',
            '|',
            'link',
            '|',
            'undo', 'redo'
        ]
    })
    .catch(error => {
        console.error(error);
    });
</script>


@endpush

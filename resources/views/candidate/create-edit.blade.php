@include('temp-parts.header')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- Top Bar Action --}}
            <div class="d-flex my-3 justify-content-end">
                <a href="{{ route('candidates.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

            {{-- Card Wrapper --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($candidate) ? 'Edit Student' : 'Add New Student' }}</h3>
                </div>
                <div class="card-body">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form 
                        action="{{ isset($candidate) ? route('candidates.update', $candidate->id) : route('candidates.store') }}" 
                        method="POST"
                    >
                        @csrf
                        @if(isset($candidate))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $candidate->name ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $candidate->email ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $candidate->phone ?? '') }}" required>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($candidate) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                    </form>
            </div>
        </div>
    </section>
</div>

@include('temp-parts.footer')

@include('temp-parts.header')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="card-title">{{ isset($candidate) ? 'Edit Student' : 'Add New Student' }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="d-flex justify-content-end">
                <a href="{{ route('candidates.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            {{-- Card Wrapper --}}
            <div class="card">
                <div class="card-body">
                    
                    {{-- Form --}}
                    <form 
                        action="{{ isset($candidate) ? route('candidates.update', $candidate->id) : route('candidates.store') }}" 
                        method="POST"
                    >
                        @csrf
                        @if(isset($candidate))
                            @method('PUT')
                        @endif

                        <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $candidate->name ?? '') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $candidate->email ?? '') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $candidate->phone ?? '') }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="form-control"
                                value="{{ old('dob', isset($candidate) && optional($candidate->candidate)->dob ? $candidate->candidate->dob->format('Y-m-d') : '') }}"
                                required>
                        </div>

                         <div class="form-group col-md-6 col-12">
                            <label>Nationality</label>
                            @php
                                $nationality = old('nationality', optional($candidate->candidate ?? null)->nationality ?? 'Indian');
                            @endphp
                            <select name="nationality" class="form-control" >
                                <option value="">-- Select Nationality --</option>
                                <option value="Indian" {{ $nationality === 'Indian' ? 'selected' : '' }}>Indian</option>
                                <option value="Others" {{ $nationality === 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', optional($candidate->candidate ?? null)->address ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Highest Qualification<span class="text-danger">*</span></label>
                            <input type="text" name="highest_qualification" class="form-control"
                                value="{{ old('highest_qualification', optional($candidate->candidate ?? null)->highest_qualification ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Institution Name<span class="text-danger">*</span></label>
                            <input type="text" name="institution_name" class="form-control"
                                value="{{ old('institution_name', optional($candidate->candidate ?? null)->institution_name ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Course Name<span class="text-danger">*</span></label>
                            <input type="text" name="course_name" class="form-control"
                                value="{{ old('course_name', optional($candidate->candidate ?? null)->course_name ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Year of Completion<span class="text-danger">*</span></label>
                            <input type="number" name="year_of_completion" class="form-control"
                                value="{{ old('year_of_completion', optional($candidate->candidate ?? null)->year_of_completion ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Certificates<span class="text-danger">*</span></label>
                            <input type="text" name="certificates" class="form-control"
                                value="{{ old('certificates', optional($candidate->candidate ?? null)->certificates ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Preferred Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="preferred_start_date" class="form-control"
                                value="{{ old('preferred_start_date', isset($candidate) && optional($candidate->candidate)->preferred_start_date ? $candidate->candidate->preferred_start_date->format('Y-m-d') : '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Specializations<span class="text-danger">*</span></label>
                            <input type="text" name="specializations" class="form-control"
                                value="{{ old('specializations', optional($candidate->candidate ?? null)->specializations ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Work Experience<span class="text-danger">*</span></label>
                            <input type="text" name="work_experience" class="form-control"
                                value="{{ old('work_experience', optional($candidate->candidate ?? null)->work_experience ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Reason for Joining<span class="text-danger">*</span></label>
                            <input type="text" name="reason_for_joining" class="form-control"
                                value="{{ old('reason_for_joining', optional($candidate->candidate ?? null)->reason_for_joining ?? '') }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Special Requirements<span class="text-danger">*</span></label>
                            <input type="text" name="special_fequirements" class="form-control"
                                value="{{ old('special_fequirements', optional($candidate->candidate ?? null)->special_fequirements ?? '') }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mr-2">
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

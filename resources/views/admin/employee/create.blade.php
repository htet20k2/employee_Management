@extends('admin.home')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-light py-3">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">Create Employee</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Personal Information -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Employee Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="DOB" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('DOB') is-invalid @enderror" id="DOB"
                            name="DOB" value="{{ old('DOB') }}" required>
                        @error('DOB')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex <span class="text-danger">*</span></label>
                        <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                            <option value="">Select Sex</option>
                            <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('sex')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="NRC" class="form-label">NRC <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('NRC') is-invalid @enderror" id="NRC"
                            name="NRC" value="{{ old('NRC') }}" required>
                        @error('NRC')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address Information -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="2" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="township" class="form-label">Township <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('township') is-invalid @enderror" id="township"
                            name="township" value="{{ old('township') }}" required>
                        @error('township')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Family Information -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="martial_status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('martial_status') is-invalid @enderror" id="martial_status" 
                            name="martial_status" required>
                            <option value="">Select Status</option>
                            <option value="Single" {{ old('martial_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('martial_status') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Divorced" {{ old('martial_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        </select>
                        @error('martial_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name"
                            name="father_name" value="{{ old('father_name') }}">
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mother_name" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name"
                            name="mother_name" value="{{ old('mother_name') }}">
                        @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="race" class="form-label">Race</label>
                        <input type="text" class="form-control @error('race') is-invalid @enderror" id="race"
                            name="race" value="{{ old('race') }}">
                        @error('race')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="religious" class="form-label">Religion</label>
                        <input type="text" class="form-control @error('religious') is-invalid @enderror" id="religious"
                            name="religious" value="{{ old('religious') }}">
                        @error('religious')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="blood_type" class="form-label">Blood Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('blood_type') is-invalid @enderror" id="blood_type" 
                            name="blood_type" required>
                            <option value="">Select Blood Type</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('blood_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Education & Qualification -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="education" class="form-label">Education <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('education') is-invalid @enderror" id="education"
                            name="education" value="{{ old('education') }}" required>
                        @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="other_qualification" class="form-label">Other Qualification <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('other_qualification') is-invalid @enderror" 
                            id="other_qualification" name="other_qualification" value="{{ old('other_qualification') }}" required>
                        @error('other_qualification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status & Description -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            @foreach(['Active', 'Inactive', 'On Leave', 'Terminated', 'Suspended'] as $status)
                                <option value="{{ $status }}" {{ old('status', 'Active') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <div class="text-end">
                        <a href="{{ route('employee.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Employee
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-label {
        font-weight: 500;
    }
    .text-danger {
        font-weight: bold;
    }
</style>
@endpush

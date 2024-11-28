@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit Employee</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee.update', $employee->employee_id) }}">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $employee->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $employee->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="DOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('DOB') is-invalid @enderror" id="DOB"
                                name="DOB" value="{{ old('DOB', $employee->DOB->format('Y-m-d')) }}">
                            @error('DOB')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex">
                                <option value="">Select Sex</option>
                                <option value="Male" {{ old('sex', $employee->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('sex', $employee->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('sex', $employee->sex) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="NRC" class="form-label">NRC</label>
                            <input type="text" class="form-control @error('NRC') is-invalid @enderror" id="NRC"
                                name="NRC" value="{{ old('NRC', $employee->NRC) }}">
                            @error('NRC')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" rows="2">{{ old('address', $employee->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="township" class="form-label">Township</label>
                            <input type="text" class="form-control @error('township') is-invalid @enderror" id="township"
                                name="township" value="{{ old('township', $employee->township) }}">
                            @error('township')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="martial_status" class="form-label">Marital Status</label>
                            <select class="form-select @error('martial_status') is-invalid @enderror" id="martial_status" name="martial_status">
                                <option value="">Select Status</option>
                                <option value="Single" {{ old('martial_status', $employee->martial_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ old('martial_status', $employee->martial_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Divorced" {{ old('martial_status', $employee->martial_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
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
                                name="father_name" value="{{ old('father_name', $employee->father_name) }}">
                            @error('father_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name"
                                name="mother_name" value="{{ old('mother_name', $employee->mother_name) }}">
                            @error('mother_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="race" class="form-label">Race</label>
                            <input type="text" class="form-control @error('race') is-invalid @enderror" id="race"
                                name="race" value="{{ old('race', $employee->race) }}">
                            @error('race')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="religious" class="form-label">Religious</label>
                            <input type="text" class="form-control @error('religious') is-invalid @enderror" id="religious"
                                name="religious" value="{{ old('religious', $employee->religious) }}">
                            @error('religious')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="blood_type" class="form-label">Blood Type</label>
                            <select class="form-select @error('blood_type') is-invalid @enderror" id="blood_type" name="blood_type">
                                <option value="">Select Blood Type</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                    <option value="{{ $type }}" {{ old('blood_type', $employee->blood_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('blood_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <input type="text" class="form-control @error('education') is-invalid @enderror" id="education"
                                name="education" value="{{ old('education', $employee->education) }}">
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="other_qualification" class="form-label">Other Qualification</label>
                            <input type="text" class="form-control @error('other_qualification') is-invalid @enderror" 
                                id="other_qualification" name="other_qualification" 
                                value="{{ old('other_qualification', $employee->other_qualification) }}">
                            @error('other_qualification')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="">Select Status</option>
                                @foreach(['Active', 'Inactive', 'On Leave', 'Terminated', 'Suspended'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $employee->status) == $status ? 'selected' : '' }}>
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
                                name="description" rows="3">{{ old('description', $employee->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="text-end">
                    <a href="{{ route('employee.show') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </div>
            </form>
        </div>
    </div>
@endsection

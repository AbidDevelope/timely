@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Basic Checkbox -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Add Plan</h2>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapse-from-validation">
                                <pre class="language-html mb-4"></pre>
                            </div>

                            <form action="{{ route('create.plan') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Age</label>
                                        <select name="age_group_id" id="" class="form-control border-success">
                                            <option value="">Select Age</option>
                                           @foreach ($age as $item)
                                           <option value="{{ $item->id }}">{{ $item->label }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Plan</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Plan" step="0.01" name="plan" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer02">Status</label>
                                        <select name="status" id="" class="form-control border-success">
                                            <option value="" disabled>Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-pill mr-2" type="submit">
                                    Submit
                                </button>
                                <button class="btn btn-light btn-pill" type="button">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

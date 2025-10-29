@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Basic Checkbox -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Add Age</h2>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapse-from-validation">
                                <pre class="language-html mb-4"></pre>
                            </div>

                            <form action="{{ route('create.age') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Label</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Label" name="label" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Min Income</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Min Age" step="0.01" name="min_age" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Max Income</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Max Age" step="0.01" name="max_age" />
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
                                <a href="{{ route('age') }}" class="btn btn-light btn-pill" type="submit">
                                    Cancel
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
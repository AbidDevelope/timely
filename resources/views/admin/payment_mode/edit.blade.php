@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Basic Checkbox -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Edit Payment Mode</h2>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapse-from-validation">
                                <pre class="language-html mb-4"></pre>
                            </div>

                            <form action="{{ route('update.payment.mode', $mode->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Mode</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Payment Mode" name="mode" value="{{ $mode->mode }}" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer02">Status</label>
                                        <select name="status" id="" class="form-control border-success">
                                            <option value="" disabled>Select Status</option>
                                            <option value="Active" {{ $mode->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $mode->status == 'InActive' ? 'selected' : '' }}>Inactive</option>
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

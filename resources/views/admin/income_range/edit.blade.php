@extends('admin.layouts.master')
@section('content')
   <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Basic Checkbox -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Edit Income Range</h2>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapse-from-validation">
                                <pre class="language-html mb-4"></pre>
                            </div>

                            <form action="{{ route('update.income.range', $income->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                   <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Label</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter label" name="label" value="{{ $income->label }}" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Min Income</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Min Income" step="0.01" value="{{ $income->min_income }}" name="min_income" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer01">Max Income</label>
                                        <input type="text" class="form-control border-success" id="validationServer01"
                                            placeholder="Enter Max Income" step="0.01" value="{{ $income->max_income }}" name="max_income" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer02">Status</label>
                                        <select name="status" id="" class="form-control border-success">
                                            <option value="" disabled>Select Status</option>
                                            <option value="active" {{ $income->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $income->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-pill mr-2" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('income') }}" class="btn btn-light btn-pill" type="button">
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
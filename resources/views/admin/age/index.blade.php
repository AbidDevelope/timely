@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">

            <!-- Products Inventory -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Age</h2>

                    <a href="{{ route('store.age') }}" type="button" class="mb-1 btn btn-success">
                       <i class="mdi mdi-plus mr-1"></i>
                        Add
                    </a>
                </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-data-tables">
                        <pre class="language-html mb-4"></pre>
                    </div>
                    <table id="productsTable" class="table table-hover table-product" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>label</th>
                                <th>Min Age(In year)</th>
                                <th>Max Age(In year)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ageGroup as $index => $item)
                                 <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->min_age }}</td>
                                <td>{{ $item->max_age ? $item->max_age : 'and above' }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('edit.age', $item->id) }}" class="p-1"><span class="mdi mdi-pencil"></span></a>
                                    <a href="{{ route('delete.age', $item->id) }}" class="p-1"><span class="mdi mdi-trash-can"></span></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Not Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('admin.layouts.master')
@section('content')
     <div class="content-wrapper">
        <div class="content">

            <!-- Products Inventory -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Income Range</h2>

                    <a href="{{ route('store.income') }}" type="button" class="mb-1 btn btn-success">
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
                                <th>Label</th>
                                <th>Min Income(In lakh)</th>
                                <th>Max Income(In lakh)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($income as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->min_income }}</td>
                                <td>{{ $item->max_income }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('edit.income_range', $item->id) }}" class="p-1"><span class="mdi mdi-pencil"></span></a>
                                    <a href="{{ route('delete.income.range', $item->id) }}" class="p-1"><span class="mdi mdi-trash-can"></span></a>
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
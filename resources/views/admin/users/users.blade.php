@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">

            <!-- Products Inventory -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Users List</h2>

                    <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-data-tables" role="button"
                        aria-expanded="false" aria-controls="collapse-data-tables">
                    </a>
                </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-data-tables">
                        <pre class="language-html mb-4"></pre>
                    </div>
                    <table id="productsTable" class="table table-hover table-product" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <!-- Card Profile -->
            <div class="card card-default card-profile">
                <div class="card-header-bg" style="background-image: url(assets/img/user/user-bg-01.jpg)"></div>

                <div class="card-body card-profile-body">
                    <div class="profile-avata">
                        <img class="rounded-circle" src="{{ asset('assets/admin/images/user/user-md-01.jpg') }}" alt="Avata Image" />
                        <span class="h5 d-block mt-3 mb-2">{{ Auth::guard('admin')->user()->name }}</span>
                        <span class="d-block">{{ Auth::guard('admin')->user()->email }}</span>
                        <span class="d-block">{{ Auth::guard('admin')->user()->mobile }}</span>
                    </div>
                </div>

                <div class="card-footer card-profile-footer">
                    <ul class="nav nav-border-top justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Notification -->
                    <div class="card card-default" data-scroll-height="530">
                        <div class="card-header">
                            <h2 class="mb-5">Notification</h2>
                        </div>

                        <div class="card-body slim-scroll">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-action">
                                    <div class="media media-sm mb-0">
                                        <div class="media-sm-wrapper">
                                            <img src="images/user/user-sm-01.jpg" alt="User Image" />
                                        </div>
                                        <div class="media-body">
                                            <span class="title">The stars are twinkling.</span>
                                            <p>
                                                Extremity sweetness difficult behaviour he of. On
                                                disposal of as landlord horrible. Afraid at highly
                                                months do things on at.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-action">
                                    <div class="media media-sm mb-0">
                                        <div class="media-sm-wrapper">
                                            <img src="images/user/user-sm-02.jpg" alt="User Image" />
                                        </div>
                                        <div class="media-body">
                                            <span class="title">This is a Japanese doll.</span>
                                            <p>
                                                Marianne or husbands if at stronger ye. Considered
                                                is as middletons uncommonly. Promotion perfectly
                                                ye consisted so.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-action">
                                    <div class="media media-sm mb-0">
                                        <div class="media-sm-wrapper">
                                            <img src="images/user/user-sm-03.jpg" alt="User Image" />
                                        </div>
                                        <div class="media-body">
                                            <span class="title">Support Ticket</span>
                                            <p>
                                                Unpleasant nor diminution excellence apartments
                                                imprudence the met new. Draw part them he an to he
                                                roof only. Music leave say doors him.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-action">
                                    <div class="media media-sm mb-0">
                                        <div class="media-sm-wrapper">
                                            <img src="images/user/user-sm-04.jpg" alt="User Image" />
                                        </div>
                                        <div class="media-body">
                                            <span class="title">New Order</span>
                                            <p>
                                                Farther related bed and passage comfort civilly.
                                                Dashwoods see frankness objection abilities the.
                                                As hastened oh produced prospect formerly up am.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- To Do list -->
                    <div class="card card-default pb-4" id="todo">
                        <div class="card-header mb-3">
                            <h2>To Do list</h2>

                            <a class="btn btn-primary btn-pill" id="add-task" href="#" role="button">
                                Add task
                            </a>
                        </div>

                        <div class="card-body" data-simplebar style="height: 385px">
                            <div class="todo-single-item d-none" id="todo-input">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Todo" autofocus />
                                    </div>
                                </form>
                            </div>
                            <div class="todo-list" id="todo-list">
                                <div class="todo-single-item d-flex flex-row justify-content-between finished">
                                    <i class="mdi"></i>
                                    <span>Finish Dashboard UI Kit update</span>
                                    <span class="badge badge-primary">Finished</span>
                                </div>
                                <div class="todo-single-item d-flex flex-row justify-content-between current">
                                    <i class="mdi"></i>
                                    <span>Create new prototype for the landing page</span>
                                    <span class="badge badge-primary">Today</span>
                                </div>
                                <div class="todo-single-item d-flex flex-row justify-content-between">
                                    <i class="mdi"></i>
                                    <span>
                                        Add new Google Analytics code to all main files
                                    </span>
                                    <span class="badge badge-danger">Yesterday</span>
                                </div>

                                <div class="todo-single-item d-flex flex-row justify-content-between">
                                    <i class="mdi"></i>
                                    <span>Update parallax scroll on team page</span>
                                    <span class="badge badge-success">Dec 15, 2018</span>
                                </div>

                                <div class="todo-single-item d-flex flex-row justify-content-between">
                                    <i class="mdi"></i>
                                    <span>Update parallax scroll on team page</span>
                                    <span class="badge badge-success">Dec 15, 2018</span>
                                </div>
                                <div class="todo-single-item d-flex flex-row justify-content-between">
                                    <i class="mdi"></i>
                                    <span>Create online customer list book</span>
                                    <span class="badge badge-success">Dec 15, 2018</span>
                                </div>
                                <div class="todo-single-item d-flex flex-row justify-content-between">
                                    <i class="mdi"></i>
                                    <span>Lorem ipsum dolor sit amet, consectetur.</span>
                                    <span class="badge badge-success">Dec 15, 2018</span>
                                </div>

                                <div class="todo-single-item d-flex flex-row justify-content-between mb-1">
                                    <i class="mdi"></i>
                                    <span>Update parallax scroll on team page</span>
                                    <span class="badge badge-success">Dec 15, 2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

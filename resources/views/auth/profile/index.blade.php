@extends('layouts.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card" style="border-radius: 18px;">
                    <div class="card-body" style="padding-top: 50px; padding-bottom: 50px;">
                        <h2 class="card-title mb-4"><i class="fa fa-user" aria-hidden="true"
                                style="margin-right: 10px"></i>User Profile</h2>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="inputFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="inputFullName" value="{{ $user->name }}"
                                readonly>
                        </div>

                        <a class="btn btn-primary" href="#data_modal" data-toggle="modal"
                            data-url="{{ url('dashboard/modal/employee/updatepassword') }}" data-action="data_modal"
                            class="btn btn-space btn-primary btn-sm" style="float: right;">Update Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

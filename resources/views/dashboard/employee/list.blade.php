@extends('layouts.dashboard')
@section('breadcrums')
<div class="mt-3">
    @include('pages.breadcrums')
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            @if (auth()->user()->role == 'admin')
            <h5 class="card-header">Bordered Table <a  href="#data_modal" data-toggle="modal" data-url="{{url($module['action'].'/create')}}" data-action="data_modal" class="btn btn-space btn-primary btn-sm" style="float: right;">+ Add {{$module['singular']}}</a></h5>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($employees['data']))
                                @foreach($employees['data'] as $key=>$val)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val['first_name'] }}</td>
                                        <td>{{ $val['last_name'] }}</td>
                                        <td>{{ $val['name'] }}</td>
                                        <td>{{ $val['role'] }}</td>
                                        <td>{{ $val['email'] }}</td>
                                        <td class="d-flex align-items-center justify-content-center justify-content-sm-start me-2">
                                            @if (auth()->user()->role == 'admin')
                                                <a href="#data_modal" data-toggle="modal" data-url="{{url($module['action'].'/update/'.$val['id'])}}" data-action="data_modal"  class="btn btn-info m-btn m-btn--icon rounded-pill btn-sm m-btn--icon-only mx-1">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a>
                                                |
                                                <a href="javascript:void(0)" data-action="delete_record" data-url="{{ url($module['action'].'/delete', $val['id'])}}" class="btn btn-danger m-btn m-btn--icon rounded-pill btn-sm m-btn--icon-only mx-1" data-remove="list_{{ $key }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                |
                                            @endif
                                            <a  href="#data_modal" data-toggle="modal" data-action="data_modal" data-url="{{ url('dashboard/employee/single-employee'. '/' .$val['id'])}}" class="btn btn-secondary m-btn rounded-pill m-btn--icon btn-sm m-btn--icon-only mx-1">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.dashboard')
@section('content')
    <div class="ecommerce-widget">

        <div class="row mt-5">
            @if (Auth::user()->role == 'admin')
                <div class=" col-md-2 ">
                    <a href="{{ url('dashboard/employee') }}" class="" rel="noopener noreferrer">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <h4 class="text-muted" style="font-size: 20pt;"><i class="fa fa-user text-white"
                                        aria-hidden="true"></i></h4>
                                <div class="metric-value d-inline-block">
                                    <h2 class="mb-1 text-white">Manage User</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            <div class=" col-md-2 ">
                <a href="{{ url('dashboard/document') }}" class="" rel="noopener noreferrer">
                    <div class="card bg-success">
                        <div class="card-body">
                            <h5 class="text-muted" style="font-size: 20pt;"><i class="fa fa-file text-white"
                                    aria-hidden="true"></i></h5>
                            <div class="metric-value d-inline-block">
                                <h2 class="mb-1 text-white"></i>Manage File</h2>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            <div class=" col-md-2 ">
                <a href="{{ url('dashboard/document/search') }}" class="" rel="noopener noreferrer">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted" style="font-size: 20pt;"><i class="fas fa-search"></i></h5>
                            <div class="metric-value d-inline-block">
                                <h2 class="mb-1"></i>Doc search</h2>
                            </div>
                        </div>

                    </div>
                </a>
            </div>


        </div>
    </div>
@endsection

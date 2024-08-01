@extends('layouts.dashboard')
@section('breadcrums')
    <div class="mt-3">
        @include('pages.breadcrums')
    </div>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control rounded" placeholder="Search" required>
                            <div class="input-group-append ml-3" style="width: 18%;">
                                <select class="form-control h-100" aria-label="Default select example">
                                    <option selected>DropDown Menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <button class="btn ml-3 rounded bg-primary" type="button" style="width: 18%"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</a>
                                <footer class="blockquote-footer mt-2">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <button class="btn float-right mt-3"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header">Filter Options</div>
                        <div class="card-body">
                            <!-- Add your filter options here -->
                            <!-- For example: -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="filterOption1">
                                <label class="form-check-label" for="filterOption1">
                                    Option 1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="filterOption2">
                                <label class="form-check-label" for="filterOption2">
                                    Option 2
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</a>
                                <footer class="blockquote-footer mt-2">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <button class="btn float-right mt-3"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</a>
                                <footer class="blockquote-footer mt-2">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <button class="btn float-right mt-3"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

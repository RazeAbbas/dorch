<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbs as $key=>$item)
                        <li class="breadcrumb-item"><a href="{{url($key)}}"
                            class="breadcrumb-link">{{$item}}</a></li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

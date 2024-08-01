<div class="container rounded bg-white mt-5 mb-5">
    @if($employees['data'] && count($employees['data']) > 0)
        @php
            $val = $employees['data'][0];
        @endphp

        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if ($employ['profile_image'])
                    <td>
                        <img class="rounded-circle mt-5" width="150px" src="{{ url("storage/app/public/imgs/".$employ['profile_image']) }}" style="width:70px;" />
                    </td>
                @else
                    <td>
                        <img src="{{ asset('no-image.png') }}" height="100" />
                    </td>
                @endif
                    <span class="font-weight-bold">{{ $employ['name'] }}</span>
                    <span class="text-black-50">{{ $employ['email'] }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" placeholder="Name" value="{{ $employ['first_name'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email ID</label>
                            <input type="text" class="form-control" placeholder="Email Id" value="{{ $employ['email'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

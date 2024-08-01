<form action="{{ url('dashboard/employee/updatepassword') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update employee</h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-4 mt-3">
                    <label class="form-label" for="Password">Type Your Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Type Your Password"></input>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="form-label" for="ConfirmPassword">Confirm Your Password</label>
                    <input type="password" name="password_confirmation" id="ConfirmPassword" class="form-control"
                        placeholder="Confirm Your Password"></input>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </div>
</form>

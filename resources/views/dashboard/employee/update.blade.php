<form action="{{ url('dashboard/employee/update/' . $row['id']) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update employee</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required
                        placeholder="First Name" value="{{ $row['first_name'] }}" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required
                        placeholder="Last Name" value="{{ $row['last_name'] }}" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="Email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" required
                        placeholder="Email" value="{{ $row['email'] }}" />
                </div>

                <div class="col-md-4 mt-3">
                    <label class="form-label" for="Password">Type Your Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Type Your Password"></input>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="form-label" for="ConfirmPassword">Confirm Your Password</label>
                    <input type="password" name="confirm_password" id="ConfirmPassword" class="form-control"
                        placeholder="Confirm Your Password"></input>
                </div>
                <div class="form-group col-md-4 mt-3">
                    <label for="SelectRole" class="form-label d-block">Select Role</label>
                    <select class="form-select w-100 h-75 border-transparent" name="role" id="SelectRole"
                        style="border-color: rgba(0,0,0,0.2)">
                        <option value="admin" @if ($row['role'] == 'admin') selected @endif>Admin
                        </option>
                        <option value="user" @if ($row['role'] == 'user') selected @endif>User</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label" for="ProfileImage">Upload Profile</label>
                    <input type="file" name="profile_image" class="form-control-file form-control" id="ProfileImage">
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </div>
</form>

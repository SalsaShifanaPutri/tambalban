@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Change Password</h4>

            <form method="POST" action="{{ route('update.password') }}" enctype="multipart/form-data">
                @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Old password</label>
                <div class="col-sm-10">
                    <input name="oldpassword" class="form-control" type="password" value=""  id="example-text-input">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input name="newpassword" class="form-control" type="password" value=""  id="example-text-input">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input name="confirmpassword" class="form-control" type="password" value=""  id="example-text-input">
                </div>
            </div>



            <!-- end row -->

            <!-- end row -->
                <input type="submit" class="btn btn-danger waves-effect waves-light" value="change Password" value="Update Profile">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>




@endsection

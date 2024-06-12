@extends('user.index')
@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h1 class="h3">Change Password</h1>
                        <form action="{{ route('changePass') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id_user" value="{{ $id_user }}" />
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" name="passwordNew" class="form-control" placeholder="Enter Password">
                                @error('passwordNew')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm password*</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="Enter Password">
                                @error('confirm_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-danger mt-2" type="submit">Save</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection

@extends('admin.layouts.app')

@section('content')
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="" name="updateBrandForm" id="updateBrandForm" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Name <span style="color:#FF0000">*</span></label>
                                    <input type="text" value="{{ $user->name }}" name="name" id="name" class="form-control" placeholder="Name">
                                        <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email">Email <span style="color:#FF0000">*</span></label>
                                    <input type="email" value="{{ $user->email }}" name="email" id="email" class="form-control" placeholder="Email">
                                        <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="phone">Phone<span style="color:#FF0000">*</span></label>
                                    <input type="text"  value="{{ $user->phone }}" name="phone" id="phone" class="form-control" placeholder="Phone">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address">Address<span style="color:#FF0000">*</span></label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="5">{{ $user->address }}</textarea>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="slug">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <span>To change password you have to enter value, otherwise leave blank.</span>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#updateBrandForm").submit(function(e) {
            e.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disable', true);
            $.ajax({
                url: '{{ route('users.update', $user->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disable', false);
                    if (response["status"] == true) {
                        window.location.href = "{{ route('users.index') }}";

                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        $("#address").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    } else {
                        if (response['notFound'] == true) {
                            window.location.href = "{{ route('users.index') }}";
                            return false;
                        }
                        var errors = response['errors'];

                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        }
                        if (errors['email']) {
                            $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        }
                        if (errors['phone']) {
                            $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
                        } else {
                            $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        }
                        if (errors['address']) {
                            $("#address").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['address']);
                        } else {
                            $("#address").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    console.log("Something went wrong.");
                }
            })
        });
    </script>
@endsection
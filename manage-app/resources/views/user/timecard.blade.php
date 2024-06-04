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
                        <h1 class="h3">Time card daily</h1>
                        <form action="{{ route('addTimeCard') }}" method="POST">
                            @csrf
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" value="check in"
                                    id="" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Check in
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" value="check out"
                                    id="" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Check out
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" data-bs-toggle="modal" data-bs-target="#myModal" type="radio" name="type" value="request"
                                    id="">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Request check in/out
                                </label>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection

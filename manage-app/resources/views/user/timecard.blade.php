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
                                    id="">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Check out
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" value="request" id="request"
                                    data-bs-toggle="modal" data-bs-target="#requestModal">
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
        <!-- Modal HTML -->
        <div id="requestModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addTimeCard') }}" method="POST">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="check in" id=""
                            checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Check in
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="check out" id="">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Check out
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">note:</label>
                        <textarea name="note" class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Send</button>
            </div>
                </form>
            </div>
        </div>
            </div>
        </div>
    </section>
@endsection

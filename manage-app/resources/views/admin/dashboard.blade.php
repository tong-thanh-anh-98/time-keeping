@extends('admin.layouts.app')

@section('content')
    <section class="content-header">					
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">							
                    <div class="small-box card">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-6">							
                    <div class="small-box card">
                        <div class="inner">
                            <h3>50</h3>
                            <p>Total Timecard</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>					
    </section>
@endsection

{{-- @section('customJs')
    <script>
        alert("Welcome to Administrative Panel!");
    </script>
@endsection --}}
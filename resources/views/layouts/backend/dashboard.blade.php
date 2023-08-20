@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
    @include('components.backend.navbar')
    @include('components.backend.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row my-4">

                    <div class="col-sm-6">
                        <h4 class="m-0 font-weight-bolder">My Expenses</h4>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <p class="m-0">Dashboard</p>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid mt-lg-4">
                <dashboard-index :compute_amounts="{{ $compute_amounts }}"></dashboard-index>
            </div>
        </section>
    </div>
@endsection
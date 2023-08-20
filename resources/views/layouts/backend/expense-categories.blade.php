@extends('layouts.backend')
@section('title', 'Expense Management | Expense Categories')
@section('content')
    @include('components.backend.navbar')
    @include('components.backend.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row my-4">

                    <div class="col-sm-6">
                        <h4 class="m-0 font-weight-bolder">Expense Categories</h4>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <p class="m-0">Expense Management</p>
                            </li>
                            <li class="breadcrumb-item">
                                Expense Categories
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid mt-lg-4">
                <expense-categories-index></expense-categories-index>
            </div>
        </section>
    </div>
@endsection
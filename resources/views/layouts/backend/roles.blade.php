@extends('layouts.backend')
@section('title', 'User Management | Roles')
@section('content')
    @include('components.backend.navbar')
    @include('components.backend.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row my-4">
                    <div class="col-sm-6">
                        <h4 class="m-0 font-weight-bolder">Roles</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <p class="m-0">User Management</p>
                            </li>
                            <li class="breadcrumb-item">
                                Roles
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid mt-lg-4">
                <roles-index></roles-index>
            </div>
        </section>
    </div>
@endsection
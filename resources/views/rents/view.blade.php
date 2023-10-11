@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="card-body">
                    <div class="border-bottom text-center pb-4">
                        <img src="{{ asset($rent->avatar ? 'storage/' . $rent->avatar : 'images/logo.png') }}" alt="profile"
                            class="img-fluid img-xl rounded-circle mb-3" width="200" />
                        <div class="mb-3">
                            <h3> {{ ucwords($rent->name) }}</h3>
                            <span class="badge badge-primary"> {{ $rent->roles[0]->name }}</span>
                        </div>
                        <p class="w-75 mx-auto mb-3">{{ $rent->bio }}</p>
                    </div>
                    <div class="py-4">
                        <p class="clearfix">
                            <span class="float-left">
                                Phone
                            </span>
                            <span class="float-right text-muted">
                                {{ $rent->contact_no }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Mail
                            </span>
                            <span class="float-right text-muted">
                                {{ $rent->email }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">

        </div>
    </div>
@endsection

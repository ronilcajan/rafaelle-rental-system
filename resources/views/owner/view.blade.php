@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">

                <div class="card-body">
                    <h4 class="card-title">Owner Details</h4>
                    <div class="border-bottom text-center pb-4">
                        <img src="{{ asset($owner->image ? 'storage/' . $owner->image : 'images/logo.png') }}"
                            class="img-fluid img-xl rounded-circle mb-3" width="200" />
                        <div class="mb-3">
                            <h3> {{ ucwords($owner->name) }}</h3>
                        </div>
                    </div>
                    <div class="py-4">
                        <p class="clearfix">
                            <span class="float-left">
                                Contact No
                            </span>
                            <span class="float-right text-muted">
                                {{ $owner->contact_no }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Email Address
                            </span>
                            <span class="float-right text-muted">
                                {{ $owner->email }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Address
                            </span>
                            <span class="float-right text-muted">
                                {{ $owner->address }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Owner Properties</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Monthly</th>
                                    <th>Yearly</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($owner->properties as $row)
                                    <tr>
                                        <td>{{ $row->property_name }}</td>
                                        <td>{{ $row->location }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td>{{ $row->monthly }}</td>
                                        <td>{{ $row->yearly }}</td>
                                        <td>
                                            @php
                                                $badge = $row->status == 'rented' ? 'success' : 'info';
                                            @endphp
                                            <span class="badge badge-{{ $badge }}">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <i class="ti-dropbox" style="font-size: 100px; color:gray;"></i> <br> No
                                            record
                                            found!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

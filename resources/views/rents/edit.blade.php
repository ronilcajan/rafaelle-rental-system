@extends('layouts.app')

@push('header-script')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $title }}</h4>
            <form action="{{ route('rents.update', $rent->id) }}" id="propertyForm">
                @csrf
                @method('GET')
                <div id="properties-form">
                    <h3>Property</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Select property here</label>
                                    <select class="properties w-100 form-control" name="property_id"
                                        onchange="getProperties(this)" required>
                                        <option selected>Select</option>
                                        @foreach ($properties as $row)
                                            <option value="{{ $row->id }}"
                                                {{ $rent->property_id == $row->id ? 'selected' : '' }}>
                                                {{ $row->property_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('property_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-rounded btn-icon mb-3 mt-3"
                                    data-toggle="modal" data-tooltip="tooltip" data-target="#createProperty"
                                    data-placement="bottom" title="" data-original-title="Create Property">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Property Name</label>
                                    <input type="text" id="property_name" name="property_name" class="form-control"
                                        value="{{ $rent->property->property_name }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" id="price" class="form-control"
                                        value="{{ $rent->property->price }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Monthly Price</label>
                                    <input type="number" id="monthly_price" value="{{ $rent->property->monthly }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Yearly Price</label>
                                    <input type="number" id="yearly_price" class="form-control"
                                        value="{{ $rent->property->yearly }}" readonly>
                                </div>
                            </div>
                        </div>



                    </section>
                    <h3>Tenant</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Select tenants here</label>
                                    <select class="tenants w-100 form-control" name="tenant_id" style="width: 100%"
                                        onchange="getTenant(this)" required>
                                        <option selected>Select</option>
                                        @foreach ($tenants as $row)
                                            <option value="{{ $row->id }}"
                                                {{ $rent->tenant_id == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tenant_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-rounded btn-icon mb-3 mt-3"
                                    data-toggle="modal" data-tooltip="tooltip" data-target="#createTenant"
                                    data-placement="bottom" title="" data-original-title="Create Tenant">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $rent->tenant->name }}" name="tenant_name"
                                        id="name" class="form-control" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="number" id="contact" class="form-control"
                                        value="{{ $rent->tenant->contact_no }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="email" value="{{ $rent->tenant->email }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" id="address" value="{{ $rent->tenant->address }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h3>Rent Details</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rent Type</label>
                                    <select class="form-control" name="rent_type" id="rent_type" required>
                                        <option value="">Select Rent Type</option>
                                        <option value="monthly" {{ $rent->rent_type == 'monthly' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="yearly" {{ $rent->rent_type == 'yearly' ? 'selected' : '' }}>
                                            Yearly</option>
                                    </select>
                                    @error('rent_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terms</label>
                                    <select class="form-control" name="terms" id="terms" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option {{ $rent->terms == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('terms')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        value="{{ $rent->start_date }}" required>
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" name="end_date" required id="end_date"
                                        value="{{ $rent->end_date }}">
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select class="form-control" name="payment_method" id="" required>
                                        <option value="cash" {{ $rent->payment_method == 'cash' ? 'selected' : '' }}>
                                            Cash
                                        </option>
                                        <option value="check" {{ $rent->payment_method == 'check' ? 'selected' : '' }}>
                                            check</option>
                                    </select>
                                    @error('payment_method')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount(%)</label>
                                    <input type="number" class="form-control" name="discount" id="discount"
                                        value="{{ $rent->discount }}" required>
                                    @error('discount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penalty(₱)</label>
                                    <input type="number" class="form-control" name="penalty" id="penalty"
                                        value="{{ $rent->penalty }}" required>
                                    @error('penalty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount(₱)</label>
                                    <input type="number" class="form-control" name="amount" id="amount"
                                        value="{{ $rent->amount }}" required>
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deposit(₱)</label>
                                    <input type="number" class="form-control" name="deposit"
                                        value="{{ $rent->deposit }}" required>
                                    @error('deposit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment (₱)</label>
                                    @php
                                        $payment = $rent->discount > 0 ? $rent->terms * ($rent->amount - $rent->amount * ($rent->discount / 100)) : $rent->terms * $rent->amount;
                                    @endphp
                                    <input type="number" class="form-control" step="0.01" id="total_amount"
                                        name="total_amount" value="{{ number_format($payment, 2) }}" readonly>
                                </div>
                            </div>
                        </div>

                    </section>
                    <h3>Finish</h3>
                    <section>
                        <div class="form-group">
                            <label>Comments/Notes</label>
                            <textarea name="notes" class="form-control" cols="30" rows="10">{{ $rent->notes }}</textarea>
                        </div>

                    </section>
                </div>
            </form>
        </div>
    </div>
    @include('rents.modal')
@endsection


@push('footer-script')
    <!-- Plugin js for this page-->
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="{{ asset('script/rent.js') }}"></script>
@endpush

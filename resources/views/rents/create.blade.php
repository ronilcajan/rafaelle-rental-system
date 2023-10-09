@extends('layouts.app')

@push('header-script')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}"> --}}
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $title }}</h4>
            <form method="POST" action="{{ route('property.store') }}" id="propertyForm">
                @csrf
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
                                            <option value="{{ $row->id }}">{{ $row->property_name }}</option>
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
                                    <input type="text" id="property_name" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" id="price" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Monthly Price</label>
                                    <input type="number" id="monthly_price" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Yearly Price</label>
                                    <input type="number" id="yearly_price" class="form-control" readonly>
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
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                                    <input type="text" id="name" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="number" id="contact" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="email" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" id="address" class="form-control" readonly>
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
                                    <select class="form-control" name="rent_type" id="" required>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    @error('rent_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terms</label>
                                    <select class="form-control" name="terms" id="" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option>{{ $i }}</option>
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
                                    <input type="date" class="form-control" name="date_started"
                                        value="{{ date('Y-m-d') }}" required>
                                    @error('date_started')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" name="end_started" required
                                        value="{{ old('end_started') }}">
                                    @error('end_started')
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
                                        <option value="cash">Cash</option>
                                        <option value="check">check</option>
                                    </select>
                                    @error('payment_method')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="number" class="form-control" name="discount"
                                        value="{{ old('discount') }}" required>
                                    @error('discount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penalty</label>
                                    <input type="number" class="form-control" name="penalty"
                                        value="{{ old('penalty') }}" required>
                                    @error('penalty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount"
                                        value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </section>
                    <h3>Finish</h3>
                    <section>
                        <div class="form-group">
                            <label>Comments/Notes</label>
                            <textarea name="notes" class="form-control" value="{{ old('notes') }}" cols="30" rows="10"></textarea>
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


    <script>
        propertyForm = $("#propertyForm");
        $("#properties-form").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            onStepChanging: function(event, currentIndex, newIndex) {
                // Validate the current step's input fields
                var isValid = validateStep(currentIndex);

                // Return true to allow navigation to the next step if validation succeeds, or false to prevent it
                return isValid;
            },
            onFinishing: function(event, currentIndex) {
                // Validate the final step's input fields
                var isValid = validateStep(currentIndex);

                // Return true to allow form submission if validation succeeds, or false to prevent it
                return isValid;
            },
            onFinished: function(event, currentIndex) {
                console.log("onFinished callback executed");
                propertyForm.serialize();
                propertyForm.submit();
            }
        });



        $(".properties").select2({
            theme: "classic",
            width: 'resolve',
        });

        $(".tenants").select2({
            theme: "classic",
            width: 'resolve',
        });

        function getProperties(that) {
            var id = $(that).val();

            $.get({
                url: `/property/${id}`, // Pass id as a route parameter
                success: function(response) {
                    console.log(response);
                    $('#property_name').val(response.property_name);
                    $('#price').val(response.price);
                    $('#monthly_price').val(response.monthly);
                    $('#yearly_price').val(response.yearly);
                },
                error: function(xhr) {
                    // Handle the error
                    console.log(xhr.responseText);

                    $('#property_name').val('');
                    $('#price').val('');
                    $('#monthly_price').val('');
                    $('#yearly_price').val('');
                }
            });
        }

        function getTenant(that) {
            var id = $(that).val();

            $.get({
                url: `/tenants/${id}`, // Pass id as a route parameter
                success: function(response) {
                    console.log(response);
                    $('#name').val(response.name);;
                    $('#contact').val(response.contact_no);
                    $('#email').val(response.email);
                    $('#address').val(response.address);
                },
                error: function(xhr) {
                    // Handle the error
                    console.log(xhr.responseText);

                    $('#name').val('');;
                    $('#contact_no').val('');
                    $('#email').val('');
                    $('#address').val('');
                }
            });
        }

        // Function to validate a step's input fields
        function validateStep(stepIndex) {
            var isValid = true;
            var step = $("#properties-form").find("section").eq(stepIndex);

            // Your validation logic here
            // Example: Check if required fields are filled out
            step.find("input.required").each(function() {
                if ($(this).val().trim() === "") {
                    isValid = false;
                    // You can display an error message or highlight the field as invalid here
                }
            });

            // Return the validation result
            return isValid;
        }
    </script>
@endpush

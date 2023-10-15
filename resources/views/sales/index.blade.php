@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Today’s Sales</p>
                    <p class="fs-30 mb-2">P {{ $today_sales }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Monthly Sales</p>
                    <p class="fs-30 mb-2">P {{ $monthly_sales }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Yearly Bookings</p>
                    <p class="fs-30 mb-2">P {{ $yearly_sales }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Sales</p>
                    <p class="fs-30 mb-2">P {{ $total_sales }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        @if (auth()->user()->hasRole('rental-admin'))
            <button type="button" class="btn btn-warning btn-rounded btn-icon" data-toggle="modal" data-tooltip="tooltip"
                data-target="#filter_date" title="Filter Date">
                <i class="ti-filter"></i>
            </button>
            <button type="button" class="btn btn-info btn-rounded btn-icon" data-toggle="modal"
                onclick="location.href='{{ url()->current() }}'" title="Reload">
                <i class="ti-reload"></i>
            </button>
            <button type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="modal" data-tooltip="tooltip"
                data-target="#create" title="Create Sales">
                <i class="ti-plus"></i>
            </button>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">
                        Add, edit, and remove sales.
                    </p>
                </div>
                <div class="col-md-4">
                    <form class="d-flex justify-content-between">
                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" name="search" id="inlineFormInputName2"
                            placeholder="Please enter to search"
                            value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Tenant</th>
                            <th>Property</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th class="hide-column">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $row)
                            <tr>
                                <td>{{ date('Y-m-d', strtotime($row->transaction_date)) }}</td>
                                <td>{{ $row->tenant->name ?? $row->payment->rent->tenant->name }}
                                </td>
                                <td>{{ $row->property->property_name ?? $row->payment->rent->property->property_name }}</td>
                                <td>
                                    <span class="badge badge-{{ $row->status ? 'primary' : 'warning' }}">
                                        {{ $row->status ? 'done' : 'pending' }}</span>
                                </td>
                                <td>{{ number_format($row->amount, 2) }}</td>
                                <td>
                                    <div class="row pl-3">
                                        @php
                                            $null = $row->tenant->name ?? 'null';
                                        @endphp
                                        @if ($null != 'null')
                                            <div class="col-auto p-0 mr-2">
                                                <button type="button" onclick="getSales({{ $row->id }})"
                                                    class="btn btn-link btn-fw btn-sm text-success p-0" data-toggle="modal"
                                                    data-target="#edit" title="Edit Sales">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="col-auto p-0 mr-2">
                                            <a href="{{ route('sales.receipt', $row->id) }}"
                                                class="btn btn-link btn-fw btn-sm text-info p-0" title="View Tenant">
                                                <i class="ti-import"></i>
                                            </a>
                                        </div>
                                        @can('delete')
                                            <div class="col-auto p-0">
                                                <form class="p-0 m-0" action="{{ route('sales.destroy', $row->id) }}"
                                                    method="post"
                                                    onsubmit="return confirm('Do you wish to delete this sales?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-fw btn-sm text-danger p-0"><i
                                                            class="ti-trash" title="Delete Sales"></i></button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
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
            <nav class="mt-5">
                <ul class="pagination flex-wrap pagination-flat pagination-primary justify-content-end">
                    {{ $sales->links() }}
                </ul>
            </nav>
        </div>
    </div>
    @include('sales.modal')
@endsection

@push('footer-script')
    <script>
        var currentURL = (window.location.href).split('?')[0];

        function getSales(id) {
            $.get({
                url: currentURL + "/" + id,
                success: function(response) {

                    console.log(response)

                    $('#sales_id').val(response.id);
                    $('#transaction_date').val(response.transaction_date);;
                    $('#property_id').val(response.property_id);
                    $('#tenant_id').val(response.tenant_id);
                    $('#payment_method').val(response.payment_method);
                    $('#amount').val(response.amount);
                    $('#notes').val(response.notes);

                },
                error: function(xhr) {
                    // Handle the error
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endpush

@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h4>{{ $totalUsers }}</h4>
                    <div>Total Users</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h4>{{ $totalProducts }}</h4>
                    <div>Total Products</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>{{ $totalCategories }}</h4>
                    <div>Categories</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    {{-- <h4>{{ $totalOrders }}</h4> --}}
                    <div>Total Orders</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="border p-3 rounded text-center">
                                {{-- <h4>{{ $pendingOrders }}</h4> --}}
                                <div>Pending</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border p-3 rounded text-center">
                                {{-- <h4>{{ $processingOrders }}</h4> --}}
                                <div>Processing</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border p-3 rounded text-center">
                                {{-- <h4>{{ $shippingOrders }}</h4> --}}
                                <div>Shipping</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border p-3 rounded text-center">
                                {{-- <h4>{{ $completedOrders }}</h4> --}}
                                <div>Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Users Statistics</h5>
                </div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Sales Statistics</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Users Chart
const userCtx = document.getElementById('userChart');
new Chart(userCtx, {
    type: 'line',
    data: {
        labels: @json($userChartLabels),
        datasets: [{
            label: 'New Users',
            data: @json($userChartData),
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    }
});

// Sales Chart
const salesCtx = document.getElementById('salesChart');
new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: @json($salesChartLabels),
        datasets: [{
            label: 'Sales',
            data: @json($salesChartData),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1
        }]
    }
});
</script>
@endpush

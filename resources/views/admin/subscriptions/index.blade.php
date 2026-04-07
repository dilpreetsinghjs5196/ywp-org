@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h6 class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Finance Management</h6>
            <h1 class="mb-0">Recurring Subscriptions</h1>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Active Subscriptions</h6>
                        <h2 class="mb-0 fw-bold">{{ $subscriptions->where('status', 'active')->count() }}</h2>
                        <p class="text-success small mt-2 mb-0"><i class="fa fa-sync fa-spin"></i> Currently Active</p>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-redo text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Monthly Revenue</h6>
                        <h2 class="mb-0 fw-bold">₹{{ number_format($subscriptions->where('status', 'active')->sum('amount'), 2) }}</h2>
                        <p class="text-muted small mt-2 mb-0 text-truncate">Estimated recurring income</p>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-chart-line text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Total Enrolled</h6>
                        <h2 class="mb-0 fw-bold">{{ $subscriptions->count() }}</h2>
                        <p class="text-muted small mt-2 mb-0">Total historical subscriptions</p>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-users text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="glass-card p-0 border-0 shadow-sm overflow-hidden">
        <div class="p-4 border-bottom bg-light bg-opacity-10 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Donor Subscriptions</h5>
            <div class="d-flex gap-3">
                <div class="position-relative">
                    <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="subSearch" class="form-control form-control-sm ps-5" placeholder="Search donors..." style="width: 250px;">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="subsTable">
                <thead class="bg-light bg-opacity-50">
                    <tr>
                        <th class="ps-4 border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Donor</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Monthly Amount</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Next Billing</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase text-center" style="font-size: 0.7rem; letter-spacing: 0.5px;">Status</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase text-end" style="font-size: 0.7rem; letter-spacing: 0.5px;">Razorpay ID</th>
                        <th class="pe-4 border-0 py-3 text-muted fw-bold text-uppercase text-end" style="font-size: 0.7rem; letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $sub)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                    <span class="fw-bold text-primary" style="font-size: 0.75rem;">{{ strtoupper(substr($sub->donor_name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark sub-search-name" style="font-size: 0.85rem;">{{ $sub->donor_name }}</div>
                                    <div class="text-muted sub-search-email" style="font-size: 0.75rem;">{{ $sub->donor_email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">₹{{ number_format($sub->amount, 2) }}</div>
                        </td>
                        <td class="py-3">
                            <div class="text-dark" style="font-size: 0.82rem;">
                                {{ $sub->next_billing_at_display }}
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            @php
                                $statusClass = match($sub->live_status) {
                                    'active' => 'bg-success-soft text-success',
                                    'created' => 'bg-info-soft text-info',
                                    'cancelled' => 'bg-danger-soft text-danger',
                                    default => 'bg-warning-soft text-dark'
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-1" style="font-size: 0.75rem;">
                                {{ ucfirst($sub->live_status) }}
                            </span>
                        </td>
                        <td class="pe-4 py-3 text-end">
                            <code class="px-2 py-1 bg-light rounded text-dark" style="font-size: 0.7rem;">{{ $sub->razorpay_subscription_id }}</code>
                        </td>
                        <td class="pe-4 py-3 text-end">
                            @if($sub->live_status === 'active' || $sub->live_status === 'created')
                                <form action="{{ route('admin.subscriptions.cancel', $sub->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this subscription? This will stop all future payments.');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.7rem;">
                                        <i class="fa fa-times-circle"></i> Cancel
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">No actions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="opacity-25 mb-3">
                                <i class="fa fa-sync fa-4x"></i>
                            </div>
                            <h5 class="text-muted">No monthly subscriptions yet</h5>
                            <p class="text-muted small">Subscription details will appear here once donors enroll.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.01);
    }
</style>

@push('scripts')
<script>
    document.getElementById('subSearch').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#subsTable tbody tr');

        tableRows.forEach(row => {
            let name = row.querySelector('.sub-search-name')?.innerText.toLowerCase() || '';
            let email = row.querySelector('.sub-search-email')?.innerText.toLowerCase() || '';
            
            if (name.includes(searchValue) || email.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection

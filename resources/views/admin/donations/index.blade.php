@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h6 class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Finance Management</h6>
            <h1 class="mb-0">Donations List</h1>
        </div>
        <div class="d-flex gap-2">
            @if(!$donations->isEmpty())
            <a href="{{ route('admin.donations.download') }}" class="btn btn-premium d-flex align-items-center gap-2">
                <i class="fa fa-download"></i> <span>Export Donors</span>
            </a>
            @endif
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="fa fa-exclamation-triangle me-3"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Total Donations</h6>
                        <h2 class="mb-0 fw-bold">{{ $donations->count() }}</h2>
                        <p class="text-muted small mt-2 mb-0">From latest 100 records</p>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-hand-holding-heart text-primary fs-4"></i>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 opacity-05" style="font-size: 8rem; line-height: 1; transform: translate(20%, 20%); color: var(--primary-bg);">
                    <i class="fa fa-hand-holding-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Total Collected</h6>
                        <h2 class="mb-0 fw-bold">₹{{ number_format($donations->sum('amount'), 2) }}</h2>
                        <p class="text-success small mt-2 mb-0"><i class="fa fa-chart-line"></i> Live from Razorpay</p>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-rupee-sign text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 border-0 shadow-sm position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold">Average Donation</h6>
                        <h2 class="mb-0 fw-bold">₹{{ number_format($donations->count() > 0 ? $donations->avg('amount') : 0, 2) }}</h2>
                        <p class="text-muted small mt-2 mb-0 text-truncate">Per successful transaction</p>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-4">
                        <i class="fa fa-calculator text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="glass-card p-0 border-0 shadow-sm overflow-hidden">
        <div class="p-4 border-bottom bg-light bg-opacity-10 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Live Transactions</h5>
            <div class="d-flex gap-3">
                <div class="position-relative">
                    <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="donationSearch" class="form-control form-control-sm ps-5" placeholder="Search donors..." style="width: 250px;">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="donationsTable">
                <thead class="bg-light bg-opacity-50">
                    <tr>
                        <th class="ps-4 border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Date & Time</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Donor</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Amount</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Payment ID</th>
                        <th class="border-0 py-3 text-muted fw-bold text-uppercase text-center" style="font-size: 0.7rem; letter-spacing: 0.5px;">Status</th>
                        <th class="pe-4 border-0 py-3 text-muted fw-bold text-uppercase text-end" style="font-size: 0.7rem; letter-spacing: 0.5px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="text-dark fw-bold" style="font-size: 0.82rem;">{{ \Carbon\Carbon::parse($donation->created_at)->format('d M, Y') }}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">{{ \Carbon\Carbon::parse($donation->created_at)->format('h:i A') }}</div>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                    <span class="fw-bold text-secondary" style="font-size: 0.75rem;">{{ strtoupper(substr($donation->donor_name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark donor-search-name" style="font-size: 0.85rem;">{{ $donation->donor_name }}</div>
                                    <div class="text-muted donor-search-email" style="font-size: 0.75rem;">{{ $donation->donor_email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">₹{{ number_format($donation->amount, 2) }}</div>
                        </td>
                        <td class="py-3">
                            <code class="px-2 py-1 bg-light rounded text-dark" style="font-size: 0.7rem;">{{ $donation->payment_id ?? 'N/A' }}</code>
                        </td>
                        <td class="py-3 text-center">
                            @if($donation->status == 'captured' || $donation->status == 'success')
                                <span class="badge rounded-pill bg-success-soft text-success px-3 py-1" style="font-size: 0.75rem;">
                                    <i class="fa fa-check-circle me-1"></i> Success
                                </span>
                            @else
                                <span class="badge rounded-pill bg-warning-soft text-dark px-3 py-1" style="font-size: 0.75rem;">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="pe-4 py-3 text-end">
                            <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 shadow-none fw-bold" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#modal-{{ str_replace('_', '', $donation->id) }}">
                                View Details
                            </button>

                            <!-- Modal Content -->
                            <div class="modal fade" id="modal-{{ str_replace('_', '', $donation->id) }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                                        <div class="modal-header border-0 pb-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-5 pt-0 text-start">
                                            <div class="text-center mb-4">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                                    <i class="fa fa-user text-primary fs-2"></i>
                                                </div>
                                                <h4 class="fw-bold mb-1">{{ $donation->donor_name }}</h4>
                                                <p class="text-muted">{{ $donation->donor_email }}</p>
                                            </div>

                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <p class="text-muted small text-uppercase fw-bold mb-1">Mobile</p>
                                                    <p class="fw-bold mb-0">{{ $donation->donor_mobile }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-muted small text-uppercase fw-bold mb-1">PAN Number</p>
                                                    <p class="fw-bold mb-0 text-uppercase">{{ $donation->donor_pan }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-muted small text-uppercase fw-bold mb-1">Address</p>
                                                    <p class="fw-bold mb-0">{{ $donation->donor_address }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-muted small text-uppercase fw-bold mb-1">Campaign / Referred By</p>
                                                    <p class="fw-bold mb-0">{{ $donation->referred_by }}</p>
                                                </div>
                                                <div class="col-12 bg-light p-3 rounded-4 mt-4">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <p class="text-muted small text-uppercase fw-bold mb-1">Payment ID</p>
                                                            <code class="text-dark">{{ $donation->payment_id }}</code>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="text-muted small text-uppercase fw-bold mb-1">Amount</p>
                                                            <p class="fw-bold mb-0 text-primary">₹{{ number_format($donation->amount, 2) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 p-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25 mb-3">
                                <i class="fa fa-hand-holding-heart fa-4x"></i>
                            </div>
                            <h5 class="text-muted">No donations found yet</h5>
                            <p class="text-muted small">Once someone donates via Razorpay, it will appear here.</p>
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
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .opacity-05 { opacity: 0.05; }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.01);
    }
    
    .btn-light:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
    }

    #donationsTable td {
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    #donationsTable tr:last-child td {
        border-bottom: none;
    }
</style>

@push('scripts')
<script>
    document.getElementById('donationSearch').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#donationsTable tbody tr');

        tableRows.forEach(row => {
            let name = row.querySelector('.donor-search-name')?.innerText.toLowerCase() || '';
            let email = row.querySelector('.donor-search-email')?.innerText.toLowerCase() || '';
            
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


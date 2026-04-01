@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <h1 class="mb-4 text-capitalize">{{ $group ?? 'Home' }} Content Management</h1>
    
    @foreach($sections as $page => $pageSections)
        <div class="mb-5">
            <h3 class="mb-3 text-capitalize" style="color: var(--accent-orange);">{{ $page }} Page</h3>
            <div class="row g-4">
                @foreach($pageSections as $section)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px);">
                            <div class="card-body p-4">
                                @php 
                                    $displayName = $section->section === 'faq' ? 'FAQs' : ucfirst(str_replace('_', ' ', $section->section));
                                @endphp
                                <h4 class="card-title fw-bold">{{ $displayName }}</h4>
                                <div class="p-3 mb-4" style="background: var(--bg-main); border-radius: 12px;">
                                    <p class="text-muted small mb-0">Sections of content for your {{ $page }} page {{ $section->section === 'faq' ? 'FAQs' : '' }}.</p>
                                </div>
                                <a href="{{ route('admin.page-content.edit', ['page' => $page, 'section' => $section->section]) }}" class="btn-premium px-4 text-decoration-none d-inline-block">
                                    <i class="fa fa-edit"></i> Edit Section
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    @endforeach
</div>
@endsection

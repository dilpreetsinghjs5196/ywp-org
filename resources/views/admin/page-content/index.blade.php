@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <h1 class="mb-4">Page Content Management</h1>
    
    @foreach($sections as $page => $pageSections)
        <div class="mb-5">
            <h3 class="mb-3 text-capitalize" style="color: var(--accent-orange);">{{ $page }} Page</h3>
            <div class="row g-4">
                @foreach($pageSections as $section)
                    <div class="col-md-4">
                        <div class="p-3 border rounded shadow-sm" style="background: rgba(255,255,255,0.02);">
                            <h5 style="color: var(--text-main);">{{ ucfirst(str_replace('_', ' ', $section->section)) }}</h5>
                            <p class="section-badge mb-3">Sections of content for your {{ $page }} page.</p>
                            <a href="{{ route('admin.page-content.edit', ['page' => $page, 'section' => $section->section]) }}" class="btn-premium w-100">
                                <i class="fa fa-edit"></i> Edit Section
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

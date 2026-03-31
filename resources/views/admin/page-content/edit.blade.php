@extends('admin.layouts.app')

@section('content')
<style>
    .form-control {
        border-radius: 12px !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
        padding: 12px 18px !important;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: var(--accent-orange) !important;
        box-shadow: 0 0 0 4px rgba(243, 67, 54, 0.1) !important;
        background: #fff !important;
    }
    .item-block .card {
        transition: transform 0.3s ease;
    }
    .item-block .card:hover {
        transform: translateY(-5px);
    }
</style>
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.page-content.index') }}" style="color: var(--accent-orange);">Home Content</a></li>
                    <li class="breadcrumb-item text-capitalize" style="color: var(--text-muted);">{{ str_replace('_', ' ', $section) }}</li>
                </ol>
            </nav>
            <h1 class="mb-0 text-capitalize">Edit {{ str_replace('_', ' ', $section) }}</h1>
        </div>
        <div class="d-flex gap-3 align-items-center">
            @if($section === 'hero')
                <button type="button" id="add-slide" class="btn btn-success" style="border-radius: 10px;">
                    <i class="fa fa-plus"></i> Add Slide
                </button>
            @elseif($section === 'faq')
                <button type="button" id="add-faq" class="btn btn-success" style="border-radius: 10px;">
                    <i class="fa fa-plus"></i> Add FAQ
                </button>
            @endif
            <a href="{{ route('admin.page-content.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px; display: flex; align-items: center; justify-content: center; width: 45px; height: 45px;">
                <i class="fa fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.page-content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="page" value="{{ $page }}">
        <input type="hidden" name="section" value="{{ $section }}">
        
        <div class="row g-4 @if($section === 'hero' || $section === 'we_believe' || $section === 'faq') item-container @endif">
            @if($section === 'hero')
                @php
                    $slides = [];
                    foreach($contents as $content) {
                        preg_match('/slide(\d+)_(\w+)/', $content->key, $matches);
                        if(count($matches) == 3) { $slides[$matches[1]][$matches[2]] = ['id' => $content->id, 'value' => $content->value]; }
                    }
                    ksort($slides);
                @endphp

                @foreach($slides as $index => $slide)
                    <div class="col-md-12 item-block mb-4" data-index="{{ $index }}">
                        <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative;">
                            <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                                <i class="fa fa-trash"></i>
                            </button>
                            <h5 class="mb-4" style="color: var(--text-main);">Slide {{ $index }}</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">Title</label>
                                    <textarea name="slides[{{ $index }}][title]" class="form-control" rows="2">{{ $slide['title']['value'] ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">Subtitle</label>
                                    <input type="text" name="slides[{{ $index }}][subtitle]" class="form-control" value="{{ $slide['subtitle']['value'] ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-muted small">Image</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if(isset($slide['image']['value']))
                                            <img src="{{ asset($slide['image']['value']) }}" height="60" style="border-radius: 8px;">
                                        @endif
                                        <input type="file" name="slides[{{ $index }}][image]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($section === 'we_believe')
                @php
                    $fixedFields = $contents->whereIn('key', ['tagline', 'title']);
                    $icons = [];
                    foreach($contents as $content) {
                        preg_match('/icon(\d+)_(\w+)/', $content->key, $matches);
                        if(count($matches) == 3) { $icons[$matches[1]][$matches[2]] = ['id' => $content->id, 'value' => $content->value]; }
                    }
                    ksort($icons);
                @endphp

                <div class="col-12"><h4 class="mb-3">Header Text</h4></div>
                @foreach($fixedFields as $field)
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-capitalize" style="color: var(--text-muted);">{{ str_replace('_', ' ', $field->key) }}</label>
                        @if($field->type === 'textarea')
                            <textarea name="values[{{ $field->id }}]" class="form-control" rows="3">{{ $field->value }}</textarea>
                        @else
                            <input type="text" name="values[{{ $field->id }}]" class="form-control" value="{{ $field->value }}">
                        @endif
                    </div>
                @endforeach

                <div class="col-12 mt-4 border-top pt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Icons Section</h4>
                        <button type="button" id="add-icon" class="btn btn-success" style="border-radius: 10px;">
                            <i class="fa fa-plus"></i> Add Icon
                        </button>
                    </div>
                </div>

                @if(count($icons) > 0)
                    @foreach($icons as $index => $icon)
                        <div class="col-md-6 item-block mb-4" data-index="{{ $index }}">
                            <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative;">
                                <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <h5 class="mb-4" style="color: var(--text-main);">Icon Item</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Label</label>
                                        <input type="text" name="icons[{{ $index }}][title]" class="form-control" value="{{ $icon['title']['value'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Redirect Link</label>
                                        <input type="text" name="icons[{{ $index }}][link]" class="form-control" value="{{ $icon['link']['value'] ?? '' }}" placeholder="e.g. /events or https://...">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label text-muted small">Icon Class (FontAwesome or Theme Icon)</label>
                                        <input type="text" name="icons[{{ $index }}][class]" class="form-control" value="{{ $icon['class']['value'] ?? 'icon-heart' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5 empty-msg">
                        <p class="text-muted italic">No icons added yet. Click "+ Add Icon" to start.</p>
                    </div>
                @endif
            @elseif($section === 'faq')
                @php
                    $faqsArr = [];
                    foreach($contents as $content) {
                        if(preg_match('/faq(\d+)_(\w+)/', $content->key, $matches)) {
                            $faqsArr[$matches[1]][$matches[2]] = ['id' => $content->id, 'value' => $content->value];
                        }
                    }
                    ksort($faqsArr);
                @endphp

                @foreach($faqsArr as $index => $faqItem)
                    <div class="col-md-12 item-block mb-4" data-index="{{ $index }}">
                        <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative; border-left: 5px solid var(--accent-orange) !important;">
                            <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                                <i class="fa fa-trash"></i>
                            </button>
                            <h5 class="mb-4" style="color: var(--text-main);">FAQ Item</h5>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label text-muted small">Question</label>
                                    <input type="text" name="faqs[{{ $index }}][question]" class="form-control" value="{{ $faqItem['question']['value'] ?? '' }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-muted small">Answer</label>
                                    <textarea name="faqs[{{ $index }}][answer]" class="form-control" rows="3" required>{{ $faqItem['answer']['value'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if(count($faqsArr) === 0)
                    <div class="col-12 text-center py-5 empty-msg">
                        <p class="text-muted italic">No FAQs added yet. Click "+ Add FAQ" to start.</p>
                    </div>
                @endif
            @else
                @foreach($contents as $content)
                    <div class="col-md-6 mb-3">
                        <div class="card bg-transparent border-0">
                            <label class="form-label text-capitalize" style="color: var(--text-muted);">{{ str_replace('_', ' ', $content->key) }}</label>
                            
                            @if($content->type === 'textarea')
                                <textarea name="values[{{ $content->id }}]" class="form-control" rows="4">{{ $content->value }}</textarea>
                            @elseif($content->type === 'image')
                                <div class="d-flex align-items-start gap-3">
                                    <img src="{{ asset($content->value) }}" height="80" style="border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="flex-grow-1">
                                        <input type="file" name="values[{{ $content->id }}]" class="form-control">
                                        <small class="text-muted d-block mt-1">Recommended: JPG or PNG</small>
                                    </div>
                                </div>
                            @else
                                <input type="text" name="values[{{ $content->id }}]" class="form-control" value="{{ $content->value }}">
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>

@if($section === 'hero' || $section === 'we_believe' || $section === 'faq')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.item-container');
    const addSlideBtn = document.getElementById('add-slide');
    const addIconBtn = document.getElementById('add-icon');
    const addFaqBtn = document.getElementById('add-faq');
    
    function getMaxIndex(selector) {
        let max = 0;
        document.querySelectorAll(selector).forEach(item => {
            const index = parseInt(item.dataset.index);
            if (index > max) max = index;
        });
        return max;
    }

    if(addSlideBtn) {
        addSlideBtn.addEventListener('click', function() {
            const nextIndex = getMaxIndex('.item-block') + 1;
            const slideHtml = `
                <div class="col-md-12 item-block mb-4" data-index="${nextIndex}">
                    <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative;">
                        <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                            <i class="fa fa-trash"></i>
                        </button>
                        <h5 class="mb-4" style="color: var(--text-main);">Slide ${nextIndex}</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Title</label>
                                <textarea name="slides[${nextIndex}][title]" class="form-control" rows="2" placeholder="Slide Title"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Subtitle</label>
                                <input type="text" name="slides[${nextIndex}][subtitle]" class="form-control" placeholder="Slide Subtitle">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Image</label>
                                <input type="file" name="slides[${nextIndex}][image]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', slideHtml);
        });
    }

    if(addIconBtn) {
        addIconBtn.addEventListener('click', function() {
            const emptyMsg = document.querySelector('.empty-msg');
            if(emptyMsg) emptyMsg.remove();
            
            const nextIndex = getMaxIndex('.item-block') + 1;
            const iconHtml = `
                <div class="col-md-6 item-block mb-4" data-index="${nextIndex}">
                    <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative;">
                        <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                            <i class="fa fa-trash"></i>
                        </button>
                        <h5 class="mb-4" style="color: var(--text-main);">New Icon Item</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Label</label>
                                <input type="text" name="icons[${nextIndex}][title]" class="form-control" placeholder="e.g. Engage">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Redirect Link</label>
                                <input type="text" name="icons[${nextIndex}][link]" class="form-control" placeholder="e.g. /events">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Icon Class (FontAwesome or Theme Icon)</label>
                                <input type="text" name="icons[${nextIndex}][class]" class="form-control" placeholder="e.g. icon-heart">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', iconHtml);
        });
    }

    if(addFaqBtn) {
        addFaqBtn.addEventListener('click', function() {
            const emptyMsg = document.querySelector('.empty-msg');
            if(emptyMsg) emptyMsg.remove();
            
            const nextIndex = getMaxIndex('.item-block') + 1;
            const faqHtml = `
                <div class="col-md-12 item-block mb-4" data-index="${nextIndex}">
                    <div class="card p-4 border-0 shadow-sm" style="background: rgba(255,255,255,0.5); border-radius: 15px; position: relative; border-left: 5px solid var(--accent-orange) !important;">
                        <button type="button" class="btn btn-danger btn-sm remove-item" style="position: absolute; right: 15px; top: 15px; border-radius: 8px;">
                            <i class="fa fa-trash"></i>
                        </button>
                        <h5 class="mb-4" style="color: var(--text-main);">New FAQ Item</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Question</label>
                                <input type="text" name="faqs[${nextIndex}][question]" class="form-control" placeholder="Type question here..." required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Answer</label>
                                <textarea name="faqs[${nextIndex}][answer]" class="form-control" rows="3" placeholder="Type answer here..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', faqHtml);
        });
    }



    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.parentElement.classList.contains('remove-item')) {
            const item = e.target.closest('.item-block');
            if (confirm('Are you sure you want to remove this item?')) {
                item.remove();
            }
        }
    });
});
</script>
@endif
@endsection

@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="job-category padding-top padding-bottom">
        <div class="container">
            <div class="row g-3 g-xl-4 justify-content-center">
                @forelse($subCategories as $subcategory)
                    <div class="col-lg-4 col-xl-3 col-md-4 col-sm-6">
                        <div class="category__item">
                            <div class="category__item-icon">
                                <img src="{{ getImage(getFilePath('subcategory') . '/' . $subcategory->image, getFileSize('subcategory')) }}" alt="@lang('icon')">
                            </div>
                            <div class="category__item-content">
                                <h5 class="title">{{ __($subcategory->name) }}</h5>
                                <p class="mt-2">{{ __($subcategory->description) }}</p>
                            </div>
                            <span class="job-count bg--base p-2 text--white rounded-3">{{ $subcategory->jobApprove }}</span>

                            <a class="job_cate" href="{{ route('subcategory.jobs', [$subcategory->id, slug($subcategory->name)]) }}"></a>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 text-center">
                        <h2 class="section__header-title text--base">{{ __($emptyMessage) }}</h2>
                    </div>
                @endforelse
            </div>
            @if ($subCategories->hasPages())
                {{ paginateLinks($subCategories) }}
            @endif
        </div>
    </section>
@endsection

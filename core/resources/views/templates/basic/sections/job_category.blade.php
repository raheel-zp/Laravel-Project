@php
    $jobContent = getContent('job_category.content', true);
    $categories = App\Models\Category::featured()
        ->active()
        ->with('jobPosts')
        ->withCount([
            'jobPosts as approveJob' => function ($jobPost) {
                $jobPost->approved();
            },
        ])
        ->orderBy('approveJob','DESC')
        ->take(8)
        ->get();
@endphp

<!-- NIEZALOGOWANY -->
@guest
@else
<!-- NIEZALOGOWANY -->
<!-- ZALOGOWANY -->
<section class="job-category padding-top padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title">{{ __($jobContent->data_values->heading) }}</h2>
                    <p>{{ __($jobContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row g-3 g-xl-4 justify-content-center">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-xl-3 col-md-4 col-sm-6">
                    <div class="category__item">
                        <div class="category__item-icon">
                            <img src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) }}">
                        </div>
                        <div class="category__item-content">
                            <h5 class="title">{{ __($category->name) }}</h5>
                            <p class="mt-2">{{ __($category->description) }}</p>
                        </div>
                        <span class="job-count bg--base p-2 rounded-3 text--white">
                            {{ @$category->approveJob }}
                        </span>
                        <a class="job_cate" href="{{ route('subcategory.list', [$category->id, slug($category->name)]) }}"></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 mt-4">
                <div class="section__header text-center">
                    <a href="{{ route('category.list') }}" class="btn btn--base">@lang('View all')</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endguest
<!-- ZALOGOWANY -->

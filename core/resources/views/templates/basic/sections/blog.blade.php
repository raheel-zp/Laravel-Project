@php
    $blogContent = getContent('blog.content', true);
    $blogElement = getContent('blog.element', false, 6, false);
@endphp
<section class="blog-section padding-top padding-bottom section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title">{{ __(@$blogContent->data_values->heading) }}</h2>
                    <p>{{ __(@$blogContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($blogElement as $blog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post__item">
                        <div class="post__item-thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '410x300') }}" alt="{{ __($blog->data_values->title) }}">
                        </div>
                        <div class="post__item-content">
                            <h5 class="title">
                                <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}">
                                    {{ __($blog->data_values->title) }}
                                </a>
                            </h5>
                            <ul class="post-meta">
                                <li>
                                    <span class="date">
                                        <i class="fas fa-calendar"></i>
                                        {{ showDateTime($blog->created_at, 'j F Y') }}
                                    </span>
                                </li>
                            </ul>
                            <p>{{ shortDescription(@$blog->data_values->description, 100) }}</p>
                            <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}" class="read-more">
                                @lang('Read More')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

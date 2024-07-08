@php
    $freelancerContent = getContent('top_freelancer.content', true);
    $topFreelancer = \App\Models\JobProve::approve()
        ->groupBy('user_id')
        ->selectRaw('count(id) as count, user_id')
        ->with('user')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();
@endphp
<section class="freelancer-section padding-top padding-bottom overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title">{{ __($freelancerContent->data_values->heading) }}</h2>
                    <p>{{ __(@$freelancerContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="freelancer__slider">
            @foreach ($topFreelancer as $freelancer)
                <div class="single-slide">
                    <div class="freelancer__item">
                        <div class="freelancer__header">
                            <div class="thumb">
                                @if ($freelancer->user->image)
                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . $freelancer->user->image, getFileSize('userProfile')) }}" alt="@lang('User')">
                                @else
                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}" alt="@lang('User')">
                                @endif
                            </div>
                            <h5 class="name">{{ @$freelancer->user->fullname }}</h5>
                            <p class="designation">{{@$freelancer->user->email}}</p>
                            <p class="designation">
                            @php
                                $averageRating =  $freelancer->user->calculateRating($freelancer->user_id);
                            @endphp
                                <i data-star="{{@$averageRating}}"></i> <a href="{{ route('profile.details', [@$freelancer->user_id, slug(@$freelancer->user->fullname)]) }}">@lang('(Read reviews)')</a>
                            </p>
                        </div>
                        <div class="freelancer__footer">
                            <ul class="freelancer__info">
                                <li class="d-flex justify-content-between flex-wrap mb-2 me-0">
                                    <span>@lang('Country')</span>
                                    <span class="text-end">{{ @$freelancer->user->address->country }}</span>
                                </li>
                                <li class="d-flex justify-content-between flex-wrap">
                                    <span >@lang('Jobs Completed')</span>
                                    <span class="text-end">{{ $freelancer->count }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@push('style')
<style>
/* START FROM HERE */

[data-star] {
  text-align:left;
  font-style:normal;
  display:inline-block;
  position: relative;
  unicode-bidi: bidi-override;
}
[data-star]::before { 
  display:block;
  content: '★★★★★';
  color: #eee;
}
[data-star]::after {
  white-space:nowrap;
  position:absolute;
  top:0;
  left:0;
  content: '★★★★★';
  width: 0;
  color: #ff8c00;
  overflow:hidden;
  height:100%;
}

[data-star^="0.1"]::after{width:2%}
[data-star^="0.2"]::after{width:4%}
[data-star^="0.3"]::after{width:6%}
[data-star^="0.4"]::after{width:8%}
[data-star^="0.5"]::after{width:10%}
[data-star^="0.6"]::after{width:12%}
[data-star^="0.7"]::after{width:14%}
[data-star^="0.8"]::after{width:16%}
[data-star^="0.9"]::after{width:18%}
[data-star^="1"]::after{width:20%}
[data-star^="1.1"]::after{width:22%}
[data-star^="1.2"]::after{width:24%}
[data-star^="1.3"]::after{width:26%}
[data-star^="1.4"]::after{width:28%}
[data-star^="1.5"]::after{width:30%}
[data-star^="1.6"]::after{width:32%}
[data-star^="1.7"]::after{width:34%}
[data-star^="1.8"]::after{width:36%}
[data-star^="1.9"]::after{width:38%}
[data-star^="2"]::after{width:40%}
[data-star^="2.1"]::after{width:42%}
[data-star^="2.2"]::after{width:44%}
[data-star^="2.3"]::after{width:46%}
[data-star^="2.4"]::after{width:48%}
[data-star^="2.5"]::after{width:50%}
[data-star^="2.6"]::after{width:52%}
[data-star^="2.7"]::after{width:54%}
[data-star^="2.8"]::after{width:56%}
[data-star^="2.9"]::after{width:58%}
[data-star^="3"]::after{width:60%}
[data-star^="3.1"]::after{width:62%}
[data-star^="3.2"]::after{width:64%}
[data-star^="3.3"]::after{width:66%}
[data-star^="3.4"]::after{width:68%}
[data-star^="3.5"]::after{width:70%}
[data-star^="3.6"]::after{width:72%}
[data-star^="3.7"]::after{width:74%}
[data-star^="3.8"]::after{width:76%}
[data-star^="3.9"]::after{width:78%}
[data-star^="4"]::after{width:80%}
[data-star^="4.1"]::after{width:82%}
[data-star^="4.2"]::after{width:84%}
[data-star^="4.3"]::after{width:86%}
[data-star^="4.4"]::after{width:88%}
[data-star^="4.5"]::after{width:90%}
[data-star^="4.6"]::after{width:92%}
[data-star^="4.7"]::after{width:94%}
[data-star^="4.8"]::after{width:96%}
[data-star^="4.9"]::after{width:98%}
[data-star^="5"]::after{width:100%}
</style>
@endpush

<div class="dashboard__responsive__header d-flex align-items-center justify-content-between d-lg-none">
    <div class="thumb__wrapper d-flex align-items-center">
        <div class="thumb me-2">
            @if (auth()->user()->image)
                <img src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}">
            @else
                <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}">
            @endif
        </div>
        <span class="username">{{ auth()->user()->username }}</span>
    </div>
    <div class="dashboard__sidebar__toggler"><i class="las la-sliders-h"></i></div>
</div>

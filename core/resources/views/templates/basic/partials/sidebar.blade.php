@php
    $user = auth()->user();
@endphp
<div class="col-lg-4 col-xl-3">
    <div class="dashboard__sidebar">
        <div class="user__profile">
            <div class="user__profile-thumb">
                @if ($user->image)
                    <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}">
                @else
                    <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}">
                @endif
            </div>
            <div class="user__profile-content">
                <h4 class="user__profile-title">{{ $user->fullname }}</h4>
                <span class="designation d-block">
                    @lang('Balance'): {{ showAmount($user->balance) }} {{ $general->cur_text }}
                </span>
                <h6 class="text--base d-block">
                    @lang('Username:') {{ $user->username }}
                </h6>

            </div>
        </div>
        <ul class="dashboard__sidebar__menu">
            <li>
                <a href="{{ route('user.home') }}" class="{{ menuActive('user.home') }}">@lang('Dashboard')</a>
            </li>

            @if (!auth()->user()->block_status)
            <li class="has__submenu">
                <a href="javascript:void(0)">@lang('Job')</a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="{{ route('user.job.create') }}" class="{{ menuActive(['user.job.create', 'user.job.edit']) }}">
                            @lang('Create Job')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.job.history') }}" class="{{ menuActive(['user.job.history', 'user.job.details']) }}">
                            @lang('Job History')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.job.finished') }}" class="{{ menuActive('user.job.finished') }}">
                            @lang('Finished Jobs')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.job.apply') }}" class="{{ menuActive('user.job.apply') }}">
                            @lang('Applied Jobs')
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <li class="has__submenu">
                <a href="javascript:void(0)">@lang('RefLink')</a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="{{ route('user.referral.getReferralLink') }}" class="{{ menuActive(['user.referral.getReferralLink']) }}">
                            @lang('Your RefLink')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.referral.getUserReferrals') }}" class="{{ menuActive(['user.referral.getUserReferrals']) }}">
                            @lang('RefLink History')
                        </a>
                    </li>
                </ul>
            </li>


            <li><a href="javascript:void(0)">@lang('Deposit')</a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="{{ route('user.deposit.index') }}" class="{{ menuActive(['user.deposit.index', 'user.deposit.confirm']) }}">
                            @lang('Deposit Now')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.deposit.history') }}" class="{{ menuActive('user.deposit.history') }}">
                            @lang('Deposit History')
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="javascript:void(0)">@lang('Withdraw')</a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="{{ route('user.withdraw') }}" class="{{ menuActive(['user.withdraw', 'user.withdraw.preview']) }}">
                            @lang('Withdraw Now')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.withdraw.history') }}" class="{{ menuActive(['user.withdraw.history']) }}">
                            @lang('Withdraw History')
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('user.transactions') }}" class="{{ menuActive('user.transactions') }}">
                    @lang('Transactions')
                </a>
            </li>

            <li><a href="javascript:void(0)">@lang('Contest')</a>
                <ul class="sidebar__submenu">
                    <li><a href="{{ route('contest.home') }}" class="{{ menuActive('contest.home') }}">@lang('Referral Contest')</a></li>
                    <li><a href="{{ route('contest.addingJobs') }}" class="{{ menuActive('contest.addingJobs') }}">@lang('Contest for Adding Jobs')</a></li>
                    <li><a href="{{ route('contest.makingJobs') }}" class="{{ menuActive(['contest.makingJobs']) }}">@lang('Contest for Making Jobs')</a>
                    </li>
                </ul>
            </li>

            <li><a href="javascript:void(0)">@lang('Support Ticket')</a>
                <ul class="sidebar__submenu">
                    <li><a href="{{ route('ticket.open') }}" class="{{ menuActive('ticket.open') }}">@lang('Create Ticket')</a></li>
                    <li><a href="{{ route('ticket.index') }}" class="{{ menuActive(['ticket.index', 'ticket.view']) }}">@lang('Ticket History')</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)">@lang('Rating Profile')</a>
                <ul class="sidebar__submenu">
                    <li><a href="{{ route('profile.ratingOnJobPosted',[auth()->id(), slug(auth()->user()->fullname)]) }}" class="{{ menuActive('user.profile.ratingOnJobPosted') }}">@lang('Ratings on Task Created')</a></li>
                    <li><a href="{{ route('profile.ratingOnJobCompleted',[auth()->id(), slug(auth()->user()->fullname)]) }}" class="{{ menuActive(['user.profile.ratingOnJobCompleted']) }}">@lang('Ratings on Task Done')</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)">@lang('Profile')</a>
                <ul class="sidebar__submenu">
                    <li><a href="{{ route('user.profile.setting') }}"class="{{ menuActive('user.profile.setting') }}">@lang('Profile Settings')</a></li>
                    <li><a href="{{ route('profile.details', [auth()->id(), slug(auth()->user()->fullname)]) }}"class="{{ menuActive('profile.details') }}">@lang('My Profile')</a></li>
                </ul>

            </li>

            <li>
                <a href="{{ route('user.change.password') }}" class="{{ menuActive('user.change.password') }}">
                    @lang('Change Password')
                </a>
            </li>

            <li>
                <a href="{{ route('user.twofactor') }}" class="{{ menuActive('user.twofactor') }}">
                    @lang('2FA Security')
                </a>
            </li>
            <li>
                <a href="{{ route('user.logout') }}">
                    @lang('Sign Out')
                </a>
            </li>
        </ul>
        <span class="btn btn-close dashboard__sidebar__close d-lg-none"></span>
    </div>
</div>

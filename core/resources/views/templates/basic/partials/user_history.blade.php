<div class="row g-3 justify-content-center">
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-wallet"></i>
            </div>
            <p class="info">@lang('Balance')</p>
            <h2 class="title">{{ $general->cur_sym }}<span class="odometer" data-odometer-final="{{ showAmount($data['balance']) }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.transactions') }}">@lang('View Details')</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-dollar-sign"></i>
            </div>
            <p class="info">@lang('Deposit')</p>
            <h2 class="title">{{ $general->cur_sym }}<span class="odometer" data-odometer-final="{{ showAmount($data['deposit_balance']) }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.deposit.history') }}">@lang('View Details')</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-hand-holding-usd"></i>
            </div>
            <p class="info">@lang('Withdraw')</p>
            <h2 class="title">{{ $general->cur_sym }}<span class="odometer" data-odometer-final="{{ showAmount($data['withdraw_balance']) }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.withdraw.history') }}">@lang('View Details')</a>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-check"></i>
            </div>
            <p class="info">@lang('Completed Job')</p>
            <h2 class="title"><span class="odometer" data-odometer-final="{{ $data['complete_job'] }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.transactions') }}?remark=payment_receive">@lang('View Details')</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-list-ul"></i>
            </div>
            <p class="info">@lang('Jobs Created')</p>
            <h2 class="title"><span class="odometer" data-odometer-final="{{ $data['created_job'] }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.job.history') }}">@lang('View Details')</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-tasks"></i>
            </div>
            <p class="info">@lang('Transactions')</p>
            <h2 class="title"><span class="odometer" data-odometer-final="{{ $data['transaction'] }}">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="{{ route('user.transactions') }}">@lang('View Details')</a>
            </div>
        </div>
    </div>
</div>

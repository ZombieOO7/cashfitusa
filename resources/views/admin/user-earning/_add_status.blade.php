@if(@$earning->status == 0)
    <span class="m-badge  m-badge--success m-badge--wide">{{__('Credit')}}</span>
@else
    <span class="m-badge  m-badge--danger m-badge--wide">{{__('Withdraw')}}</span>
@endif
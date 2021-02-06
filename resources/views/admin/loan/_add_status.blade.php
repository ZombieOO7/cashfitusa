@if(@$user->status == 0)
    <span class="m-badge  m-badge--warning m-badge--wide">{{__('Pending')}}</span>
@elseif(@$user->status == 1)
    <span class="m-badge  m-badge--success m-badge--wide">{{__('Approve')}}</span>
@else
    <span class="m-badge  m-badge--danger m-badge--wide">{{__('Reject')}}</span>
@endif
<a class=" view" href="{{ URL::signedRoute('loan.edit',['uuid'=>@$user->uuid]) }}" title="Edit">
    <i class="fas fa-pencil-alt"></i>
</a>
<a class="delete" href="javascript:;" id="{{@$user->uuid}}" data-table_name="loan_table" data-url="{{route('loan.delete')}}" title="Delete">
    <i class="fas fa-trash-alt"></i>
</a>
<a class="" href="{{route('loan.transaction',['uuid'=>@$user->uuid])}}" id="{{@$user->uuid}}" data-table_name="loan_table" title="Transactions">
    <i class="flaticon-list-3"></i>
</a>
@if(@$user->status=='1')
    <a class=" active_inactive" href="javascript:;" id="{{@$user->uuid}}" data-url="{{ route('loan.active_inactive', [@$user->uuid]) }}" data-table_name="loan_table" title="Approve">
        <i class="fas fa-toggle-on"></i>
    </a>
@else
    <a class=" active_inactive" href="javascript:;" id="{{@$user->uuid}}" data-url="{{ route('loan.active_inactive', [@$user->uuid]) }}" data-table_name="loan_table" title="Reject">
        <i class="fas fa-toggle-off"></i>
    </a>
@endif
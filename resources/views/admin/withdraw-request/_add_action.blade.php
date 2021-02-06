    <a class="delete" href="javascript:;" id="{{@$withdraw->uuid}}" data-table_name="withdraw_table" data-url="{{route('withdraw.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$withdraw->status=='1')
        <a class=" active_inactive" href="javascript:;" id="{{@$withdraw->uuid}}" data-url="{{ route('withdraw.active_inactive', [@$withdraw->id]) }}" data-table_name="withdraw_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$withdraw->uuid}}" data-url="{{ route('withdraw.active_inactive', [@$withdraw->id]) }}" data-table_name="withdraw_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
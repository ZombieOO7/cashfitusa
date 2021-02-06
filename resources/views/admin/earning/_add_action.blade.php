    <a class=" view" href="{{ URL::signedRoute('earning.edit',['uuid'=>@$earning->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" href="javascript:;" id="{{@$earning->uuid}}" data-table_name="earning_table" data-url="{{route('earning.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$earning->status==1)
        <a class="active_inactive" href="javascript:;" id="{{@$earning->uuid}}" data-url="{{ route('earning.active_inactive', [@$earning->id]) }}" data-table_name="earning_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$earning->uuid}}" data-url="{{ route('earning.active_inactive', [@$earning->id]) }}" data-table_name="earning_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
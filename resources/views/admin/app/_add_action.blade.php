    <a class=" view" href="{{ URL::signedRoute('app.edit',['uuid'=>@$app->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" href="javascript:;" id="{{@$app->uuid}}" data-table_name="app_table" data-url="{{route('app.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$app->status==1)
        <a class="active_inactive" href="javascript:;" id="{{@$app->uuid}}" data-url="{{ route('app.active_inactive', [@$app->id]) }}" data-table_name="app_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$app->uuid}}" data-url="{{ route('app.active_inactive', [@$app->id]) }}" data-table_name="app_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
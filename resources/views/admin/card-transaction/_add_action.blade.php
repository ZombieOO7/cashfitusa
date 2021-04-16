    <a class=" view" href="{{ URL::signedRoute('card-transaction.edit',['uuid'=>@$app->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" href="javascript:;" id="{{@$app->uuid}}" data-table_name="card_transaction_table" data-url="{{route('card-transaction.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    {{-- @if(@$app->status==1)
        <a class="active_inactive" href="javascript:;" id="{{@$app->uuid}}" data-url="{{ route('card-transaction.active_inactive', [@$app->id]) }}" data-table_name="wallet_transaction_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$app->uuid}}" data-url="{{ route('card-transaction.active_inactive', [@$app->id]) }}" data-table_name="wallet_transaction_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif --}}
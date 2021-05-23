{{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category edit'))) --}}
    <a class=" view" href="{{ URL::signedRoute('user.edit',['uuid'=>@$user->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
{{-- @endif --}}
{{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category delete'))) --}}
    <a class="delete" href="javascript:;" id="{{@$user->uuid}}" data-table_name="user_table" data-url="{{route('user.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    <a class="edit" href="{{route('wallet.index',['uuid'=>@$user->uuid])}}" id="{{@$user->uuid}}" data-table_name="user_table" title="Wallet">
        <i class="fas fa-wallet"></i>
    </a>
{{-- @endif --}}
{{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category active inactive'))) --}}
    @if(@$user->status=='1')
        <a class=" active_inactive" href="javascript:;" id="{{@$user->uuid}}" data-url="{{ route('user.active_inactive', [@$user->id]) }}" data-table_name="user_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$user->uuid}}" data-url="{{ route('user.active_inactive', [@$user->id]) }}" data-table_name="user_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
{{-- @endif --}}
@php
use Illuminate\Support\Arr;
$permissionList = Config::get('rolePermission');
[$permissionkeys, $values] = Arr::divide($permissionList);
@endphp
@if(!in_array($permission->id,$permissionkeys))
@if((\Auth::guard('admin')->user()->can('permission edit')))
<a class=" view" href="{{ URL::signedRoute('permission_edit',['id'=>$permission->id]) }}" title="Edit Permission"><i
        class="fas fa-pencil-alt"></i></a>
@endif
@if((\Auth::guard('admin')->user()->can('permission delete')))
<a class=" delete" href="javascript:;" id="{{$permission->id}}" data-table_name="permission_table"
    data-url="{{route('permission_delete')}}" title="Delete Permission"><i
        class="fas fa-trash-alt"></i>
</a>
@endif
@endif
    <a class=" view" data-job_url="{{ route('loan-category.jobstatus') }}" href="{{ URL::signedRoute('loan-category.edit',['uuid'=>@$category->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" data-job_url="{{ route('loan-category.jobstatus') }}" href="javascript:;" id="{{@$category->uuid}}" data-table_name="loan_category_table" data-url="{{route('loan-category.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$category->status=='1')
        <a class=" active_inactive" data-job_url="{{ route('loan-category.jobstatus') }}" href="javascript:;" id="{{@$category->uuid}}" data-url="{{ route('loan-category.active_inactive', [@$category->id]) }}" data-table_name="loan_category_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" data-job_url="{{ route('loan-category.jobstatus') }}" href="javascript:;" id="{{@$category->uuid}}" data-url="{{ route('loan-category.active_inactive', [@$category->id]) }}" data-table_name="loan_category_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
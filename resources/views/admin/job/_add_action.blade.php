    <a class=" view" href="{{ URL::signedRoute('job.edit',['uuid'=>@$job->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" href="javascript:;" id="{{@$job->uuid}}" data-table_name="job_table" data-url="{{route('job.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$job->status=='1')
        <a class=" active_inactive" href="javascript:;" id="{{@$job->uuid}}" data-url="{{ route('job.active_inactive', [@$job->id]) }}" data-table_name="job_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$job->uuid}}" data-url="{{ route('job.active_inactive', [@$job->id]) }}" data-table_name="job_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
    <a class="detail" href="{{URL::signedRoute('job.detail',['uuid'=>@$job->uuid])}}" id="{{@$job->id}}" data-table_name="job_table" title="Detail"><i class="fas fa-eye"></i>
    </a>
    <a class=" view" href="{{ URL::signedRoute('review.edit',['uuid'=>@$review->uuid]) }}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="delete" href="javascript:;" id="{{@$review->uuid}}" data-table_name="review_table" data-url="{{route('review.delete')}}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </a>
    @if(@$review->status=='1')
        <a class=" active_inactive" href="javascript:;" id="{{@$review->uuid}}" data-url="{{ route('review.active_inactive', [@$review->id]) }}" data-table_name="review_table" title="Active">
            <i class="fas fa-toggle-on"></i>
        </a>
    @else
        <a class=" active_inactive" href="javascript:;" id="{{@$review->uuid}}" data-url="{{ route('review.active_inactive', [@$review->id]) }}" data-table_name="review_table" title="Inactive">
            <i class="fas fa-toggle-off"></i>
        </a>
    @endif
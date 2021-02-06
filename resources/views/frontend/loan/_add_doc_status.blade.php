@if(count($loan->loanDocuments)>0)
    @php
        $tooltip = '';
        $flag = false;
        $message = [];
    @endphp
    @if(count($loan->loanDocuments) == 4 && count($loan->pendingDocuments) == 0 && count($loan->rejectedDocuments) == 0)
        @php
            $tooltip = 'Approved';
        @endphp
        <span class="m-badge m-badge--success bg-green m-badge--wide" data-toggle="tooltip" data-placement="bottom" title="{{@$tooltip}}">
            Approved
        </span>
        <a class="downloadPdf text-primary d-inline ml-3" href="{{ URL::signedRoute('application.download',['uuid'=>@$loan->uuid]) }}" title="View & Download receipt">
            <i class="fas fa-file"></i>
        </a>
    @elseif(count($loan->loanDocuments) == 4 && count($loan->rejectedDocuments) == 0)
        @php $tooltip = 'Submitted'; @endphp
        <span class="m-badge m-badge--accent m-badge--wide " data-toggle="tooltip" data-placement="bottom" title="{{@$tooltip}}">Submitted</span>
    @elseif(count($loan->rejectedDocuments) > 0)
        @forelse($loan->rejectedDocuments as $doc)
            @php  $message[] = config('constant.docType')[$doc->type].' rejected'; @endphp
        @empty
        @endforelse
        @php $tooltip = implode(',',$message); @endphp
        <a href="JavaScript:;">
            <span class="m-badge m-badge--danger m-badge--wide" data-toggle="tooltip" data-placement="bottom" title="{{@$tooltip}}">
                {{__('Reject')}}
            </span>
        </a>
    @else
        <a href="{{ URL::signedRoute('upload.document',['uuid'=>@$loan->uuid]) }}">
            <span class="m-badge  m-badge--danger m-badge--wide" data-toggle="tooltip" data-placement="bottom" title="Document upload pending">{{__('Pending')}}</span>
        </a>
    @endif
@else
        <a href="{{ URL::signedRoute('upload.document',['uuid'=>@$loan->uuid]) }}">
            <span class="m-badge  m-badge--danger m-badge--wide" data-toggle="tooltip" data-placement="bottom" title="Document upload pending">{{__('Pending')}}</span>
        </a>
@endif
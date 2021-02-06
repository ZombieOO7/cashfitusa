{{-- <a class=" view" href="{{ URL::signedRoute('application.edit',['uuid'=>@$loan->uuid]) }}" title="Edit">
    <i class="fas fa-pencil-alt"></i>
</a> --}}
<a class="edit text-primary d-inline" href="{{ URL::signedRoute('application.view',['uuid'=>@$loan->uuid]) }}" title="View">
    <i class="fas fa-eye"></i>
</a>
{{-- <a class="text-primary d-inline ml-3" href="{{ URL::signedRoute('upload.document',['uuid'=>@$loan->uuid]) }}" title="View & upload Documets">
    <i class="fas fa-file-image"></i>
</a> --}}

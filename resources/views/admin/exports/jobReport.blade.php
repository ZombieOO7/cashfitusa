<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{@$title}}</title>
</head>

<body>
    <table class="table table-striped- table-bordered table-hover table-checkable for_wdth">
        <thead>
            <tr>
                <th><b>{{__('formname.job.title')}}</b></th>
                <th><b>{{__('formname.job.machine')}}</b></th>
                <th><b>{{__('formname.job.problem')}}</b></th>
                <th><b>{{__('formname.job.location')}}</b></th>
                <th><b>{{__('formname.job.assigned_to')}}</b></th>
                <th><b>{{__('formname.job.priority')}}</b></th>
                <th><b>{{__('formname.job.job_status')}}</b></th>
                <th><b>{{__('formname.created_at')}}</b></th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $job)
            <tr>
                <td>{{@$job->title}}</td>
                <td>{{@$job->machine->title}}</td>
                <td>{{@$job->problem->title}}</td>
                <td>{{@$job->location->title}}</td>
                <td>{{@$job->created_by_text}}</td>
                <td>
                    {{@config('constant.priorites')[$job->priority]}}
                </td>
                <td>
                    {{ @config('constant.job_status_text')[$job->job_status_id]}}
                </td>
                <td>{{ date("d-m-Y", strtotime(@$job->created_at)) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" align="center">No records founds</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
<div class="panel panel-default panel-flush">
    <div class="panel-heading">
        Actions  <i class="fa fa-bolt" aria-hidden="true"></i>
    </div>

    <div class="panel-body">
        <div class="spark-settings-tabs">
            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ route('projects.index') }}">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        My Projects
                    </a>
                </li>

                <li role="presentation">
                    <a href="">
                        <i class="fa fa-link" aria-hidden="true"></i>
                        Link items
                    </a>
                </li>

                <li role="presentation">
                    <a href="">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        Assign work item to member
                    </a>
                </li>

                <li role="presentation">
                    <a href="">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        Work item owner: {{ Auth::user()->first_name }}
                    </a>
                </li>

                <li  role="presentation">
                    <a href="">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Project created:
                        <abbr title="{{ $workitem->created_at->toDayDateTimeString() }}">
                            {{ $workitem->created_at->diffForHumans()}}
                        </abbr>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
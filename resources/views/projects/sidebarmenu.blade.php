<div class="panel panel-default panel-flush">
    <div class="panel-heading">
        Actions <i class="fa fa-bolt" aria-hidden="true"></i>
    </div>

    <div class="panel-body">
        <div class="spark-settings-tabs">
            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-dashboard" aria-hidden="true"></i>
                        Back to Dashboard
                    </a>
                </li>

                <li role="presentation">
                    <a href="{{ route('projects.index') }}">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        My Projects
                    </a>
                </li>

                <li role="presentation">
                    <a href="{{ route('assignedProject') }}">
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                        Assigned Projects
                    </a>
                </li
            </ul>
        </div>
    </div>
</div>
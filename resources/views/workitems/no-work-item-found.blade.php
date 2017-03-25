<div class="col-md-12">
    <div class="alert alert-info">
        @if(Request::has('status') || Request::has('search_work_item_title'))
            No work item found for your search query click <a
                    href="{{ route('work-items.index', ['project_id'=>$project->id ]) }}">here</a> to go back to the
            list.
        @else
            This project does not have any work items associated with it yet!. Click <a
                    href="{{ route('work-items.create', ['project_id'=>$project->id ]) }}">here</a> to create your first
            work item.
        @endif
    </div>
    <!--/.alert-->
</div>
<!--/.col-md-12-->
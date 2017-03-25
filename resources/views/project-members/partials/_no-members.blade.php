<div class="col-md-12">
    <div class="alert alert-info">
        @can('modify', $project)
            There are no collaborators on this project yet! Use the search above to add members to your project.
        @else
           There are no collaborators on this project yet!
        @endcan
    </div>
    <!--/.alert-->
</div>
<!--/.col-md-12-->
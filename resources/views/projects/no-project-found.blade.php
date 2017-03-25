<div class="col-md-12">
    <div class="alert alert-info">
        @if(Route::currentRouteName() == 'projects.index')
            You do not have any projects yet!. Click <a href="{{ route('projects.create') }}">here</a> to create your
            first project.
        @elseif (Route::currentRouteName() == 'assignedProject')
            You do not have any assigned projects yet!.
        @endif
    </div>
    <!--/.alert-->
</div>
<!--/.col-md-12-->
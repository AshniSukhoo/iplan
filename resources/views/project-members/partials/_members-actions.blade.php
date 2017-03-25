@can('modify', $project)
<div class="row form-group">
    <form onsubmit="return confirm('Are you sure you want to remove {{ $user->full_name }} from project ?')"
          action="{{ route('members.destroy', ['project' => $project->id, 'member' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" class="btn btn-warning">
            <i class="fa fa-ban" aria-hidden="true"></i>
            Remove from project
        </button>
    </form>
</div>
@endcan
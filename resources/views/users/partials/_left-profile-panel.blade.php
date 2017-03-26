<div class="col-md-4 well" id="leftPanel">
    <div class="row">
        <div class="col-md-12">
            <div>
                <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}"
                     class="img-circle img-thumbnail">

                <h2>{{ $user->full_name }}</h2>

                <div>
                    @if(!is_null($user->bio) && !empty($user->bio))
                        {!! $user->bio !!}
                    @else
                        @can('edit', $user)
                        Write Something about yourself.
                        @else
                            {{ $user->first_name }} has not written anything about themselves.
                        @endcan
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
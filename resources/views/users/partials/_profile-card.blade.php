<div class="profile-card">
    <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
    <div class="avatar">
        <img src="{{ $user->avatar }}"/>
    </div>
    <div class="content">
        <p>
            <br>
            {{ $user->full_name }}
        </p>
        <p>
            <i class="fa fa-suitcase" aria-hidden="true"></i> Web Developer
        </p>

        @if(isset($actionTemplate))
            @include($actionTemplate, $actionData)
        @endif
    </div>
</div>
<!--/.card-->
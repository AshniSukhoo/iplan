<div class="hero-widget well well-sm">
    <div class="icon">
        <i class="{{ $widgetIcon }}" aria-hidden="true"></i>
    </div>
    <div class="text">
        <var>{{ $widgetNumber }}</var>
        <label class="text-muted">
            {{ $widgetText }}
        </label>
    </div>
    <div class="options">
        <a href="{{ $widgetLink  }}"
           class="{{ $widgetButtonClass }}">
            <i class="{{ $widgetButtonIcon }}" aria-hidden="true"></i> {{ $widgetButtonText }}
        </a>
    </div>
</div>
<!--/.hero-widget-->

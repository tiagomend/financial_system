<x-card>
    <form id="main-form" action="{{ $action }}" method="{{ $method }}" class="form-control" autocomplete="false"
        @if(isset($enctype)) enctype="multipart/form-data" @endif>
        <x-card-header>
            <div class="flex space-between">
                <div class="page-header">
                    <i class="{{ $icon }}"></i>
                    <h3>{{ $title }}</h3>
                </div>
                <div class="section-action">
                    <button id="btn-submit" class="btn btn-primary">
                        <i class="icon_save" style="color: white"></i>
                    </button>
                </div>
            </div>
        </x-card-header>
        {{ $slot }}
    </form>
</x-card>
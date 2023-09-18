
<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header @if (isset($class))
        {{ $class }}
        @else
            alert-primary
        @endif">
            <h5 class="modal-title" id="exampleModalLabel">@if (isset($title))
            {{ $title }}
            @else
                Thông báo
            @endif</h5>
            
        </div>
        <div class="modal-body">
            @if (isset($body))
                <h6>{{ $body }}</h6>
            @endif
        </div>
        <div class="modal-footer">
            @if (isset($buttonClose))
                {{$buttonClose}}
            @endif
            @if (isset($button))
                {{$button}}
            @else
            <button type="button" class="btn btn-primary">Lưu</button>
            @endif
            
        </div>
        </div>
    </div>
    </div>
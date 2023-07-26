<div class="card {{$extClass}}" style="{{$extStyle}}">
    <div class="card-header pb-0 p-3 {{$headerClass}}">
        <div class="row">
            <div class="col-12 col-md-{{$labelCol}} d-flex align-items-center">
                {{$title}}
            </div>
            <div class="col-12 col-md-{{$buttonCol}} text-end">
                @if(isset($button))
                {{$button}}
                @endif
            </div>
            </div>
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
</div>
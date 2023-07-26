<div class="card">
    <div class="card-header mx-4 p-3 text-center">
        <div class="icon icon-shape icon-lg bg-gradient-{{$colorClass}} shadow text-center border-radius-lg">
            <i class="fas fa-{{$attributes['icon']}} opacity-10" aria-hidden="true"></i>
        </div>
    </div>
    <div class="card-body pt-0 p-3 text-center">
        <h6 class="text-center mb-0">{{$attributes['title']}}</h6>
        <span class="text-xs">{{$desc}}</span>
        <hr class="horizontal dark my-3">
        <h5 class="mb-0">{{$attributes['number']}}</h5>
    </div>
</div>
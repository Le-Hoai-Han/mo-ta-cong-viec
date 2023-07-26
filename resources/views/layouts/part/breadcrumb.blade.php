<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        @foreach($list as $url=>$title)
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-white" href="{{$url}}">{{$title}}</a>
            </li>
        @endforeach
      
      <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{$current}}</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">{{$current}}</h6>
  </nav>


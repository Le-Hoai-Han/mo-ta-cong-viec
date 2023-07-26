<x-slot name="header">
    <h2 class="">
        {{ $title }}
    </h2>
    @include('shared._breadcrumbs', [
        'lists'=>$lists,
        'pageTitle' => $title,
    ])
</x-slot>
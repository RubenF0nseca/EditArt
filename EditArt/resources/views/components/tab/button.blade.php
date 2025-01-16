
<button class="nav-link font-alt {{$class}}" id="nav-{{$id}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$target}}" type="button" role="tab" aria-controls="nav-{{$controls}}" aria-selected="{{$select}}">
    <span class="{{$icon}}"></span>
    {{$slot}}
</button>

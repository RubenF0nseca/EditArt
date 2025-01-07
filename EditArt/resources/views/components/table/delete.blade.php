<form action="{{$link}}" method="POST" style="display: inline" >
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-{{$name}}"><i class="{{$icon}}"></i></button>
</form>

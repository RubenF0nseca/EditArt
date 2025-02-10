<form action="{{$action}}" method="POST" style="display: inline" >
    @method('DELETE')
    @csrf
    <button type="submit" class="btn-delete"><i class="ti ti-trash"></i></button>
</form>

<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="recipient" class="form-label required">Para</label>
        <input type="text" id="recipient" name="recipient" class="form-control @error('recipient') is-invalid @enderror" value="email" >
        @error('recipient')
        <div class="invalid-feedback" >{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label required">Assunto</label>
        <textarea type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror"></textarea>
        @error('content')
        <div class="invalid-feedback" >{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="files" class="form-label required">Anexar Ficheiros</label>
        <input type="file"
               id="files"
               name="files"
               class="form-control @error('files') is-invalid @enderror">
        @error('files')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-solid">Enviar</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-lightnew">Cancelar</a>
    </div>
</form>

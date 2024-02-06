@extends("mainbanner.mainbannerLayout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Mainbanner</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mainbanner.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('mainbanner.update', $mainbanner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mainbanner Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $mainbanner->title }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mainbanner Description:</strong>
                <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $mainbanner->description }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mainbanner Photo:</strong>
                <input type="file" name="photo" class="form-control" id="photo" onchange="photoPreviewFn(this);">
            </div>

            <img id="imagePreview" style="max-width:150px; max-height:150px;" alt="Photo Preview" src="{{ asset('bannerPhotos') }}/{{ $mainbanner->photo }}">

            @if($errors->has('photo'))
                <div class="error">{{ $errors->first('photo') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

<script>
    function photoPreviewFn(inputFile) {
        var file = inputFile.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function () {
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection

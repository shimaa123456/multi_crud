@extends("features.featureLayout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Feature</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('features.index') }}"> Back</a>
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

<form action="{{ route('features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="title" value="{{ $feature->title}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Description:</strong>
                <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{$feature->description}}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature photo:</strong>

                <input type="file" name="photo" class="form-control" id="photo" value="{{old('photo')}}" onchange="photoPreviewFn(this);">
            </div>

            <img id="imagePreview" style="max-width:150px; max-height:150px;" alt="photo preview" src="{{asset('featurePhotos')}}/{{$feature->photo}}">

            @if($errors->has('photo'))
                <div class="error">{{ $errors->first('photo') }}</div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Icon:</strong>

                <input type="file" name="icon" class="form-control" id="icon" value="{{old('icon')}}" onchange="iconPreviewFn(this);">
            </div>

            <img id="imagePreview2" style="max-width:150px; max-height:150px;" alt="icon preview" src="{{asset('featureIcons')}}/{{$feature->icon}}">

            @if($errors->has('icon'))
                <div class="error">{{ $errors->first('icon') }}</div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

<script>
    function photoPreviewFn(inputFile){
        var file = inputFile.files[0];
        if(file) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    function iconPreviewFn(inputFile2){
        var file2 = inputFile2.files2[0];
        if(file2) {
            var reader2 = new FileReader();
            reader2.onload = function() {
                document.getElementById("imagePreview2").setAttribute("src", reader2.result);
            }
            reader2.readAsDataURL(file2);
        }
    }
</script>

@endsection

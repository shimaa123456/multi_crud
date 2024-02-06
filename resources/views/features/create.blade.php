@extends("features.featureLayout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Feature</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ourservices.index') }}"> Back</a>
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

<form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="title" value="{{old('title')}}">
            </div>
            @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Description:</strong>
                <input type="text" class="form-control" name="description" placeholder="description" value="{{old('description')}}">
            </div>
            @if($errors->has('description'))
                <div class="error">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature photo:</strong>

                <input type="file" name="photo" class="form-control" id="photo" value="{{old('photo')}}" onchange="photoPreviewFn(this);">
            </div>

            <img id="imagePreview" style="max-width:150px; max-height:150px;" src="" alt="photo preview">

            @if($errors->has('photo'))
                <div class="error">{{ $errors->first('photo') }}</div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Feature Icon:</strong>

                <input type="file" name="icon" class="form-control" id="icon" value="{{old('icon')}}" onchange="iconPreviewFn(this);">
            </div>

            <img id="imagePreview2" style="max-width:150px; max-height:150px;" src="" alt="icon preview">

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

@extends("mainbanner.mainbannerLayout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Mainbanner</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mainbanner.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mainbanner Title:</strong>
                {{ $mainbanner->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $mainbanner->description }}
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <img src="{{ asset('bannerPhotos') }}/{{ $mainbanner->photo }}" alt="" style="max-width: 90%;">
    </div>
</div>

@endsection

@extends("ourservices.ourserviceLayout")

@section("content")

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Service</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ourservices.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Service Title:</strong>
                {{ $ourservice->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $ourservice->description }}
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <img src="{{asset('servicePhotos')}}/{{$ourservice->photo}}" alt="" style="max-width: 90%;">
    </div>
</div>


@endsection

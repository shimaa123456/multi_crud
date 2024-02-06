@extends("features.featureLayout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD For Feature Section </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('features.create') }}"> Create New Feature </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($features) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Description</th>
                <th>Icon</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($features as $feature)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $feature->photo }}</td>
                <td>{{ $feature->title }}</td>
                <td>{{ $feature->description }}</td>
                <td>{{ $feature->icon }}</td>

                <td>
                    <form action="{{ route('features.destroy',$feature->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('features.show',$feature->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('features.edit',$feature->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @else
        <div class="pull-left alert alert-success">
            <h3>No Features created yet .</h3>
        </div>
    @endif


    <div id="paginationNumbers">
        {!! $features->links('pagination::bootstrap-5') !!}
    </div>

    <div id="dashBack">
        <a href="{{ route('Dashmin.index') }}">Back</a>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
@endsection


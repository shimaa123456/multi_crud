@extends("ourservices.ourserviceLayout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD For OurServices Section </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ourservices.create') }}"> Create New Service </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($ourservices) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Icon</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($ourservices as $ourservice)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $ourservice->title }}</td>
                <td>{{ $ourservice->description }}</td>
                <td>{{ $ourservice->photo }}</td>
                <td>
                    <form action="{{ route('ourservices.destroy',$ourservice->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('ourservices.show',$ourservice->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('ourservices.edit',$ourservice->id) }}">Edit</a>

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
            <h3>No ourservices created yet .</h3>
        </div>
    @endif


    <div id="paginationNumbers">
        {!! $ourservices->links('pagination::bootstrap-5') !!}
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


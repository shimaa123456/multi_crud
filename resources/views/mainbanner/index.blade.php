@extends("mainbanner.mainbannerLayout")

@section("content")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD For Mainbanner Section</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mainbanner.create') }}">Create New Banner</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($mainbanners->count() > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Banner Photo</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($mainbanners as $mainbanner)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $mainbanner->title }}</td>
                    <td>{{ $mainbanner->description }}</td>
                    <td>{{ $mainbanner->photo }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('mainbanner.show', $mainbanner->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mainbanner.edit', $mainbanner->id) }}">Edit</a>
                        <form action="{{ route('mainbanner.destroy', $mainbanner->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-success">
            <h3>No banners created yet.</h3>
        </div>
    @endif

    <div id="paginationNumbers">
        {!! $mainbanners->links('pagination::bootstrap-5') !!}
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

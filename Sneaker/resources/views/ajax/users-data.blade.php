<table id="zero_config" class="table table-striped table-bordered no-wrap">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id}}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            @if ($user->status !== 0)
            <td>ADMIN</td>
            @else
            <td>USER</td>
            @endif
            <td class="d-flex">
                <a href="/admin/{{$user->id}}" class="btn btn-success">Update</a>
                &nbsp
                <div>
                    <input type="hidden" class="btn btn-danger" id="{{ $user->id }}" value="{{$user->id}}">
                    <input type="submit" class="btn btn-danger" id="submit{{$user->id}}" value="Delete">
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

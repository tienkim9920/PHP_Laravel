<table id="zero_config" class="table table-striped table-bordered no-wrap">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá Sản Phâm</th>
            <th>Hình Ảnh</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->tenSP }}</td>
            <td>{{ $product->giaSP }}$</td>
            <td><img src="{{ $product->imgSP1 }}" width="100px"></td>
            <td class="d-flex">
                <a href="/admin/sanpham/{{$product->id}}" class="btn btn-success">Update</a>
                &nbsp
                <div>
                    <input type="hidden" class="btn btn-danger" id="{{ $product->id }}" value="{{$product->id}}">
                    <input type="submit" class="btn btn-danger" id="submit{{$product->id}}" value="Delete">
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
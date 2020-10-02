<body style="display: flex; justify-content: center; width: 100%;">
    <div class="container" style="font-family: Arial, Helvetica, sans-serif; text-align: center; width: 30%;">'
        <h1>Xác Nhận Đơn Hàng</h1>
        <hr>
        <h3>Thông Tin Khách Hàng</h3>
        <p>Họ và Tên: {{ $userName }} </p>
        <p>Email: {{ $email }}</p>
        <p>Phone: 0763557366</p>
        <p>Address: {{ $address }}</p>
        <hr>
        <h3>Thông Tin Đơn Hàng</h3>
        <table style="border: 1px solid black; padding-bottom: 1rem; text-align: center; width: 100%;">
            <tr>
                <th style="border: 1px solid black;">Tên Sản Phẩm</th>
                <th style="border: 1px solid black;">Giá</th>
                <th style="border: 1px solid black;">Số Lượng</th>
            </tr>
            @foreach ($carts as $cart)
            <tr>
                <td style="border: 1px solid black;">{{ $cart->nameProduct }}</td>
                <td style="border: 1px solid black;">${{ $cart->priceProduct }}</td>
                <td style="border: 1px solid black;">{{ $cart->count }}</td>
            </tr>
            @endforeach
        </table>
        <hr style="margin-top: 2rem;">
        <p style="font-size: 1.6rem;">Tổng Tiền: ${{ $total }}</p>
    </div>
</body>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
    </head>
    <body>

        <table border="1" cellpadding="1" cellspacing="1" style="text-align: center;">
            <tbody>
                <tr>
                    <td colspan="14"><p style="text-align: center;font-size: 16px;">DANH SÁCH MT</p></td>
                </tr>
                <tr style="text-align: center;font-weight: bold">
                    <td>Gửi tới</td>
                    <td>Nội dung</td>
                    <td>Ngày tạo</td>
                </tr>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{!! isset($transaction->mobile)? $transaction->mobile :'' !!}</td>
                    <td>{!! isset($transaction->content)? $transaction->content :'' !!}</td>
                    <td>{!! isset($transaction->create_date)? date('d/m/Y', strtotime($transaction->create_date)) :'' !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

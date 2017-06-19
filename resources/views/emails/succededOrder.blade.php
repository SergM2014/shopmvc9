<!DOCTYPE html>

<html>
<head>
    <title></title>
</head>

<body>
    <h1>Order succeded! Greetings!!!</h1>



    <h2>You have shoosen next Wares</h2>
    @foreach($order->busketContent as $title=>$amount)

        <h3>Title:{{ $title }} Amount: {{ $amount }}</h3>
        <br>
    @endforeach

    <h4>Total Amount: {{ $order->totalAmount }}</h4>
    <h4>TotalSumma: {{ $order->totalSumma }} hrn</h4>

</body>
</html>
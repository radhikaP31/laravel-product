<html>

<body>
    <header>
        <h1 style="background:#035891">Invoice</h1>
        <address>
            <p style="color:#035891;font-size:20px;font-weight:600">E-Cart Online</p>
            <p>Buy Once! Remember Always!</p>
            <p>PH: (100) 123-1122</p>
        </address>
    </header>
    <article>
        <p style="color:#035891;font-size:15px;font-weight:600">Details:</p>
        <address>
            <p>{{$user->name}}</p>
            <p>{{$user->email}}</p>
        </address>
        <table class="meta">
            <tr>
                <th><span>Order #</span></th>
                <td><span>{{ $order_data->orders['order_no'] }}</span></td>
            </tr>
            <tr>
                <th><span>Invoice #</span></th>
                <td><span>{{ $order_data->invoice_no }}</span></td>
            </tr>
            <tr>
                <th><span>Date</span></th>
                <td><span>{{ date('Y-m-d') }}</span></td>
            </tr>
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span>Item</span></th>
                    <th><span>Description</span></th>
                    <th><span>Rate</span></th>
                    <th><span>Quantity</span></th>
                    <th><span>Price</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart_item as $key => $item)
                <tr>
                    <td><a class="cut">-</a><span>{{ $item->product['p_name'] }}</span></td>
                    <td><span>{{ Str::limit($item->product['p_description'], 30) }}</span></td>
                    <td><span>{{ number_format($item->inventory['price'], 2, '.', ','); }}</span></td>
                    <td><span>{{$item->quantity}}</span></td>
                    <td><span>{{$item->total_price}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span>Sub Total</span></th>
                <td><span>{{ number_format($order_data->price, 2, '.', ','); }}</span></td>
            </tr>
            <tr>
                <th><span>Tax</span></th>
                <td><span>{{ number_format($order_data->tax, 2, '.', ','); }}</span></td>
            </tr>
            <tr>
                <th><span>Total</span></th>
                <td><span>{{ number_format($order_data->total_amount, 2, '.', ','); }}</span></td>
            </tr>
        </table>
    </article>
    <aside>
        <h1><span>Additional Notes</span></h1>
        <div>
            <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
        </div>
    </aside>
</body>

</html>
<style>
    /* reset */

    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    /* heading */

    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    /* table */

    table {
        font-size: 75%;
        table-layout: fixed;
        width: 100%;
    }

    table {
        border-collapse: separate;
        border-spacing: 2px;
    }

    th,
    td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
    }

    th,
    td {
        border-radius: 0.25em;
        border-style: solid;
    }

    th {
        background: #EEE;
        border-color: #BBB;
        font-size: 15px;
        color: #035891;
    }

    td {
        border-color: #DDD;
    }

    /* page */

    html {
        font: 16px/1 'Open Sans', sans-serif;
        overflow: auto;
        padding: 0.5in;
    }

    html {
        background: #999;
        cursor: default;
    }

    body {
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        overflow: hidden;
        padding: 0.5in;
    }

    body {
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    p {
        font-size: 14px;
    }

    /* header */

    header {
        margin: 0 0 3em;
    }

    header:after {
        clear: both;
        content: "";
        display: table;
    }

    header h1 {
        background: #000;
        border-radius: 0.25em;
        color: #FFF;
        margin: 0 0 1em;
        padding: 0.5em 0;
    }

    header address {
        float: left;
        font-size: 75%;
        font-style: normal;
        line-height: 1.25;
        margin: 0 1em 1em 0;
    }

    header address p {
        margin: 0 0 0.25em;
    }

    header span,
    header img {
        display: block;
        float: right;
    }

    header span {
        margin: 0 0 1em 1em;
        max-height: 25%;
        max-width: 60%;
        position: relative;
    }

    header img {
        max-height: 100%;
        max-width: 100%;
    }

    /* article */

    article,
    article address,
    table.meta,
    table.inventory {
        margin: 0 0 3em;
    }

    article:after {
        clear: both;
        content: "";
        display: table;
    }

    article h1 {
        clip: rect(0 0 0 0);
        position: absolute;
    }

    article address {
        float: left;
        font-size: 125%;
        font-weight: bold;
    }

    /* table meta & balance */

    table.meta,
    table.balance {
        float: right;
        width: 36%;
    }

    table.meta:after,
    table.balance:after {
        clear: both;
        content: "";
        display: table;
    }

    /* table meta */

    table.meta th {
        width: 40%;
    }

    table.meta td {
        width: 60%;
    }

    /* table items */

    table.inventory {
        clear: both;
        width: 100%;
    }

    table.inventory th {
        font-weight: bold;
        text-align: center;
    }

    table.inventory td:nth-child(1) {
        width: 26%;
    }

    table.inventory td:nth-child(2) {
        width: 38%;
    }

    table.inventory td:nth-child(3) {
        text-align: right;
        width: 12%;
    }

    table.inventory td:nth-child(4) {
        text-align: right;
        width: 12%;
    }

    table.inventory td:nth-child(5) {
        text-align: right;
        width: 12%;
    }

    /* table balance */

    table.balance th,
    table.balance td {
        width: 50%;
    }

    table.balance td {
        text-align: right;
    }

    /* aside */

    aside h1 {
        border: none;
        border-width: 0 0 1px;
        margin: 0 0 1em;
    }

    aside h1 {
        border-color: #999;
        border-bottom-style: solid;
    }
</style>
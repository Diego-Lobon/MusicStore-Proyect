<?php
    require  './vendor/autoload.php';

    

    MercadoPago\SDK::setAccessToken('TEST-2540885682950246-110922-bb5401fcf1354474376dfc9d13f06153-391253763');

    $preference = new MercadoPago\Preference();

    $item = new MercadoPago\Item();
    
    $item->title = 'Music Store';
    $item->quantity = 1;
    $item->unit_price = 150.00;
    

    $preference->items = array($item);
    $preference->save();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    
</head>
<body>
    
    <!-- BOTON MERCADO PAGO -->
    <div class="checkout-btn"></div>
                
                <script>

                    const mp = new MercadoPago('TEST-e7d444e2-2717-49ae-ac3d-455a5a9c3db8', {
                        locale: 'es-PE'
                    });

                    mp.checkout({
                        preference: {
                            id: '<?php echo $preference->id; ?>'
                        },
                        render: {
                            container: '.checkout-btn',
                            label: 'Pagar con Mercado Pago',
                        }
                    });

                    
                </script>

</body>
</html>
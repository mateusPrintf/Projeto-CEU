<?include('pagseguro.php')?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CEU - Pagamento</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript"
        src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
    </script>

    <script>
    function enviaPagseguro() {
        $.post('pagseguro.php', '', function(data) {
            $('#code').val(data);
            $('#comprar').submit();
        })
    }
    </script>

</head>
<!--  https://pagseguro.uol.com.br/checkout/v2/payment.html</li> -->

<body>

    <form id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post"
        onsubmit="PagSeguroLightbox(this); return false;">

        <input type="hidden" name="code" id="code" value="<?=$codigo?>" />

        <button onclick="enviaPagseguro()">Comprar</button>

    </form>

</body>
 
</html>
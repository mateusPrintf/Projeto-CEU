<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
    
    function limpa_formulário_cep() {
        document.getElementById('cep').value = ("");
        document.getElementById('endereco').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('estado').value = ("");

    }

    function preechendo(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('estado').value = (conteudo.uf);
            document.getElementById('endereco').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep != "") {

            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                var script = document.createElement('script');

                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=preechendo';

                document.body.appendChild(script);
            } else {
                alert("Formato de CEP inválido.");
                limpa_formulário_cep();
            }
        } else {
            limpa_formulário_cep();
        }
    };
    </script>
</head>

<body>
</body>

</html>
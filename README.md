# Consumindo API Rest de Nota Fiscal Eletrônica da WebmaniaBR® através de um Back-End PHP (Laravel)

## Utilização
Instale o mecanismo PHP. A versão com suporte é o PHP8. 
Os downloads estão disponíveis aqui: [Instalador](https://www.php.net/downloads.php)

Instale o gerenciador de pacotes para linguagem PHP Composer.
Gerenciador Composer: [Instalador](https://getcomposer.org)

Na pasta raiz do projeto após a instalação do Composer , rode o servidor usando o comando:

```php
php artisan serve
```

Pronto, o back-end está rodando na porta ``` http://localhost:8000 ```  e pronto para consumir a API da WebmaniaBR®.


Para verificar se a SEFAZ está Online ou Offline, envie uma requisição GET para o caminho ``` http://localhost:8000/api/statusSefaz ```.

Para emitir uma NF-e de Saída ou Entrada, envie uma requisição POST para o caminho``` http://localhost:8000/api/emitirnotafiscal ``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
            "ID": 1137,
            "url_notificacao": "http://meudominio.com/retorno.php",
            "operacao": 1,
            "natureza_operacao": "Venda de produção do estabelecimento",
            "modelo": 1,
            "finalidade": 1,
            "ambiente": 1,
            "cliente": {
                "cpf": "000.000.000-00",
                "nome_completo": "Nome do Cliente",
                "endereco": "Av. Brg. Faria Lima",
                "complemento": "Escritório",
                "numero": 1000,
                "bairro": "Itaim Bibi",
                "cidade": "São Paulo",
                "uf": "SP",
                "cep": "00000-000",
                "telefone": "(00) 0000-0000",
                "email": "nome@email.com"
            },
            "produtos": [
            {
                "nome": "Nome do produto",
                "codigo": "nome-do-produto",
                "ncm": "6109.10.00",
                "cest": "28.038.00",
                "quantidade": 3,
                "unidade": "UN",
                "peso": "0.800",
                "origem": 0,
                "subtotal": "44.90",
                "total": "134.70",
                "classe_imposto": "REF1000"
            },
            {
                "nome": "Nome do produto",
                "codigo": "nome-do-produto",
                "ncm": "6109.10.00",
                "cest": "28.038.00",
                "quantidade": "1",
                "unidade": "UN",
                "peso": "0.200",
                "origem": 0,
                "subtotal": "29.90",
                "total": "29.90",
                "classe_imposto": "REF1000"
            }
            ],
            "pedido": {
            "pagamento": 0,
            "presenca": 2,
            "modalidade_frete": 0,
            "frete": "12.56",
            "desconto": "10.00",
            "total": "174.60"
            }
        }
    }
```

Para emitir uma NF-e de Devolução, envie uma requisição POST para o caminho``` http://localhost:8000/api/emitirnotafiscaldevolucao ``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
            "chave":"00000000000000000000000000000000000000000000",
            "natureza_operacao":"Devolução de venda de produção do estabelecimento",
            "codigo_cfop":"1.202", // Código CFOP de devolução
            "produtos": [ 2, 3 ], // Número sequencial dos produtos
            "quantidade": [ 5, 1 ], // Ex.: Produto 2 = 5 unidades / Produto 3 = 1 unidade
            "ambiente":"1", // 1 - Produção ou 2 - Homologação
            "volume":"1" // Quantidade de volumes transportados
        }
}
```

Para emitir uma NF-e de Ajuste, envie uma requisição POST para o caminho``` http://localhost:8000/api/emitirnotafiscalajuste``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
            "operacao": 1,
            "natureza_operacao": "CREDITO ICMS S/ ESTOQUE",
            "codigo_cfop": "2.949",
            "valor_icms": "1000.00", // Valor do ICMS a ser ajustado
            "ambiente": "1",
            "cliente": {
            "cpf": "000.000.000-00",
            "nome_completo": "Nome do Cliente",
            "endereco": "Av. Brg. Faria Lima",
            "complemento": "Escritório",
            "numero": 1000,
            "bairro": "Itaim Bibi",
            "cidade": "São Paulo",
            "uf": "SP",
            "cep": "00000-000",
            "telefone": "(00) 0000-0000",
            "email": "nome@email.com"
        }
    }
}
```

Para emitir uma NF-e de Devolução, envie uma requisição POST para o caminho``` http://localhost:8000/api/emitirnotafiscaldevolucao ``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
            "chave":"00000000000000000000000000000000000000000000",
            "natureza_operacao":"Devolução de venda de produção do estabelecimento",
            "codigo_cfop":"1.202", // Código CFOP de devolução
            "produtos": [ 2, 3 ], // Número sequencial dos produtos
            "quantidade": [ 5, 1 ], // Ex.: Produto 2 = 5 unidades / Produto 3 = 1 unidade
            "ambiente":"1", // 1 - Produção ou 2 - Homologação
            "volume":"1" // Quantidade de volumes transportados
        }
}
```

Para emitir uma NF-e complementar, envie uma requisição POST para o caminho ``` http://localhost:8000/api/emitirnotafiscalcomplementar``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
        "chave": "00000000000000000000000000000000000000000000",
        "operacao": 1,
        "natureza_operacao": "COMPLEMENTAR",
        "ambiente": "1",
        "cliente": {
        "cpf": "000.000.000-00",
        "nome_completo": "Nome do Cliente",
        "endereco": "Av. Brg. Faria Lima",
        "complemento": "Escritório",
        "numero": 1000,
        "bairro": "Itaim Bibi",
        "cidade": "São Paulo",
        "uf": "SP",
        "cep": "00000-000",
        "telefone": "(00) 0000-0000",
        "email": "nome@email.com"
        },
        "produtos": [{ ... }], // Complementar preço e/ou quantidade
        "impostos": [ ... ], // Complementar impostos
        }
    }   
}
```
Para consultar uma NF-e , envie uma requisição GET para o caminho ``` http://localhost:8000/api/consultarnotafiscal?chave=00000000000000000000000000000000000000000000 ``` com a chave como parâmetro.

Para cancelar uma NF-e , envie uma requisição PUT para o caminho ``` http://localhost:8000/api/cancelarnotafiscal ``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
	    "chave":"00000000000000000000000000000000000000000000",
	    "motivo":"Cancelamento por motivos administrativos."
    }
}
```

Para inutilizar uma numerção, envie uma requisição GET para o caminho ``` http://localhost:8000/api/inutilizarnotafiscal ``` contendo no corpo da requisição os seguintes objetos no formato JSON:

```json
{
    "data":{
        "sequencia":"101-109",
        "motivo":"Inutilização por problemas técnicos.",
        "ambiente":"1", // 1 - Produção ou 2 - Homologação
        "serie":"99", // Série da numeração
        "modelo":"1" // 1 - NF-e ou 2 - NFC-e
    }
}
```

Para a validade do certificado , envie uma requisição GET para o caminho ``` http://localhost:8000/api/validadecertificado ```.


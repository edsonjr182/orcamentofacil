<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Orçamento Personalizado</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Gerador de Orçamento Personalizado</h2>

        <!-- Formulário de Cliente -->
        <form id="orcamentoForm">

            <div class="form-group">
                <label for="logo">Carregar Logo:</label>
                <input type="file" class="form-control" id="logo" accept="image/*">
            </div>

            

            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <input type="text" class="form-control" id="cliente" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" required>
            </div>

            <!-- Formulário de Itens -->
            <h4>Adicionar Itens</h4>
            <div class="form-group">
                <label for="descricao">Descrição do Item:</label>
                <input type="text" class="form-control" id="descricao">
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade">
            </div>
            <div class="form-group">
                <label for="valorUnitario">Valor Unitário:</label>
                <input type="number" class="form-control" id="valorUnitario" step="0.01">
            </div>
            <button type="button" class="btn btn-primary" onclick="adicionarItem()">Adicionar Item</button>
        </form>

        <!-- Tabela de Itens -->
        <table class="table table-bordered mt-3" id="tabelaOrcamento">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="tabelaItens">
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;">Total Geral:</th>
                    <th id="totalGeral">R$ 0.00</th>
                </tr>
            </tfoot>
        </table>

        <div class="form-group">
    <label for="desconto">Desconto (%):</label>
    <input type="number" class="form-control" id="desconto" step="0.01" value="0">
</div>

        <button type="button" class="btn btn-success" onclick="gerarPDF()">Imprimir PDF</button>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    var totalGeral = 0;

    function adicionarItem() {
    var descricao = $('#descricao').val();
    var quantidade = $('#quantidade').val();
    var valorUnitario = $('#valorUnitario').val();
    var total = quantidade * valorUnitario;

    if (descricao && quantidade && valorUnitario) {
        var newRow = `<tr><td>${descricao}</td><td>${quantidade}</td><td>R$ ${parseFloat(valorUnitario).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</td><td>${parseFloat(total).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</td></tr>`;
        $('#tabelaItens').append(newRow);
        $('#descricao').val('');
        $('#quantidade').val('');
        $('#valorUnitario').val('');

        // Atualizar o total geral
        totalGeral += parseFloat(total);
        atualizaTotalGeral();
    } else {
        alert("Por favor, preencha todos os campos do item!");
    }
}

function atualizaTotalGeral() {
    var desconto = parseFloat($('#desconto').val());
    var totalComDesconto = totalGeral * (1 - desconto / 100);
    $('#totalGeral').text(totalComDesconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
}

    function gerarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const logoInput = document.getElementById('logo');
    if (logoInput.files.length > 0) {
        const reader = new FileReader();

        // Função que executa após a leitura do arquivo
        reader.onload = function (event) {
            const imgData = event.target.result;

            // Agora que a imagem foi carregada, podemos adicionar ao PDF
            doc.addImage(imgData, 'PNG', 15, 15, 130, 25);
            continuePDFCreation(doc);
        };

        // Ler o arquivo como Data URL
        reader.readAsDataURL(logoInput.files[0]);
    } else {
        // Continuar criação do PDF sem logo
        continuePDFCreation(doc);
    }
}
function continuePDFCreation(doc) {

         // Desenhar uma borda ao redor da página
        doc.setLineWidth(0.5); // Define a largura da linha para 2px
        // O método rect desenha um retângulo. Parâmetros: x, y, largura, altura
        // x e y são as coordenadas do canto superior esquerdo do retângulo
        // Considerando que o tamanho padrão de uma página é 210mm x 297mm (A4)
        doc.rect(10, 10, 190, 277); // Ajuste as margens conforme necessário

       

        

        doc.setLineWidth(0.5); 
        doc.rect(150, 15, 45, 25); 

          // Obter a data atual
        const today = new Date();
        const dateString = today.toLocaleDateString('pt-BR'); // Formata a data para o formato local brasileiro

        const orderNumber = Math.floor(1000 + Math.random() * 9000);

        // Adicionar número do orçamento acima da data
        doc.setFontSize(16); // Define o tamanho da fonte para a data
        const orderText = "Nº " + orderNumber;
        const orderTextWidth = doc.getStringUnitWidth(orderText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const orderTextX = 150 + (45 - orderTextWidth) / 2; // Centraliza o texto horizontalmente
        const orderTextY = 15 + 15; // Posiciona o texto no topo do retângulo
        doc.text(orderText, orderTextX, orderTextY);


        // Adicionar a data ao PDF, centralizando-a no retângulo
        doc.setFontSize(12); // Define o tamanho da fonte para a data
        // Centraliza o texto no retângulo, ajustando x e y
        const textWidth = doc.getStringUnitWidth(dateString) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const textX = 150 + (45 - textWidth) / 2; // Centraliza o texto horizontalmente dentro do retângulo
        const textY = 15 + 5; // Posiciona o texto aproximadamente no meio do retângulo verticalmente
        doc.text(dateString, textX, textY);

         // Desenhar uma borda ao redor da página
        doc.setLineWidth(0.5); // Define a largura da linha para 2px
        // O método rect desenha um retângulo. Parâmetros: x, y, largura, altura
        // x e y são as coordenadas do canto superior esquerdo do retângulo
        // Considerando que o tamanho padrão de uma página é 210mm x 297mm (A4)
        doc.rect(10, 45, 190, 0); // Ajuste as margens conforme necessário

        // Configuração do documento
        doc.setFontSize(16);
        doc.setTextColor(100); // Cinza escuro para o texto
        doc.text('ORÇAMENTO', 105, 55, { align: 'center' }); // Centralizar título

        doc.setFontSize(12);
        doc.setTextColor(0); // Preto para os detalhes
        doc.text(`Cliente: ${$('#cliente').val()}`, 14, 65);
        doc.text(`Endereço: ${$('#endereco').val()}`, 14, 75);
        doc.text(`Telefone: ${$('#telefone').val()}`, 14, 85);
        
        // Início da tabela um pouco abaixo dos detalhes do cliente
        let startY = 90;

        doc.autoTable({
            html: '#tabelaOrcamento',
            startY: startY,
            styles: {
                fillColor: [255, 255, 255], // Branco
                textColor: [0, 0, 0], // Preto
                lineColor: [0, 0, 0], // Preto
                lineWidth: 0.1,
            },
            headStyles: {
                fillColor: [200, 200, 200], // Cinza para cabeçalho
                textColor: [0, 0, 0], // Preto
            },
            didDrawCell: data => {
                if (data.column.index === 3 && data.cell.section === 'body') {
                    doc.setTextColor(255, 0, 0); // Vermelho para o texto na coluna 'Total'
                }
            },
            margin: { top: 10 },
            didDrawPage: function(data) {
                // Rodapé
                doc.setFontSize(16);
                  let totalComDesconto = totalGeral * (1 - parseFloat($('#desconto').val()) / 100);
                doc.text("Total Final: " + totalComDesconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }), 130, doc.internal.pageSize.height - 15);
                doc.text("Desconto de " + parseFloat($('#desconto').val()) + "%", 130, doc.internal.pageSize.height - 25);

                doc.setFontSize(12);
                doc.text("Este orçamento tem validade de 15 dias", 14, doc.internal.pageSize.height - 40);
                
                
                doc.setFontSize(8);
                doc.text("Araucária/PR", 14, doc.internal.pageSize.height - 30);
                doc.text("Rua Seu Endereço aqui, Nº 99", 14, doc.internal.pageSize.height - 25);
                doc.text("Bairro Aqui", 14, doc.internal.pageSize.height - 20);
                doc.text("CEP: 83700-000", 14, doc.internal.pageSize.height - 15);
            }
        });

        doc.save('Orcamento.pdf');
    }
</script>

</body>
</html>

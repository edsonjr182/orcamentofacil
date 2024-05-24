# Gerador de Orçamento Personalizado

O Gerador de Orçamento Personalizado é uma aplicação web construída com HTML, CSS, Bootstrap, JavaScript e jQuery, que permite aos usuários criar orçamentos personalizados para clientes e exportá-los em formato PDF. Esta ferramenta é ideal para freelancers, pequenas empresas e qualquer pessoa que necessite de um método rápido e fácil para gerar orçamentos profissionais.

## Funcionalidades

- **Carregamento de Logo**: Os usuários podem carregar uma logo da empresa que será incluída no PDF.
- **Dados do Cliente**: Inclui campos para inserir informações do cliente como nome, endereço e telefone.
- **Adição de Itens**: Permite adicionar múltiplos itens ao orçamento, especificando descrição, quantidade e valor unitário.
- **Cálculo Automático**: Calcula automaticamente o total de cada item e o total geral do orçamento.
- **Desconto**: Possibilidade de aplicar um desconto percentual ao total geral.
- **Exportação em PDF**: Gera um PDF do orçamento completo com todos os dados, que pode ser impresso ou enviado diretamente ao cliente.

## Tecnologias Utilizadas

- HTML5
- CSS3
- Bootstrap 4.5.2
- JavaScript
- jQuery 3.5.1
- jsPDF 2.3.1
- jsPDF-AutoTable 3.5.23

## Como Usar

### Configuração Inicial

1. Clone o repositório para o seu sistema local usando `git clone`.
2. Abra o arquivo `index.html` em um navegador de sua preferência.

### Criando um Orçamento

1. **Carregar a Logo da Empresa**: Clique no campo "Carregar Logo" e selecione uma imagem do seu dispositivo.
2. **Preencher Informações do Cliente**: Digite o nome, endereço e telefone do cliente nos campos fornecidos.
3. **Adicionar Itens ao Orçamento**:
   - No campo "Descrição do Item", digite o nome ou descrição do item.
   - Insira a quantidade no campo "Quantidade".
   - Adicione o valor unitário no campo "Valor Unitário".
   - Clique em "Adicionar Item" para incluir o item na tabela de orçamento.
4. **Aplicar Desconto (Opcional)**: Se necessário, adicione um percentual de desconto no campo "Desconto (%)".
5. **Gerar PDF**: Clique no botão "Imprimir PDF" para gerar e baixar o PDF do orçamento.

### Visualização e Exportação

- Revise os itens na tabela de orçamento para garantir que todas as informações estão corretas.
- O PDF gerado incluirá todos os dados do cliente, itens adicionados, cálculos de total e o desconto aplicado.
- O PDF pode ser salvo em seu dispositivo ou enviado diretamente ao cliente.

## Contribuições

Contribuições são bem-vindas! Se você tem sugestões para melhorar esta aplicação, sinta-se à vontade para forkar o repositório e enviar um pull request com suas modificações, ou abrir um issue no GitHub.


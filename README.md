# Sobre

Trabalho realizado para a disciplina Banco de Dados 1 , ministrado pela a professora Ana Carolina , instituição Universidade Estadual do Rio de Janeiro - UERJ.
Período Letivo 2016.2

# Hospedagem e Conexão

### Acesso ao Banco de Dados ( PHPMyAdmin )

* URL: https://db74.hostinger.com.br/
* Usuário: u866020361_uerj
* Senha: 2016.2

### Acesso ao FTP

* URL: ftp.rawinput.com.br
* Usuário: u866020361.garagemuerj
* Senha: 2016.2

# Integrantes
 * Igor Lessa
 * Mauricio Vicente
 * Nilton

# Ideia  
Desenvolvimento de aplicação voltada para um estacionamento(Rotativo / Mensal), a aplicação devera  ter os seguintes modos operante:
* Rotativo  
  * Entrada do Veículo
      * Informar sobre Modelo(Modelo - Placa)
  * Saída do Veículo
      * Informar o emplacamento (Placa do Veículo)
          * Retorna o Valor a ser pago
* Mensal
  * Entrada do Veículo  
      * Informar emplacamento
          * Autorização de Entrada
  * Saída do Veículo
      * Informar emplacamento
  * Cadastrar Veículo
      * Informar
          * Modelo
          * Cliente (Endereco , Nome, Telefone Contato)
  * Informar Pagamento
      * Adicionar Pagamento ao veículo
  * Cancelar Cadastro
      * Informar emplacamento



# O trabalho deve conter:
* Minimundo: texto explicativo sobre o domínio, contendo o detalhamento da especificação dos
requisitos e dados;  
* Modelagem conceitual ER com diagrama ER - entidades, relacionamentos e cardinalidades
(min,max). Listar os atributos de entidades e relacionamentos em separado, detalhando cada um com
suas restrições de domínio;  
* Modelagem lógica relacional necessariamente mapeada a partir da modelagem conceitual ER
desenvolvida pelo grupo. Explicitar e justificar formas de mapeamento realizadas;
* Definição das restrições de integridade estruturais: chave, entidade, domínio e referenciais;  
* Listar pelo menos 2 restrições semânticas (apenas textual aqui) impostas pelo negócio;  
* Consultas exemplos em álgebra relacional cobrindo pelo menos 90% das sintaxes vistas em sala de
aula;  
* Consultas exemplos em SQL, cobrindo pelo menos 90% das sintaxes vistas em sala de aula;  
* Script DDL (criação de tabelas) para o esquema relacional consistente com o diagrama ER proposto
e a modelagem lógica;  
* Implementação do esquema lógico relacional completo em SGBD relacional, exceto PostgreSQL;  
* SQL para atualização (inserção, alteração e remoção) de dados para demonstrar os controles de
integridade implementados, tanto estruturais como semânticos, testados por interface de programa
(ex.: PHP);  
*  Avaliação de qualidade de pelo menos 3 tabelas do projeto lógico implementado em função de formas
normais e das dependências funcionais existentes.  
* Implementação com um programa de aplicação desenvolvido em linguagem de programação
selecionada, permitindo interface de acesso amigável para manipulação de dados (inserção, alteração
e remoção) e consultas.

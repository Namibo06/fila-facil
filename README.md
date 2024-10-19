### Sobre o projeto

#### É um projeto que utiliza a arquitetura MVC (Model - View - Controller), muito utilizada em projetos Java por exemplo, a linguagem escolhida para o back-end foi o PHP por conta de ser fácil de usar e a única a ser suportada nas hospedagens da web, o banco de dados também foi o MySQL por ser o único a ser suportado em hospedagens web e por ser mais leve, a tríade HTML,CSS e JavaScript por ser mais adequado a web.

-------------------

### Tecnologias

- #### HTML
- #### CSS
- #### JavaScript
- #### MySQL
- #### PHP

-------------------

### Dependências
- #### composer require firebase/php-jwt
- #### composer require vlucas/phpdotenv

-------------------

### Metodologia Ágil

#### Iremos utilizar a Metodologia Ágil Kanban, que apresenta o fluxo de trabalho da equipe por cards, que será feito no site Trello, isso nos permite ter uma maior flexibilidade tanto a horários quanto para as tarefas e reuniões.

-------------------

### Pré-Requesitos

##### ◾ VsCode
- ##### Veja como instalar o VsCode [aqui](https://www.youtube.com/watch?v=asM3KmBdWTs&t=0s)
- ##### Instale o VsCode [aqui](https://code.visualstudio.com/Download)

##### ◾ Composer
- ##### Veja como instalar o Composer [aqui](https://www.youtube.com/watch?v=Dimtx-pQPuA)
- ##### Instale o Composer [aqui](https://getcomposer.org/download/)

##### ◾ Git
- ##### Veja como instalar o Git [aqui](https://www.youtube.com/watch?v=L3zGGzsx_j8&t=0s)
- ##### Instale o Git [aqui](https://git-scm.com/downloads)

##### ◾ PHP 8.2+
- ##### Veja como instalar o PHP [aqui](https://www.youtube.com/watch?v=gQ-P0yMBE9U&t=0s)
- ##### Instale o PHP [aqui](https://www.php.net/downloads.php#gpg-8.3)

##### ◾ MySQL Community
- ##### Veja como instalar o MySQL [aqui](https://www.youtube.com/watch?v=s0YoPLbox40)
- ##### Instale o MySQL [aqui](https://dev.mysql.com/downloads/installer/)

-------------------

### Estrutura do Projeto

- #### assets: Para fotos, gifs, videos, ...

- #### src: Diretório principal

- #### src/controllers: Controladores servem para conectar as models com as views. Onde ficará as regras de negócio

- #### src/database: Conexão com banco de dados 

- #### src/database/sql/databases: Onde ficará os scripts de criação, e remoção do banco de dados

- #### src/database/sql/stored_procedures: Onde ficará os scripts dos procedimentos armazenados

- #### src/database/sql/tables: Onde ficará os scripts de criação, modificação e remoção de tabelas 

- #### src/database/sql/triggers: Onde ficará os scripts dos gatilhos

- #### src/models: Os modelos receberam as requisições dos controllers e farão consultas diretas ao banco

- #### src/pages: Vai ter tudo relacionado ao que o usuário vê, como estruturas, estilizações e manipulações

- #### src/pages/css: Pasta para arquivos .css

- #### src/pages/js: Pasta para arquivos .js

- #### src/pages/shared: Pasta reservada a partes que se repetem em mais de uma página, como o rodapé ou cabeçalho de uma página web

- #### src/pages/templates: Pasta com estruturas html dentro de arquivos .php

- #### .env: Arquivo para colocar informações sensíveis como chaves de API's, informações de conexão com banco de dados

- #### .gitignore: Arquivo que ao colocar o nome, uma pasta/arquivo não sobe para o GitHub

- #### .htaccess: Arquivo responsável pelo roteamento das páginas .php na web

- #### Application: Este arquivo serve para verificar se o nome do arquivo na url tem algum controlador criado e redireciona a view correta, senão redireciona para uma página de erro

- #### index.php: Arquivo principal do projeto, responsável por startar toda a aplicação

- #### README.md: Arquivo para anotações em geral

-----------------------

### Equipes

#### Front-end: Joca, Gustavo, Carlos, Kaio, Murillo, e João
#### Back-end: Joca, e Jadson
#### DBA: Joca, Gustavo, Davi, Carlos, e Jadson
#### Design: Murillo, Gustavo, Carlos, e Elias

------------------------

### Padrões do Projeto

#### Font family = a decidir
#### Nomeação de arquivo = Deve seguir estilo CamelCase
#### Nomeação de pasta = Deve seguir o estilo de letras snake_case
#### Nomeação de variáveis = Deve seguir estilo CamelCase e ser o mais claro possível, por exemplo se for para calcular a soma de dois números seria "calculateTwoNumbers ou calcularDoisNumeros"
#### Nomeação de funções = Deve seguir estilo CamelCase e ser o mais claro possível, por exemplo se for para fazer um saque seria "withDraw() ou realizarSaque()"

------------------------

### Reuniões
#### Toda sexta após a aula de Estatística

------------------------

### Trello

##### ▪ Link do Trello [aqui](https://trello.com/b/QSVdedfJ/marcacao-com-fichas)

- ##### Backlog: Inicial de tudo que tem de ser feito, se for front-end telas que serão construída se outros, se for back-end colocar autenticação e outros, caso seja DBA colocar que precisa fazer a modelagem do banco e outros, e o design seria criando protótipos.

- ##### To-do: O que tem para fazer por agora, se for front-end pode ser alguma funcionalidade especifica como consumir uma API, se for back-end pode ser fazendo conexão com o banco, caso seja DBA pode ser criando uma tabela, e o design pode ser criar o esboço de uma tela.

- ##### In Progress: É basicamente você dizer que já começou a fazer certa tarefa.

- ##### Code Review: É quando você sobe a PR e espera seu código ser revisado e autorizado para ir a main.

- ##### Done: É quando a tarefa for finalizada.

------------------------

### Commit Semântico
- #### style: Para estilizações
- #### feat: Para novas funcionalidades ou outras novas implantações  
- #### perf: Para códigos que vão melhorar desempenho 
- #### refactor: Para alterações em arquivos de código já existente
- #### chore: Para arquivos que não vão para produção, normalmente arquivos de configuração, .env, ...
- #### build: Para inclusão, alteração ou exclusão de depêndencias
- #### docs: Para inclusão ou modificação em arquivos de documentação
- #### fix: Para corrigir bugs

------------------------

### Branch's padrões
- #### main = branch de produção
- #### release = branch que faz ponte entre develop e main, onde ficará todo código que vai para produção
- #### develop = branch responsável por receber as novas funcionalidades e refatorações
#### Podem criar outras branch's por exemplo vai criar a tela de perfil, cria a branch "feat-page-perfil", ou algo do tipo, poderá apagar a branch depois de fazer o merge na branch develop.

------------------------

### Comandos Git

- ##### git clone nomeDoRepositorio: Clona um repositório do  GitHub para sua máquina

- ##### git init = Inicializa repositório git no diretório atual

- ##### git add . = Adiciona todos os arquivos e pastas para serem commitados

- ##### git add nomeArquivo = Adiciona arquivo para ser commitado

- ##### git commit -m "commit semântico: descrição do commit" = Realiza commit

- ##### git pull nomeDaBranch = Atualiza seu código local conforme está no GitHub

- ##### git push -u origin nomeDaBranch = Sobe alterações para o GitHub

- ##### git checkout -b nomeDaBranch = Cria branch e muda automaticamente para ela

- ##### git checkout nomeDaBranch = Alterna para outra branch

- ##### git branch = Verifica branch atual

- ##### git branch -d nome-do-branch = Deleta a branch

- ##### git branch -D nome-do-branch = Força a remoção da branch

- ##### git remote -v = Verifica o repositório remoto atual

- ##### git remote add origin https://url-do-novo-repo.git = Adiciona um novo repositório remoto

- ##### git remote set-url origin https://url-do-novo-repo.git = Alterna para outro repositório remoto

- ##### git merge nomeBranchOrigem = Faz merge entre duas branch's antes faça um checkout para branch que contém as alterações, para que possa mesclar, lembre-se de manter seu ambiente atualizado com o pull, antes de realizar o merge.

- ##### git revert <commit_hash> = Desfaz commit específico

- ##### git reset --soft HEADE^ = Desfaz último commit e deixa mudanças no histórico

- ##### git reset --hard HEAD^ = Desfaz último commit e mudanças

- ##### git revert -m 1 <commit_hash> = Desfaz o merge, criando um novo commit para reversão, deixando o histórico limpo

- ##### git reset --hard <commit_hash> = Desfaz o merge, voltando ao estado anterior do commit, cuidado pois reescreve o  histórico

- ##### git revert -m 1 <commit_hash> = Desfaz o PR, criando um novo commit para reversão, deixando o histórico limpo

- ##### git reset --hard <commit_hash_anterior> = Desfaz o PR, voltando ao estado anterior do commit, cuidado pois pode causar problemas se tiver outros colaboradores na branch

--------------------

### Como subir um servidor php?
#### 1. Vá no cmd
#### 2. Dirija-se ao diretório do projeto
#### 3. Digite ``php -S localhost:8000``
#### ou
#### 1. Vá no cmd
#### 1. Digite ``php -S localhost:8000 -t /caminho/para//o/projeto``



# Atividade Prática Individual - CRUD CodeIgniter
# Luiz Augusto Grein

## Passos iniciais

1. Criar manualmente um banco chamado db_crudcodeigniter

2. alterar as informações do banco de dados nos arquivos:
- .env
- app/Config/Database.php
Obs: Para a validação do funcionamento está liberado o arquivo .env em .gitignore

3. Criar as tabelas no banco a partir das migrations
> php spark migrate

4. Executar servidor
> php spark serve

## Comandos caso necessário

> composer update

> php spark migrate

> php spark migrate:rollback

> php spark serve
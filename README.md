# API Payment  
Uma api para facilitar a forma de pagamento, contendo 3 maneiras de realizar o pagamento

### Passos 

1. Primeiro, instale o Laravel e suas dependências utilizando Composer
`composer install`

2. Configuração do Banco de Dados:
Configure as informações de conexão do banco de dados no arquivo .env.

3. Crie as migrações para as tabelas necessárias.
`php artisan migrate`

4. Configuração da Fila:
Configure o driver de fila no arquivo .env
`QUEUE_CONNECTION=database`

5. Execute as migrações para criar a tabela de filas.

`php artisan queue:table` 

`php artisan migrate`

6. Inicie o worker da fila para processar os jobs
`php artisan queue:work`

7. Testar a API:
Use ferramentas como Postman ou Insomnia para enviar uma requisição POST para **/api/pagamentos** 


# Fidelidade API - Documentação 😎🚀

## O que é essa API?

Essa API foi criada para o teste técnico da empresa **FIDELIZI**. O objetivo é gerenciar o programa de fidelidade, permitindo o cadastro e consulta de clientes, o acúmulo de pontos com base em compras e o resgate de prêmios com esses pontos.

Ela também envia notificações por e-mail sobre eventos importantes, como o acúmulo de pontos ou o resgate de prêmios. A API foi desenvolvida com Laravel e é escalável, preparada para uma futura integração com um sistema frontend.

## Arquitetura 🏗️

A aplicação foi construída com o framework **Laravel** e possui os seguintes componentes principais:

- **Controladores (Controllers)**:
  - **ClienteController**: Gerencia o cadastro e consulta dos dados do cliente.
  - **TransacaoController**: Processa as transações de compra e o cálculo dos pontos.
  - **RecompensasController**: Gerencia os resgates de prêmios.

- **Modelos (Models)**:
  - **Cliente**: Dados do cliente e saldo de pontos.
  - **Brindes**: Dados dos brindes disponíveis para resgatar.
  - **Transacao**: Transações financeiras dos clientes e os pontos acumulados.
  - **Recompensa**: Registros dos prêmios resgatados.

- **Jobs**:
  - **EnviarEmailPontosJob**: Envia um e-mail ao cliente quando ele ganha pontos.
  - **EnviarEmailResgateJob**: Envia um e-mail quando o cliente resgata um prêmio.

## Requisitos 💻

- **PHP 8.2**
- **Laravel 11**
- **MySQL**
- **Composer**

## Como Rodar a Aplicação 🚀

1. **Clone o repositório**:

   ```bash
   git clone https://github.com/Matheusedus/Fidelidade-API.git
   cd Fidelidade-API
   ```

2. **Instale as dependências**:

   ```bash
   composer install
   ```

3. **Configure o ambiente**:

   Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente.

   ```bash
   cp .env.example .env
   ```

4. **Gere a chave da aplicação**:

   ```bash
   php artisan key:generate
   ```

5. **Execute as migrações e seeders**:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Inicie o servidor**:

   ```bash
   php artisan serve
   ```

   A aplicação estará disponível em `http://localhost:8000`.

7. **Importe a collection do Postman**:

   Importe o arquivo `FIDELIDADE.postman_collection.json` do repositório no **Postman** para testar os endpoints da API.

## Considerações Finais 🎉

Essa API oferece uma solução eficiente para programas de fidelidade, com escalabilidade e facilidade de integração com outros sistemas. Ela garante o gerenciamento do acúmulo de pontos, resgates e notificações automáticas para os clientes.

Se precisar de ajuda ou sugestões, entre em contato! A API é um excelente ponto de partida para sistemas de fidelidade mais completos e personalizados. 🌱🚀

Aproveite! 😎

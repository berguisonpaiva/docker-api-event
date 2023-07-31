Claro, abaixo está o conteúdo no formato README.md:

# API de Evento Laravel 10.x com MariaDB

Esta é uma API de Evento desenvolvida em Laravel 10.x com o banco de dados MariaDB. Siga as instruções abaixo para configurar e executar o projeto localmente.

## Passo a passo para rodar o projeto

1. Clone o repositório:

```bash
git clone git@github.com:berguisonpaiva/docker-api-event.git
```

2. Acesse o diretório do projeto:

```bash
cd docker-api-event/
```

3. Crie o arquivo de ambiente `.env`:

```bash
cp .env.example .env
```

4. Instale as dependências do projeto:

```bash
chmod +x install.sh
./install.sh
```

5. Suba os containers do projeto:

```bash
./vendor/bin/sail up -d
```

6. Rode as migrações do banco de dados:

```bash
./vendor/bin/sail artisan migrate
```

7. Rode os seeders para popular o banco de dados com dados de exemplo:

```bash
./vendor/bin/sail artisan migrate:refresh --seed
```

8. Gere a chave do projeto Laravel:

```bash
./vendor/bin/sail artisan key:generate
```

9. Gere a chave secreta JWT:

```bash
./vendor/bin/sail artisan jwt:secret
```

Agora, o projeto está configurado e em execução localmente. Acesse a API através do seu navegador ou cliente HTTP para testar os endpoints disponíveis.

Para parar os containers e remover os recursos utilizados pelo projeto, você pode utilizar o seguinte comando:

```bash
./vendor/bin/sail down
```

**Observação**: Lembre-se de que essas instruções são destinadas a um ambiente de desenvolvimento local. Para um ambiente de produção, outras configurações e medidas de segurança podem ser necessárias.
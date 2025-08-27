# Gerenciador de Clientes

Aplicação web em **Laravel** para cadastro e gestão de clientes, incluindo vínculo com **Operadoras** e **Status do Cliente**. Contém CRUD completo, validações de entrada, paginação e máscaras de moeda no formulário.

---

## ✨ Funcionalidades

* Cadastro, edição, listagem e exclusão de **Clientes** (CRUD).
* Associação do cliente a uma **Operadora** e um **Status**.
* **Paginação** na listagem de clientes.
* **Validações** no backend (documento, email, datas, etc.).
* **Máscara de moeda** para o campo "Valor da Proposta" via **Inputmask** (CDN em `edit/create.blade.php`).

---

## 🧰 Stack & Requisitos

* **PHP** ≥ 8.2
* **Composer** ≥ 2.x
* **Node.js** ≥ 18 (recomendado 20) e **npm**
* **Banco de dados**: MySQL/MariaDB (ou outro compatível configurado no `.env`)
* **Laravel** (esqueleto padrão com Vite + Tailwind)

> O repositório contém `composer.json`, `package.json`, `vite.config.js` e `tailwind.config.js`, além dos diretórios padrão `app`, `config`, `database`, `public`, `resources`, `routes`, `storage`, `tests`.

---

## 📦 Instalação (passo a passo)

### 1) Clonar o projeto

```bash
git clone https://github.com/RickMatsu/GereciadorClientes.git
cd GereciadorClientes
```

### 2) Copiar `.env` e configurar ambiente

```bash
cp .env.example .env
```

Edite o arquivo `.env` e defina ao menos:

```env
APP_NAME="GerenciadorClientes"
APP_ENV=local
APP_KEY= # será gerada no próximo passo
APP_URL=http://localhost

# Banco de dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gerenciador_clientes
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# Timezone/locale (opcional)
APP_TIMEZONE=America/Sao_Paulo
APP_LOCALE=pt_BR
```

### 3) Instalar dependências do PHP e gerar chave

```bash
composer install
php artisan key:generate
```

### 4) Instalar dependências de front-end

```bash
npm install
```

### 5) Compilar os assets

Durante o desenvolvimento:

```bash
npm run dev
```

Para build de produção:

```bash
npm run build
```

### 6) Criar as tabelas do banco

```bash
php artisan migrate
```

> Se você adicionou seeders, rode: `php artisan db:seed`. Caso não haja seeders, cadastre **Operadoras** e **Status** via interface ou Tinker conforme abaixo.

### 7) Subir o servidor de desenvolvimento

```bash
php artisan serve
```

Acesse em: [http://localhost:8000](http://localhost:8000)

> Se necessário, crie o link de `storage` (para uploads):

```bash
php artisan storage:link
```

---

## 🗂️ Estrutura (alto nível)

```
app/
bootstrap/
config/
database/
public/
resources/
  └── views/
      └── clientes/ (blades de create, edit, index, show)
routes/
  └── web.php (rotas web, incluindo recursos de clientes)
storage/
...
composer.json
package.json
vite.config.js
tailwind.config.js
```

---

## 🔗 Rotas principais (exemplo)

As rotas costumam seguir o resource controller de `ClienteController`:

```php
Route::resource('clientes', ClienteController::class);
```

Isso disponibiliza:

* `GET /clientes` → index
* `GET /clientes/create` → create
* `POST /clientes` → store
* `GET /clientes/{cliente}` → show
* `GET /clientes/{cliente}/edit` → edit
* `PUT/PATCH /clientes/{cliente}` → update
* `DELETE /clientes/{cliente}` → destroy

> Garanta que `ClienteController` injete na view de edição/criação as coleções `$operadoras` e `$status`.

---

## 🧪 Validações & Regras (exemplos do backend)

No `ClienteController` (método `store`), há validações como:

* `email` único na tabela `clientes`.
* `documento` com 11 dígitos (CPF) **ou** 14 dígitos (CNPJ).
* `operadora` e `status` devem existir nas tabelas correspondentes.
* Campos de data obrigatórios.

> Dica: ao salvar, o backend define `cpf` **ou** `cnpj` com base no tamanho do `documento`.

---

## 🧩 Modelos e Relacionamentos (esperados)

* **Cliente**

  * Pertence a **Operadora** (`operadora_id`).
  * Pertence a **StatusCliente** (`status_id`).
* **Operadora** (lista usada nos `selects` de create/edit)
* **StatusCliente** (lista usada nos `selects` de create/edit)

> Na *view* de edição/criação, os `select`s devem receber `$operadoras` e `$status`. No controller, injete-os no `return view(...)`.

---

## 🧯 Troubleshooting

**1) “Undefined variable \$operadoras/\$status” em `edit.blade.php`/`create.blade.php`**

* Garanta que o método `edit` e `create` passem as variáveis para a view:

  ```php
  $operadoras = Operadora::all();
  $status = StatusCliente::all();
  return view('clientes.edit', compact('cliente','operadoras','status'));
  ```

**2) Campo `numero_vidas` não é salvo**

* Corrija o typo no `store`: `nuemro_vidas` → `numero_vidas`.

**3) Assets não atualizam**

* Rode `npm run dev` (ambiente dev) ou `npm run build` (produção).
* Limpe cache do Laravel:

  ```bash
  php artisan optimize:clear
  ```

**4) Erros de permissão em `storage/` e `bootstrap/cache/` (Linux/Mac)**

```bash
chmod -R ug+rw storage bootstrap/cache
```

**5) “No application encryption key has been specified”**

```bash
php artisan key:generate
```

**6) Erros de conexão com o banco**

* Verifique `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` no `.env`.
* Confirme se o servidor do banco está em execução.

---

## 🧪 Dados iniciais (opcional via Tinker)

Caso não existam seeders, você pode cadastrar rapidamente no Tinker:

```bash
php artisan tinker

>>> \App\Models\Operadora::create(['nome' => 'Operadora X']);
>>> \App\Models\StatusCliente::create(['status_nome' => 'Ativo']);
>>> \App\Models\StatusCliente::create(['status_nome' => 'Inativo']);
```

---

## 🛡️ Segurança

* Valide e sanitize os dados de entrada (já iniciado no controller).
* Use prepared statements/ORM (Eloquent) para evitar SQL Injection.
* Mantenha `APP_ENV=production` e `APP_DEBUG=false` em produção.

---


# Nunes & Durães Advocacia - Sistema de Agendamentos e Landing Page

Plataforma web desenvolvida para o escritório **Nunes & Durães Advocacia**, combinando uma landing page institucional com um sistema integrado de solicitação e gestão de agendamentos jurídicos.

---

## 🏛️ Sobre o Projeto

O sistema foi concebido para proporcionar uma experiência fluida para os clientes que necessitam de atendimento jurídico, bem como controle administrativo centralizado para os advogados e gestores do escritório.

### Principais Funcionalidades

- **Área Pública (Clientes / Visitantes)**:
  - Visualização dos serviços e áreas de especialidade do escritório.
  - Solicitação de agendamento online com validação em tempo real:
    - Verificação de dias úteis com expediente cadastrado.
    - Bloqueio de horários fora da grade de atendimento.
    - Prevenção automática de sobreposição ou duplicidade de horários.

- **Painel Administrativo (Gestão do Escritório)**:
  - Autenticação e controle de acesso seguro (Laravel Breeze).
  - Dashboard operacional com contadores em tempo real (agendamentos pendentes, concluídos e cancelados).
  - Tabela de agendamentos com paginação e busca por nome ou e-mail do cliente.
  - Atualização rápida do status dos atendimentos (conclusão ou cancelamento liberando a vaga).
  - Cadastro e edição de serviços (com trava de segurança relacional contra exclusão de serviços com histórico ativo).
  - Gestão da grade de expediente semanal com configuração individualizada de horários por dia da semana.

---

## 🚀 Tecnologias Utilizadas

- **Backend**: [Laravel 12](https://laravel.com/) (PHP 8.3+)
- **Banco de Dados**: SQLite
- **Frontend**: Blade Templates, [Tailwind CSS](https://tailwindcss.com/) com paleta corporativa personalizada, [Alpine.js](https://alpinejs.dev/)
- **Build Tool**: [Vite](https://vitejs.dev/)
- **Autenticação**: Laravel Breeze
- **Testes Automatizados**: PHPUnit / Artisan Test Runner

---

## ⚙️ Pré-requisitos

- **PHP** >= 8.3 (com extensões `sqlite3`, `mbstring`, `openssl`, etc.)
- **Composer**
- **Node.js** (versão 18 ou superior) & **NPM**

---

## 🛠️ Instalação e Configuração

1. **Instalar dependências PHP e JavaScript**:
   ```bash
   composer install
   npm install
   ```

2. **Configurar o arquivo de ambiente**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Executar migrações e popular o banco de dados**:
   ```bash
   php artisan migrate --seed
   ```
   *Nota: O banco de dados padrão é configurado em `database/database.sqlite`.*

4. **Compilar os assets do frontend**:
   ```bash
   # Para desenvolvimento:
   npm run dev

   # Ou para build de produção:
   npm run build
   ```

5. **Iniciar o servidor de desenvolvimento**:
   ```bash
   php artisan serve
   ```
   Acesse a aplicação em `http://localhost:8000`.

---

## 🔐 Acesso Administrativo

Para acessar o painel de gestão (`/dashboard`), utilize as credenciais padrão geradas pelo seeder:

- **URL de Login**: `http://localhost:8000/login`
- **E-mail**: `admin@nuneseduraes.com.br`
- **Senha**: `password`

---

## 🧪 Executando os Testes Automatizados

A aplicação conta com uma suíte de testes de integração e regras de negócio:

```bash
php artisan test
```

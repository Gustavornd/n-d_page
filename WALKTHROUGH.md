# 🏛️ Walkthrough & Guia de Continuidade — MTD Advogados

Este documento serve como registro completo das transformações realizadas no projeto e guia técnico de continuidade para você trabalhar com o **Antigravity integrado ao VS Code**.

---

## 📋 1. Visão Geral da Transformação

O projeto iniciou como um protótipo de agendamento jurídico desenvolvido para um teste de emprego (Laravel, SQLite e Tailwind). Ele foi completamente higienizado e transformado na plataforma oficial de alta fidelidade do escritório **MTD ADVOGADOS DIREITO & PRESTÍGIO**, unindo:

1. **Landing Page "Dark-Luxury"** de altíssimo padrão visual baseada no protótipo (`prototipo da landing page.jpg`) e no logotipo vetorial dourado (`assets/logo_mtd_gold.png`).
2. **Formulário de Conversão Rápida** na Hero Section para captação imediata de potenciais clientes (`Contato`).
3. **Sistema Completo de Agendamento Online** preservado no backend e integrado via Modal inteligente e botões nas Áreas de Atuação.
4. **Painel de Gestão Operacional** para os advogados gerenciarem status de agendamentos, horários de expediente semanal e especialidades.

---

## 🎨 2. Design System: Estética Dark-Luxury

A estilização foi configurada de forma estrita via Tailwind CSS e CSS nativo:

| Cor | Hexadecimal | Uso no Projeto |
|---|---|---|
| **Preto Absoluto** | `#0D0D0D` | Fundo principal da página, cabeçalho fixo, rodapé e fundo do card de contato |
| **Cinza Grafite** | `#2C2C2C` | Fundo da Hero Section, linhas divisorias, seções institucionais e overlays |
| **Dourado Prestígio** | `#D4AF37` | Logotipo MTD, títulos em destaque, botões com gradiente, bordas finas e rosetas |
| **Prata Moderno** | `#848484` | Subtítulos, linhas geométricas vetoriais de fundo, placeholders e bordas de inputs |
| **Off-White** | `#F9F9FB` | Textos principais de leitura, labels e links de navegação |

### Tipografia
- **Títulos Romanos & Emblemas**: Família `Cinzel` (maiúsculas lapidares).
- **Headlines & Subtítulos Clássicos**: `Playfair Display` e `Cormorant Garamond` (serifadas elegantes).
- **Corpo e Dados**: `Figtree` / `sans-serif` para máxima legibilidade.

---

## 🧱 3. Estrutura das Seções da Landing Page (`welcome.blade.php`)

### A. Cabeçalho (Header)
- **Logotipo**: Emblema dourado MTD com a espada e balança da justiça no topo do 'T' + texto `MTD ADVOGADOS`.
- **Menu Central**: Links com efeito hover dourado (`Início`, `Sobre Nós`, `Áreas de Atuação`, `Contato`) e atalho discreto ao painel caso logado.
- **Botão Superior**: Estilo outline fino em dourado com o telefone `(11) 99999-9999`.

### B. Hero Section (Grid 50% / 50%)
- **Fundo**: Grafismos geométricos vetorizados com linhas diagonais prateadas e curvas douradas concêntricas fiéis ao protótipo.
- **Coluna da Esquerda**:
  - Badge dourado: `ESCRITÓRIO DE ADVOCACIA`.
  - Headline serifada: *"SOLUÇÕES JURÍDICAS DE ALTO PADRÃO PARA PROTEGER SEU PATRIMÔNIO E SEUS DIREITOS"*.
  - Subtítulo em prata e 3 diferenciais com selos de roseta dourada e checkmarks.
- **Coluna da Direita (Card de Conversão)**:
  - Card arredondado com borda dourada suave e sombra com iluminação dourada.
  - Título *"Fale com um Especialista"*.
  - Inputs com foco dourado: *Nome Completo*, *E-mail*, *Telefone*, *Mensagem*.
  - Botão CTA com gradiente dourado metálico: `ENVIAR MENSAGEM →`.
  - Link de conveniência logo abaixo para quem prefere agendar data/hora exata no modal.

### C. Seções Complementares
- **Sobre Nós (`#sobre`)**: Apresentação corporativa, métricas de prestígio (15+ anos, 98% êxito, 100% confidencialidade) e brasão MTD.
- **Áreas de Atuação (`#areas`)**: Cards dinâmicos carregando os serviços ativos do banco de dados, com botão direto para agendamento.
- **Rodapé (`footer`)**: Marca de apoio reduzida `M/T/D ADVOGADOS`, contatos unificados com ícones vetoriais de e-mail e WhatsApp, e direitos autorais.

---

## 📂 4. Arquivos Principais do Projeto

```
agendamento-advogados/
├── app/
│   ├── Http/Controllers/
│   │   ├── SiteController.php       # Renderiza a LP, processa contato e valida agendamentos
│   │   ├── AdminController.php      # Dashboard de gestão, contadores e atualização de status
│   │   └── ServicoController.php    # CRUD de serviços e horários de expediente semanal
│   └── Models/
│       ├── Contato.php              # Model de mensagens de contato enviadas na LP
│       ├── Agendamento.php          # Model de agendamentos com data, hora e status
│       ├── Servico.php              # Model de especialidades do escritório
│       └── Expediente.php           # Model da grade semanal de horários permitidos
├── database/
│   ├── database.sqlite              # Banco de dados local SQLite
│   ├── migrations/
│   │   ├── ..._create_servicos_table.php
│   │   ├── ..._create_agendamentos_table.php
│   │   ├── ..._create_expedientes_table.php
│   │   └── 2026_10_21_000000_create_contatos_table.php
│   └── seeders/
│       └── DatabaseSeeder.php       # Cria usuário admin (admin@nuneseduraes.com.br) e dados de demonstração
├── public/
│   └── assets/
│       ├── logo_mtd_gold.png        # Logo dourado com balança e espada
│       └── prototipo da landing page.jpg
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php        # Landing Page MTD Advogados
│   │   ├── dashboard.blade.php      # Painel de gestão administrativa
│   │   └── servicos/                # Gestão de especialidades e expediente
│   └── css/app.css
├── routes/
│   └── web.php                      # Rotas públicas e autenticadas
├── tests/
│   └── Feature/
│       ├── SiteContatoTest.php      # Testes de validação da nova LP e formulário
│       └── SiteAgendamentoTest.php  # Testes de validação de regras de agendamento
└── tailwind.config.js               # Paleta de cores e tipografias customizadas
```

---

## 🚀 5. Como Rodar no VS Code

Abra o terminal integrado do VS Code na pasta `agendamento-advogados`:

```powershell
cd agendamento-advogados
```

### 1. Iniciar o servidor Laravel:
```powershell
php artisan serve
```
Acesse: **`http://localhost:8000`**

### 2. Iniciar o compilador de assets (se for editar Tailwind/JS):
```powershell
npm run dev
```

### 3. Rodar os testes automatizados:
```powershell
php artisan test
```
*Atualmente conta com 37 testes automatizados e 126 asserções aprovadas com 100% de sucesso.*

---

## 🔐 6. Credenciais de Acesso ao Painel Administrativo

- **URL de Login**: `http://localhost:8000/login`
- **E-mail**: `admin@nuneseduraes.com.br`
- **Senha**: `password`

No painel (`/dashboard`), você tem:
- Contadores de agendamentos pendentes, concluídos e cancelados.
- Tabela com busca por nome ou e-mail do cliente.
- Botões de ação para concluir ou cancelar agendamentos.
- Aba de **Serviços** (`/servicos`) para criar/desativar especialidades e configurar os dias/horários de expediente em que o escritório atende.

---

## 🎯 7. Sugestões de Próximos Passos para o Antigravity / VS Code

Quando retomar com o Antigravity no VS Code, aqui estão algumas melhorias prontas para serem implementadas:

1. **Aba de Mensagens no Dashboard**:
   - Criar uma aba ou seção no `/dashboard` para o advogado visualizar a lista de contatos recebidos através da tabela `contatos` (nome, e-mail, telefone, mensagem e data de envio).
2. **Notificações por E-mail ou WhatsApp**:
   - Configurar o disparo de e-mail ao cliente confirmando a solicitação de contato ou agendamento.
   - Criar botão direto na tabela do admin para iniciar conversa no WhatsApp com o cliente cadastrado.
3. **SEO & Metatags Open Graph**:
   - Personalizar os cards de compartilhamento para WhatsApp, LinkedIn e Google.

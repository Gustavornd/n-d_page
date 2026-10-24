# 🏛️ Walkthrough & Guia do Projeto — Nunes & Durães Advocacia

Este documento resume a estrutura oficial do projeto para o escritório **Nunes & Durães Advocacia**, mantendo 100% da arquitetura original em Laravel, com seus layouts de aplicação, formulário de agendamento e regras de negócio no back-end.

---

## 📋 1. Visão Geral

- **Escritório**: **Nunes & Durães Advocacia**
- **Stack**: Laravel 12, SQLite (`database/database.sqlite`), Tailwind CSS, Alpine.js e Vite.
- **Estrutura de Telas**:
  1. **Área Pública (`welcome.blade.php`)**: Utiliza o layout padrão da aplicação (`<x-app-layout>`) com navegação corporativa (`layouts/navigation.blade.php`), apresentando o design *Dark-Luxury* e o formulário oficial de solicitação de agendamento.
  2. **Área de Gestão (`dashboard.blade.php` e `servicos/`)**: Painel administrativo para os advogados gerenciarem status de agendamentos, lista de especialidades jurídicas e horários de expediente.

---

## 🎨 2. Design System: Estética Dark-Luxury

A paleta de cores corporativa foi configurada para criar uma experiência sóbria e refinada:

| Cor | Hexadecimal | Utilização |
|---|---|---|
| **Preto Absoluto** | `#0D0D0D` | Base do card de agendamento, contrastes profundos |
| **Cinza Grafite** | `#2C2C2C` | Fundo da Hero Section e overlays estruturais |
| **Dourado Prestígio** | `#D4AF37` | Títulos em destaque, bordas, botões em gradiente e selos de roseta |
| **Prata Moderno** | `#848484` | Subtítulos, linhas geométricas vetoriais e bordas de inputs |
| **Off-White** | `#F9F9FB` | Textos de leitura principal, labels e campos |

---

## ⚙️ 3. Regras de Negócio e Agendamento (Back-end)

A lógica de agendamento é processada pelo método `SiteController::store` através da rota `POST /agendar`:

1. **Validação de Expediente**: Verifica se o escritório atende no dia da semana selecionado (`Expediente::where('dia_semana', $diaSemana)`).
2. **Validação de Horário**: Garante que o horário escolhido esteja rigorosamente dentro do intervalo de atendimento daquele dia (`$expediente->inicio` até `$expediente->fim`).
3. **Bloqueio de Conflitos**: Impede sobreposição de dois agendamentos no mesmo dia e horário (exceto se o agendamento anterior tiver sido cancelado).
4. **Painel de Gestão**: Atualização de status direta (`pendente`, `concluido`, `cancelado`) no `/dashboard`.

---

## 📁 4. Arquivos Principais

```
agendamento-advogados/
├── app/Http/Controllers/
│   ├── SiteController.php       # Exibe a LP e valida o formulário de agendamento (store)
│   ├── AdminController.php      # Métricas, busca e status dos agendamentos
│   └── ServicoController.php    # CRUD de serviços e horários de expediente semanal
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php        # Layout principal com fonte e assets
│   │   ├── navigation.blade.php # Barra de navegação corporativa (Início, Gestão, Login)
│   │   └── guest.blade.php      # Layout para telas de autenticação
│   ├── welcome.blade.php        # Landing page integrada com <x-app-layout>
│   └── dashboard.blade.php      # Painel administrativo
├── routes/
│   └── web.php                  # Rotas oficiais (home, agendar, dashboard, servicos, profile)
└── tailwind.config.js           # Cores e tipografias customizadas
```

---

## 🚀 5. Comandos para Executar no VS Code

Abra o terminal integrado na pasta `agendamento-advogados`:

```powershell
cd agendamento-advogados
```

### Iniciar o Servidor:
```powershell
php artisan serve
```
Acesse: **`http://localhost:8000`**

### Iniciar Compilador Vite:
```powershell
npm run dev
```

### Executar os Testes Automatizados:
```powershell
php artisan test
```
*32 testes executados com 100% de sucesso.*

---

## 🔐 6. Acesso Administrativo

- **URL de Login**: `http://localhost:8000/login`
- **E-mail**: `admin@nuneseduraes.com.br`
- **Senha**: `password`

# Diretrizes do Projeto: Nunes & Durães Advocacia

## Stack
- Laravel 12 (PHP 8.3+)
- Tailwind CSS
- Alpine.js
- SQLite (`database/database.sqlite`)

## Comandos Principais
- Iniciar servidor de backend: `php artisan serve`
- Iniciar Vite / Tailwind: `npm run dev`
- Build frontend: `npm run build`
- Executar testes automatizados: `php artisan test`

## Regras de Negócio de Agendamento
- Clientes solicitam agendamentos através da rota `/agendar` (`SiteController::store`).
- Validações ativas:
  - Dias com expediente cadastrado (`Expediente`).
  - Horários dentro da janela de início e fim do expediente daquele dia.
  - Bloqueio de duplicidade para o mesmo dia e horário, exceto se cancelado.

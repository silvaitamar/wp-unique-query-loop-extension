# Unique Query Loop Extension

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

Extensão oficial do bloco nativo **Query Loop** (`core/query`) que evita posts duplicados entre múltiplos loops na mesma página.

**Autor:** [Itamar Silva](https://github.com/silvaitamar) · [Perfil WordPress](https://profiles.wordpress.org/itamarsilvacc/)

## Funcionalidade

Adiciona o atributo `uniqueOnPage` e o controle **Tornar posts únicos na página** no editor de blocos. No front-end, cada Query Loop com a opção ativa exclui posts já exibidos por loops anteriores (via `post__not_in`).

## Requisitos

- WordPress 6.7+
- PHP 7.4+

## Compatibilidade

Testado com variações do [Advanced Query Loop](https://wordpress.org/plugins/advanced-query-loop/) na mesma página. Variações de `core/query` permanecem compatíveis porque o plugin estende o bloco nativo e usa os mesmos hooks oficiais.

Detalhes: [docs/COMPATIBILITY.md](docs/COMPATIBILITY.md).

## Instalação

### WordPress.org (após publicação)

Instale pelo painel **Plugins → Adicionar novo** ou baixe em [wordpress.org/plugins/unique-query-loop-extension](https://wordpress.org/plugins/unique-query-loop-extension/).

### Desenvolvimento

```bash
git clone https://github.com/silvaitamar/wp-unique-query-loop-extension.git
cd wp-unique-query-loop-extension
composer install
npm install
npm run build
```

Ative o plugin no WordPress.

## Desenvolvimento

```bash
npm run start   # watch do editor
npm run build   # build de produção
```

## Licença

GPL-2.0-or-later. Veja [LICENSE](LICENSE) ou o cabeçalho do plugin.

## Changelog

Veja [CHANGELOG.md](CHANGELOG.md).

# Changelog

Todas as mudanças notáveis deste projeto são documentadas neste arquivo.

O formato segue [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) e o versionamento segue [SemVer](https://semver.org/lang/pt-BR/).

## [Unreleased]

### Changed

- Strings-fonte do editor agora em inglês (`msgid`), seguindo a convenção do WordPress.org; o português passou a ser uma tradução empacotada.
- Prioridade do filtro `query_loop_block_query_vars` alterada para 20 (compatibilidade com Advanced Query Loop e extensões similares).
- Hooks públicos `uqle_query_loop_post__not_in` e `uqle_should_track_query_block` para integrações de terceiros.
- Revisão da documentação pública: README unificado, `readme.txt` sem referências prematuras, guia de release removido do repositório.
- Código-fonte PHP normalizado para o WordPress Coding Standards.

### Added

- Tradução pt_BR empacotada em `languages/` (`.pot`, `pt_BR.po`/`.mo` e o `.json` de tradução do script do editor).
- Testes unitários (PHPUnit) do `Rendered_Posts_Registry`.
- Verificação de padrões (PHPCS/WordPress Coding Standards) e workflow de CI no GitHub Actions (lint + testes).
- Documentação de compatibilidade em `docs/COMPATIBILITY.md`.
- Seções de limitações conhecidas: "Herdar consulta do modelo" (`inherit: true`) e preview do editor.
- Compatibilidade com cache de página (full-page cache) validada e documentada.
- FAQ sobre "Inherit query from template" no `readme.txt`.
- Índice em `docs/README.md`.

### Fixed

- Pacote de distribuição passa a incluir as classes PHP de `src/` (antes excluídas pelo `.distignore`), corrigindo erro fatal na ativação a partir do ZIP. O script de release agora valida a presença de `src/Plugin.php`.
- Empacotamento: `scripts/`, `tests/`, configs de CI e ZIPs antigos não são mais incluídos no pacote de distribuição.

## [1.0.0] - 2026-06-16

### Added

- Atributo `uniqueOnPage` no bloco nativo `core/query`.
- Toggle **Tornar posts únicos na página** no painel lateral do Query Loop.
- Exclusão via `post__not_in` no filtro `query_loop_block_query_vars`.
- Registro de IDs renderizados por requisição com `Rendered_Posts_Registry`.
- GitHub Actions de release e script `scripts/build-release-zip.sh`.

### Fixed

- `TypeError` em `pre_render_block` quando o bloco raiz não possui pai (`WP_Block|null`).

[Unreleased]: https://github.com/silvaitamar/wp-unique-query-loop-extension/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/silvaitamar/wp-unique-query-loop-extension/releases/tag/v1.0.0

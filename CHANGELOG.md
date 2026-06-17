# Changelog

Todas as mudanças notáveis deste projeto são documentadas neste arquivo.

O formato segue [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) e o versionamento segue [SemVer](https://semver.org/lang/pt-BR/).

## [Unreleased]

### Changed

- Prioridade do filtro `query_loop_block_query_vars` alterada para 20 (compatibilidade com Advanced Query Loop e extensões similares).
- Hooks públicos `uqle_query_loop_post__not_in` e `uqle_should_track_query_block` para integrações de terceiros.

### Added

- Documentação de compatibilidade em `docs/COMPATIBILITY.md`.

## [1.0.0] - 2026-06-16

### Added

- Atributo `uniqueOnPage` no bloco nativo `core/query`.
- Toggle **Tornar posts únicos na página** no painel lateral do Query Loop.
- Exclusão via `post__not_in` no filtro `query_loop_block_query_vars`.
- Registro de IDs renderizados por requisição com `Rendered_Posts_Registry`.
- Fluxo de release: GitHub Actions, script de ZIP e documentação em `docs/RELEASE.md`.

### Fixed

- `TypeError` em `pre_render_block` quando o bloco raiz não possui pai (`WP_Block|null`).

[Unreleased]: https://github.com/silvaitamar/unique-query-loop-extension/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/silvaitamar/unique-query-loop-extension/releases/tag/v1.0.0

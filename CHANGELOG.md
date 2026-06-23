# Changelog

Todas as mudanças notáveis deste projeto são documentadas neste arquivo.

O formato segue [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) e o versionamento segue [SemVer](https://semver.org/lang/pt-BR/).

## [Unreleased]

## [1.0.0] - 2026-06-23

### Added

- Atributo `uniqueOnPage` no bloco nativo `core/query`, com o toggle **Make posts unique on page** no painel lateral do Query Loop.
- Exclusão de posts já exibidos via `post__not_in` no filtro `query_loop_block_query_vars` (prioridade 20, para rodar após extensões como o Advanced Query Loop).
- Registro de IDs renderizados por requisição com `Rendered_Posts_Registry`.
- Hooks públicos `uqle_query_loop_post__not_in` e `uqle_should_track_query_block` para integrações de terceiros.
- Internacionalização: strings-fonte em inglês (`msgid`) e tradução pt_BR empacotada em `languages/` (`.pot`, `pt_BR.po`/`.mo` e o `.json` de tradução do script do editor).
- Testes unitários (PHPUnit) do `Rendered_Posts_Registry` e verificação de padrões (PHPCS/WordPress Coding Standards) com workflow de CI no GitHub Actions.
- Documentação de compatibilidade (`docs/COMPATIBILITY.md`), incluindo as limitações conhecidas — "Herdar consulta do modelo" (`inherit: true`) e preview do editor — e a validação com cache de página.
- GitHub Actions de release e script `scripts/build-release-zip.sh`.

[Unreleased]: https://github.com/silvaitamar/wp-unique-query-loop-extension/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/silvaitamar/wp-unique-query-loop-extension/releases/tag/v1.0.0

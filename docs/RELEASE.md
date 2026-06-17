# Fluxo de release — Unique Query Loop Extension

Guia interno para publicação no [WordPress.org Plugin Directory](https://wordpress.org/plugins/) e no [GitHub](https://github.com/silvaitamar).

## Repositórios

| Destino | Função |
|---------|--------|
| **GitHub** (`silvaitamar/unique-query-loop-extension`) | Fonte da verdade: código, issues, PRs, tags, releases |
| **WordPress.org SVN** | Distribuição oficial: `trunk/` (desenvolvimento) e `tags/X.Y.Z/` (estável) |

O repositório GitHub do plugin é a **fonte do produto**. Sites e projetos que o consomem mantêm histórico separado.

## Versionamento (SemVer)

- **MAJOR** — mudança incompatível de comportamento ou requisitos.
- **MINOR** — nova funcionalidade compatível.
- **PATCH** — correção de bug compatível.

Atualizar em sincronia:

1. `unique-query-loop-extension.php` — cabeçalho `Version` e constante `UQLE_VERSION`
2. `readme.txt` — `Stable tag` e entrada em `== Changelog ==`
3. `CHANGELOG.md` — seção datada
4. Tag Git `vX.Y.Z`

## Checklist antes de cada release

- [ ] Testes manuais no front-end (2+ Query Loops com `uniqueOnPage`)
- [ ] `npm run build` (bundle do editor atualizado)
- [ ] `composer dump-autoload -o` (se classes PHP mudaram)
- [ ] `readme.txt`: `Tested up to` com versão WP atual
- [ ] Textos e changelog revisados
- [ ] Nenhum `var_dump`, credencial ou URL de staging

## Publicar no GitHub

```bash
git checkout main
git pull
npm run build
composer dump-autoload -o
git add -A
git commit -m "chore: release X.Y.Z"
git tag -a vX.Y.Z -m "Release X.Y.Z"
git push origin main --tags
```

Criar **GitHub Release** a partir da tag com notas do `CHANGELOG.md`.

## Publicar no WordPress.org (SVN)

Após aprovação inicial do plugin, o SVN fica em:

`https://plugins.svn.wordpress.org/unique-query-loop-extension/`

```bash
svn co https://plugins.svn.wordpress.org/unique-query-loop-extension wporg-svn
cd wporg-svn

# Limpar trunk e copiar artefato (rsync respeitando .distignore)
rsync -av --delete \
  --exclude-from=../unique-query-loop-extension/.distignore \
  ../unique-query-loop-extension/ trunk/

svn add --force trunk/*
svn status
svn commit -m "Release X.Y.Z"

# Tag estável
svn cp trunk tags/X.Y.Z
svn commit -m "Tagging version X.Y.Z"
```

### Pasta `assets/` (SVN)

Banner e ícone ficam em `assets/`, **não** dentro de `trunk/`:

- `assets/icon-128x128.png`, `icon-256x256.png`
- `assets/banner-772x250.png`, `banner-1544x500.png` (opcional)

## Primeira submissão

1. Criar repositório público no GitHub com `README.md`, licença GPL e este plugin.
2. Acessar [Add your plugin](https://wordpress.org/plugins/developers/add/).
3. Enviar ZIP de produção (sem `node_modules`, sem `src/` se `build/` estiver incluído).
4. Aguardar revisão da equipe do WordPress (pode levar dias ou semanas).
5. Após aprovação, configurar `SVN` e fluxo de tags acima.

## Autoridade de perfil

- **Contributors** no `readme.txt`: `silvaitamar` (login WordPress.org).
- **Author URI**: link para [github.com/silvaitamar](https://github.com/silvaitamar).
- Manter plugin atualizado (`Tested up to`) após releases do WordPress.
- Responder reviews e suporte no fórum do plugin no WordPress.org.

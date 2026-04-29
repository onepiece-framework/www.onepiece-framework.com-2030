# CODEX.md

## Purpose

This file is the working guide for Codex and contributors editing this repository.

- `README.md` explains what the project is and how to start it.
- `CODEX.md` explains how to change it safely.
- Prefer repository-specific working rules over general framework descriptions.

## Project Snapshot

This repository is the application skeleton for the ONEPIECE Framework.

- The web entry point is `app.php`.
- `app.php` loads `asset/bootstrap/index.php` when bootstrap files are available.
- After bootstrap, the application proceeds through `OP()->Unit()->App()->Auto()`.
- `index.php` shows the basic pattern for resolving router args and selecting a template.
- Git submodules are required for normal application startup.

## First Files To Read

Read these before making changes:

1. `README.md`
   Setup, philosophy, local run commands.
2. `app.php`
   Entry-point behavior and bootstrap handoff.
3. `index.php`
   Minimal example of routing and template dispatch.
4. `.htaccess`
   Rewrite and pass-through assumptions.
5. `asset/bootstrap/index.php`
   Bootstrap load order and required includes.
6. `asset/config/*`
   Settings entry points for application behavior.

If a task changes startup, routing, or rendering, review all of the files above before editing.

## Runtime Flow

Keep this request flow in mind:

1. Apache rewrite or direct entry sends the request to `app.php`.
2. `app.php` sets `APP_ROOT` and loads `asset/bootstrap/index.php` if it exists.
3. Bootstrap loads core and config files, then supporting bootstrap includes.
4. `OP()->Unit()->App()->Auto()` continues the application lifecycle.
5. Templates are eventually chosen and rendered through framework routing and template APIs.

Important constraints:

- Do not remove the fallback logic at the top of `index.php`.
- Do not change bootstrap include order unless the startup contract truly changes.
- Keep routing decisions and template rendering concerns separated.

## Directory Responsibilities

Use these directories according to their intended roles:

- `asset/bootstrap/`
  Application bootstrap and startup include chain.
- `asset/config/`
  Application and environment configuration.
- `asset/layout/`
  Shared layout structure and common page framing.
- `asset/template/`
  Page templates and view-level output.
- `asset/unit/`
  UNIT-based application features and behavior.
- `asset/module/`
  Shared modules, tooling, and framework-related packages.
- `asset/init/`
  Project initialization, submodule setup, and update helpers.

When deciding where to edit:

- Page output changes should start in `asset/template/` or `asset/layout/`.
- Behavior controlled by configuration should start in `asset/config/`.
- Startup changes should stay isolated to bootstrap-related files.

## Editing Policy

Follow these rules when making changes:

- Prefer solving tasks in the skeleton layer before changing framework-like internals.
- Keep the HTML pass-through design intact.
- Avoid unrelated refactors while handling a focused task.
- Treat `app.php`, `.htaccess`, and bootstrap files as high-impact files.
- Keep changes local to the smallest responsible layer.

Practical defaults:

- UI or page changes: start with `asset/template/` and `asset/layout/`.
- Config changes: start with `asset/config/`.
- Routing changes: inspect `index.php`, rewrite assumptions, and router behavior together.
- Bootstrap changes: edit only when startup requirements actually need to change.

## Safe Change Patterns

### Adding a Page

- Create or update the relevant template in `asset/template/`.
- Confirm how the route resolves to that template.
- Recheck layout integration if the page uses common framing.
- Verify the 404 path is still correct for unknown routes.

### Updating an Existing Page

- Identify the template actually used by the route.
- Decide whether the change belongs in the page template or shared layout.
- Avoid duplicating common markup that should live in layout files.

### Changing Layout

- Start in `asset/layout/`.
- Prefer shared fixes over copying markup into individual templates.
- Recheck header, footer, and shared head output after changes.

### Changing Configuration

- Use `asset/config/` as the first place to change behavior.
- Do not hardcode environment-specific values in templates.
- Keep configuration concerns separate from rendering concerns.

### Changing Routing

- Review `index.php`, router usage, and `.htaccess` together.
- Preserve existing URL behavior unless the task explicitly changes it.
- Re-test both expected routes and unknown routes.

## Constraints And Assumptions

Assume the following project constraints are active:

- UTF-8 is the only officially supported encoding.
- Microsoft Windows is not officially supported.
- WSL may work, but should not be treated as the primary platform contract.
- Git submodules are part of the normal setup.
- Rewrite behavior depends on `.htaccess` and Apache `mod_rewrite`.
- The project targets PHP 8.x.

Editing implications:

- Do not silently change file encodings or line-ending conventions.
- Do not introduce environment assumptions without stating them.
- Prefer changes that remain valid across supported PHP 8.x setups.

## Verification Checklist

After making changes, verify the relevant items:

- `php asset/init/submodules.php` has been run if dependencies are missing.
- `php -S localhost:2030 app.php` starts successfully.
- The top page loads without PHP errors or warnings.
- The intended template renders as expected.
- Unknown routes still resolve to the intended 404 behavior.
- Layout changes do not break shared framing.
- Routing changes do not break existing paths unintentionally.
- Bootstrap changes do not block startup.

## Prohibited Changes

Do not do the following without explicit reason in the task:

- Remove or bypass the startup flow in `app.php`.
- Remove the fallback bootstrap logic at the top of `index.php`.
- Change `.htaccess` rewrite behavior casually.
- Ignore the submodule-based setup requirement.
- Move template-level changes into core behavior without need.
- Mix broad formatting or rename-only edits into functional work.

## Troubleshooting

### Application does not start

- Check whether submodules were initialized.
- Read `app.php` and `asset/bootstrap/index.php`.
- Look for missing files in the bootstrap include chain.

### Request routing is wrong

- Check `.htaccess` rewrite rules and `RewriteBase`.
- Confirm the request reaches `app.php`.
- Recheck router args and template selection.

### Template does not render

- Verify the expected template path exists.
- Confirm route-to-template resolution.
- Check whether a shared layout or config change overrides output.

### Unexpected 404

- Confirm the route is intended to exist.
- Recheck rewrite behavior and router args.
- Compare with the `index.php` pattern for template dispatch.

## Glossary

- `pass-through`
  A design where HTML-oriented files flow through the framework while still allowing PHP execution.
- `UNIT`
  A functional unit used to organize framework or application behavior.
- `Template`
  The file selected for rendering page content.
- `Layout`
  The shared page wrapper and common presentation structure.
- `Auto()`
  The application lifecycle step triggered after bootstrap completes.

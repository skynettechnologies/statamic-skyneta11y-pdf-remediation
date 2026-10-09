# Changelog

All notable changes are documented here. This project adheres to
[Semantic Versioning](https://semver.org/).

## [1.0.1] - Unreleased

### Security
- Stop shipping the provisioning key as a hardcoded default in `config.php` and
  `config.js`. It is now fetched server-side from the platform `key_url`
  endpoint at runtime (cached) and injected, with an optional manual override.
- Enforce the `…pdf-remediation.access` permission in the controller, not only on
  the nav item. The page and the embedded `?frame=1` URL now return 403 without
  the permission.
- Remove `?token=` session adoption from the dashboard (a crafted link could
  otherwise place another user's session in an admin's browser).

### Accessibility
- Move keyboard focus into the account, confirmation and plan dialogs on open,
  trap Tab, restore focus to the trigger on close, and close on Escape.
- Render Website Scan "Source" links as hyperlinks only when `http(s)`; other
  schemes render as plain text.

### Changed
- Render the dashboard full width and size its iframe to fill the viewport.
- Render the Control Panel page without Statamic version-specific component
  classes so it is consistent on Statamic 5 and 6.
- Add a `session_url` option (env `SKYNET_PDF_SESSION_URL`).
- Require PHP 8.2+ (Statamic 5's minimum).

### Documentation
- Add a Data & Privacy section; correct the CORS guidance; remove feature claims
  not present in this release; add the "Keeping the API key off the page"
  section; document `--force` re-publish after updates.

### Tests
- Replace the placeholder test with real permission tests.

## [1.0.0]

### Added
- Initial release.

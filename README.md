# SkynetA11y PDF Remediation (Statamic Addon)

The **SkynetA11y PDF Remediation** addon brings **PDF Accessibility Remediation for WCAG & PDF/UA Compliance** directly into your Statamic Control Panel. It is both a **PDF Accessibility Checker** and an **AI Remediation Tool**: upload documents or crawl your website for them, let AI repair the accessibility barriers automatically, review every check that was applied, and download conformant files — without leaving your own admin area.

It fixes the barriers that make PDFs unusable with assistive technology: missing tags, incorrect reading order, inaccessible forms and tables, images without alternate text, and absent document structure, language and metadata.

It supports compliance with **WCAG 2.0, 2.1, 2.2, PDF/UA, ADA, Section 508, AODA, and EN 301 549 (EAA)**.

It is a sibling of the `skynettechnologies/statamic-all-in-one-accessibility` and `skynettechnologies/statamic-skynet-accessibility-video-subtitle` addons and follows the same structure: a Control Panel tool under **Tools**.

This addon is designed for:

- Businesses of all sizes
- Enterprises
- Government and public sector entities
- Website owners
- E-commerce platforms
- Development and maintenance agencies

[**Start with a free AI remediation trial — up to 5 pages!**](https://www.skynettechnologies.com/pdf-accessibility-remediation)

## Why SkynetA11y PDF Remediation?

PDFs are where accessibility compliance quietly fails. A site can pass every page-level audit and still publish hundreds of untagged documents — reports, forms, invoices, policies — that screen readers cannot navigate at all.

Remediating them by hand is slow and expensive. This addon makes it a routine part of publishing: documents are discovered, repaired and re-checked inside the Control Panel your team already uses, so accessible PDFs become the default rather than a project.

## Key Features

- **SkynetA11y PDF Remediation** – Automated repair of tags, reading order, alt text, headings, tables and metadata.
- **Remediated Library** – List your remediated documents and download the conformant files over an authenticated session.
- **Upload or Crawl** – Add files by drag and drop, or sweep your website for every PDF it links to.
- **Free Trial** – The free plan covers your first 5 pages; paid plans scale from 50 to 10,000 pages.
- **Bulk Remediation** – Select any number of documents and process them in one run, with live progress.
- **Authenticated Downloads** – Remediated files are delivered over an authenticated session, never a public link.
- **No Settings Screen** – Nothing to paste and nothing to wire up. One short dialog asks for a name, email and domain the first time it is needed, and never again.
- **Integration with All in One Accessibility® Dashboard** – Plans, usage and billing stay in one place.

## Compliance Standards Supported

- WCAG 2.0, 2.1, 2.2
- PDF/UA (ISO 14289)
- ADA
- Section 508
- AODA
- EN 301 549 (EU / European Accessibility Act)

## Requirements

- Statamic 5 (PHP 8.2+) or Statamic 6
- PHP 8.2+

## Installation

```bash
composer require skynettechnologies/statamic-skyneta11y-pdf-remediation
```

Publish the public assets (CSS / JS / images) and, optionally, the config:

```bash
php artisan vendor:publish --tag="skynettechnologies/statamic-skyneta11y-pdf-remediation-assets"
php artisan vendor:publish --tag="skynettechnologies/statamic-skyneta11y-pdf-remediation-config"
```

Or copy the assets with the bundled command:

```bash
php please skynet-pdf-remediation:copy-assets
```

### Updating

The addon's browser assets are published into your site's `public/` folder, so a
later release does not overwrite them automatically. After updating, re-publish
with `--force` (or re-run the copy command):

```bash
php artisan vendor:publish --tag="skynettechnologies/statamic-skyneta11y-pdf-remediation-assets" --force
# or
php please skynet-pdf-remediation:copy-assets
```

## Usage

Open **Tools -> SkynetA11y PDF Remediation** in the Control Panel. The workspace has three tabs:

- **Upload** - drag and drop PDFs (up to 50 MB, unencrypted) and add them for AI remediation.
- **Website Scan** - crawl the connected domain for linked PDFs.
- **Remediated** - browse and download remediated PDFs.

The first time you upload a PDF or run a website scan, a short dialog asks for a name, email and domain. The name and email are pre-filled from the logged-in user and the domain defaults to the current site, so you usually just confirm. The account is provisioned only when you submit that dialog, and you are not asked again on that browser.

Access is gated by the **Access SkynetA11y PDF Remediation** permission, assignable under **Users -> Roles**.

## How It Works

1. **Add Your PDFs** – Upload files, or crawl your website for every PDF it links to.
2. **Run AI Remediation** – Select documents and process them in bulk; progress is reported live.
3. **Download** – Download the conformant files. Detailed per-check reports (plain-language explanations and before/after examples) are available on the hosted All in One Accessibility® dashboard.

## Who Can Benefit?

- Website Owners & Businesses
- Developers & Web Agencies
- Government & Public Sector Organizations
- Education, Healthcare & Financial Institutions
- Legal & Compliance Teams
- Publishers & Content Teams
- E-commerce & SaaS Platforms

## Configuration

`config/skynet-pdf-remediation.php` (after publishing):

| Key                 | Env                        | Default                                    |
| ------------------- | -------------------------- | ------------------------------------------ |
| `api_base`          | `SKYNET_PDF_API_BASE`      | `https://livepdfapi.skynettechnologies.us` |
| `provision_api_key` | `SKYNET_PDF_PROVISION_KEY` | `PDF-REMEDATION-PLAN-CHECK`                |
| `session_url`       | `SKYNET_PDF_SESSION_URL`   | *(empty)*                                  |
| `dashboard_url`     | `SKYNET_PDF_DASHBOARD_URL` | `https://ada.skynettechnologies.us`        |
| `plan_id`           | `SKYNET_PDF_PLAN_ID`       | `free`                                     |
| `country`           | `SKYNET_PDF_COUNTRY`       | `US`                                       |

These are injected into the dashboard as `window.AIOPDF_CONFIG`
(`apiBaseUrl`, `provisionApiKey`, `dashboardUrl`, `planId`, `country`, and
`sessionUrl` when set), together with `accountName` and `accountEmail` as
pre-fills for the details dialog.

### Keeping the API key off the page

`provision_api_key` is sent to the browser so the dashboard can provision an
account. This is acceptable behind the authenticated Control Panel, but if the
key must never leave your server, set `session_url` (env `SKYNET_PDF_SESSION_URL`)
to an endpoint on your own server. The dashboard then calls that endpoint for a
session token instead of calling the provisioning API with the key; your endpoint
performs the provisioning server-side and returns only the token. When
`session_url` is set, the key is not required on the page.

## Data & Privacy

This addon talks to the remediation service directly from the browser. When used,
the following is sent from the operator's browser to
`https://livepdfapi.skynettechnologies.us`:

- The **PDF files** you upload or that are found by the website scan.
- The **name, email and domain** entered in the details dialog (pre-filled from
  the logged-in user and the site), used to provision and identify the account.
- The **website domain** crawled by the Website Scan tab.

Documents and account data are processed and stored by Skynet Technologies to
perform remediation and to deliver the remediated files back to you over an
authenticated session; remediated files are not exposed through public links. For
what is collected, how long it is retained, and your choices, see:

- Privacy Policy: https://www.skynettechnologies.com/privacy-policy
- Terms of Service: https://www.skynettechnologies.com/terms-conditions

## CORS Policy Configuration

You do **not** need to change your own server's CORS settings — only the remediation API's CORS matters, and that is handled on the Skynet side. The only thing relevant on your side is your Content-Security-Policy (below).

| **Domain**                                 | **Description**                     | **Usage**                              |
| ------------------------------------------ | ----------------------------------- | -------------------------------------- |
| `https://livepdfapi.skynettechnologies.us` | SkynetA11y PDF Remediation API      | Documents, remediation jobs, downloads |
| `https://ada.skynettechnologies.us`        | All in One Accessibility® Dashboard | Plan upgrades via autologin            |

If your site sends a `Content-Security-Policy`, add both origins to `connect-src`, or the browser will block the dashboard's requests before they are made. No other change is needed on your side.

## Screenshots

![SkynetA11y_PDF_Accessibility_Remediation_Image_1](https://www.skynettechnologies.com/sites/default/files/SkynetA11yPDFRemediation/SkynetA11y-PDF-Remediation-Feature1.jpg)
![SkynetA11y_PDF_Accessibility_Remediation_Image_2](https://www.skynettechnologies.com/sites/default/files/SkynetA11yPDFRemediation/SkynetA11y-PDF-Remediation-Feature2.jpg)
![SkynetA11y_PDF_Accessibility_Remediation_Image_3](https://www.skynettechnologies.com/sites/default/files/SkynetA11yPDFRemediation/SkynetA11y-PDF-Remediation-Feature3.jpg)

## Submit a Support Request

Please visit our **[support page](https://www.skynettechnologies.com/report-accessibility-problem)** and fill out the form. Our team will get back to you as soon as possible.

## Send Us an Email

Alternatively, you can send an email to our support team: **[hello@skynettechnologies.com](mailto:hello@skynettechnologies.com)**

## Accessibility Partnership Opportunities

### [Accessibility Agency Partnership](https://www.skynettechnologies.com/agency-partners)

Partner with us as an agency to provide comprehensive accessibility solutions to your existing clients. Get access to exclusive resources, training, and support to help you implement and manage accessibility features effectively.

### [Accessibility Affiliate Partnership](https://www.skynettechnologies.com/affiliate-partner)

Join our affiliate program and earn hefty commissions by promoting SkynetA11y PDF Remediation. Share our accessibility solution within your network and help businesses improve their document accessibility while generating additional revenue.

For more details, please visit the **[Accessibility Partnership Opportunities Page](https://www.skynettechnologies.com/partner-program)**.

## Credits

This **SkynetA11y PDF Remediation** addon is developed and maintained by **[Skynet Technologies USA LLC](https://www.skynettechnologies.com)**.

# MAA Website Rebuild — Development Roadmap

Prepared: 14 November 2026  
Project: Mothers for Advocacy & Awareness — https://maausa.org/  
Companion document: [architecture.md](architecture.md)  
Status: Updated for a fresh build from scratch. No application, database connection, or production changes have been made.

Scope decision: No existing-site backups, WordPress database access, imports, legacy-table integration or data migration are required. The current site is only a reference for approved content, logo and photographs. Laravel schema migrations create the new application tables; they are not WordPress data migration.

## 1. Goal and delivery baseline

Build a new responsive Laravel website from scratch that makes support, programs, resources, events, and donations easy to find. Preserve MAA's original logo and genuine community photography. Build from the latest spacious homepage concept: transparent header over a photographic hero, plum palette, professional sans-serif typography, distinct lower-section layouts, and generous padding.

Recommended stack:

- Laravel 12 with PHP 8.2 compatibility.
- Fresh dedicated MySQL database, named `maausa` where that name is unused; otherwise use `maausa_new`.
- Blade for server-rendered pages, Tailwind CSS for styling, Alpine.js for local interactions, selective Livewire for server-driven interactions.
- Custom Laravel administration using the same frontend stack. Filament is not required for this plan.
- Material-inspired visual language and Material Symbols icons; not the React MUI component library.

### Runtime lifecycle decision

As checked on 14 November 2026, Laravel 11 security support ended on 12 March 2026. Laravel 12 supports PHP 8.2, but is now in security-only support until 24 February 2027. PHP 8.2 security support ends on 31 December 2026.

Use Laravel 12 to satisfy the requested compatibility baseline. Treat PHP 8.2 as a temporary compatibility target, not the long-term production runtime. Schedule a tested move to PHP 8.4 before 31 December 2026 and a supported Laravel release before 24 February 2027. Laravel 13 requires PHP 8.3 or higher. Recheck package compatibility before each upgrade. If launch falls after either deadline, upgrade before launch rather than deploying an unsupported baseline.

## 2. Release scope

| Area | First release |
| --- | --- |
| Public pages | Home, About, Programs listing/detail, Resources listing/detail, Events listing/detail, Gallery, Get Support, Get Involved, Donate, Contact, policy pages |
| Administration | Staff login, roles, pages and homepage sections, programs, resources, events, registrations, albums/media, inquiries, SEO/settings |
| Support | Short inquiry form, internal status tracking, acknowledgment and staff notification |
| Events | Upcoming/past listing, detail pages, optional registration with capacity control |
| Donations | Verified existing hosted donation link; no custom payment processing in phase one |
| Content setup | Manual entry of reviewed content and upload of selected original media through the new CMS |
| Excluded initially | Public accounts, discussion forum, clinical records, child document uploads, recurring payment engine, full bilingual publishing |

English is the initial publishing language. Keep templates translation-ready; add Bangla only with reviewed translations and an agreed maintenance owner. Do not label sample content as actual MAA events or approved resources.

## 3. Estimated schedule

Planning estimate: 6–8 working weeks for one full-time Laravel developer with part-time design/content support. This is an estimate, not a committed delivery date. Content readiness, feature complexity, and feedback affect duration. Runtime upgrades are calendar deadlines and may need to occur during the build.

| Phase | Estimate | Dependencies | Exit result |
| --- | --- | --- | --- |
| 0. Scope and content preparation | 1–2 days | Approved requirements and selected assets | Page list and fresh environment plan |
| 1. UI system and responsive design | 4–5 days | Content outline | Homepage and inner-page layouts |
| 2. Laravel foundation | 3–4 days | Runtime and fresh database setup | Local/staging app, authentication and CI |
| 3. Public frontend | 6–8 days | Design system and development fixtures | Responsive Blade templates and Alpine interactions |
| 4. CMS and dynamic workflows | 7–9 days | Models and admin foundation | Publishing, inquiries and event registration |
| 5. Content entry and integration | 2–3 days | Working CMS | Reviewed real content, media and mail configuration |
| 6. QA, accessibility and UAT | 4–5 days | Feature-complete staging | Accepted workflows and resolved release blockers |
| 7. Launch and handover | 2–3 days | UAT and production readiness | New application deployed and staff trained |

## 4. Phase-by-phase work

### Phase 0 — Scope and content preparation

- Confirm page list, programs, forms, event requirements and donation destination.
- Use the existing public site only as a visual/content reference; no database export or WordPress access is needed.
- Collect approved text, original logo, photographs, videos and publication permissions.
- Confirm hosting supports the planned runtime, MySQL, cron, queues, storage and HTTPS.
- Provision separate fresh local, staging and production databases and credentials.
- Use `maausa` only if it is a new unused database on that server. If occupied, create `maausa_new`; never clear or overwrite the existing database.

Exit: scope, content checklist and independent fresh environment ready.

### Phase 1 — UI design system

- Preserve the approved hero direction and transparent desktop header.
- Establish typography, spacing, colors, button variants, inputs, icon rules and image focal points.
- Design distinct structures: editorial introduction, program accordion, asymmetric community images, featured resource panel and spacious footer.
- Produce responsive Home, Program Detail, Resource Listing, Event Detail, Support Form and Admin Content Editor layouts.
- Specify focus, hover, disabled, loading, empty, error and success states.
- Review at 360, 390, 768, 1024 and 1440 CSS-pixel widths.

Exit: accepted responsive layouts; no overlapping text, cropped faces or inconsistent padding. Image mockups guide the implementation but are not exact pixel specifications.

### Phase 2 — Application foundation

- Create an isolated Git repository and environment-specific configuration.
- Resolve Laravel 12 and frontend packages against PHP 8.2; commit lockfiles and verify platform requirements in CI.
- Create separate local, staging and production configurations. Each environment uses its own new database; seed only development fixtures in local/staging.
- Configure one standard MySQL application connection as described in architecture.md; no legacy connection or table prefix is needed.
- Create standard Laravel migrations, models, relationships and seeders for the fresh schema.
- Add staff authentication, password reset, policies, roles and initial administrator provisioning through a secure process.
- Configure media disks, queue, scheduler, mail, logging and build pipeline.

Exit: authenticated staging app with successful schema migrations and a reproducible fresh schema.

### Phase 3 — Public frontend

- Build shared Blade layouts and reusable header, footer, buttons, cards, breadcrumbs, form fields and pagination.
- Render indexable content through Blade; include page metadata and canonical URLs.
- Use Alpine for mobile navigation, sticky header appearance, accordions and gallery dialogs.
- Keep hero image eager-loaded and responsive; lazy-load lower imagery and video embeds.
- Implement pages using fixtures first, then connect published CMS records.
- Keep navigation and ordinary pages server-rendered; no SPA conversion is required.

Exit: complete responsive frontend with working navigation and consistent visual tokens.

### Phase 4 — CMS and workflows

- Build role-restricted administration for content and operational records.
- Add draft/preview/publish controls, section ordering, approved section types and audit history.
- Add resource search/filter components with query-string state and server pagination.
- Add support/contact/volunteer forms with validation, consent, rate limiting and durable database storage.
- Add optional event registration with transactional capacity checks and duplicate prevention.
- Queue acknowledgment and notification emails after successful commits; monitor failures.
- Keep donations on a verified hosted provider page for release one.

Exit: content team can publish safely; support team can process inquiries; registrations cannot exceed capacity under concurrency.

### Phase 5 — Content entry and integration

- Enter reviewed About, program, resource, event and policy content through the new CMS.
- Upload selected original photographs; set alt text, captions and focal points.
- Sanitize authored rich text and validate uploads.
- Remove development fixtures and sample events from production publishing.
- Verify video URLs and donation destination; configure production mail separately from staging.
- Review page formatting, navigation, SEO fields and empty states.

Exit: complete reviewed content and working integrations. No importer, legacy ID mapping or source-count reconciliation is required.

### Phase 6 — QA and UAT

- Verify staff permissions, draft visibility, content publishing, form validation and operational statuses.
- Test duplicate submissions, failed notifications, closed/full events and concurrent last-seat registrations.
- Verify new page links, uploaded media, canonical tags, sitemap and useful 404s.
- Keyboard-test navigation, dialogs, forms and accordion controls; check contrast, labels and errors.
- Compare implemented homepage against the agreed layout at desktop and mobile widths.
- Measure representative page performance and fix oversized images, render-blocking assets and excessive queries.
- Test recovery procedures for the new Laravel application and ensure rollback preserves new submissions. Existing-site backup is outside this project scope.

Exit: no unresolved critical/high-severity defects; MAA representatives accept content and core workflows.

### Phase 7 — Launch and handover

1. Confirm supported production runtime, a dedicated fresh database and working mail/worker/scheduler.
2. Deploy the new Laravel release and compiled frontend assets.
3. Apply reviewed schema migrations to the new database; provision the administrator securely.
4. Publish approved content and upload media through the CMS. Do not run demo seeders in production.
5. Configure production secrets, storage, caches, queues and scheduled tasks.
6. After acceptance on staging, point the domain to the new deployment's `public` directory and enable HTTPS.
7. Verify production robots policy, canonical URLs and sitemap.
8. Smoke-test Home, support submission, staff login, event flow, media, donation link and mail.
9. Monitor failures and hand over the CMS guide, deployment documentation and upgrade schedule.

Recovery applies to the new application: retain known-good Laravel releases and protect new submissions. On a first-launch failure with no previous Laravel release, use a maintenance response while fixing or redeploying. This plan does not rely on WordPress backups or restoration. Set up routine database/media protection for the new production application once it contains real content and submissions.

## 5. Acceptance checklist

- [ ] Existing hero direction, actual MAA photography and logo retained.
- [ ] Section padding follows 96px desktop / 64px tablet / 48px mobile tokens.
- [ ] No horizontal overflow; menus and forms work at small mobile widths.
- [ ] Published content is server-rendered; drafts require authorized preview.
- [ ] Dedicated fresh database is configured without touching any existing database.
- [ ] Schema builds from Laravel migrations; production contains no demo content.
- [ ] Support inquiries persist even if email delivery fails.
- [ ] Event registration handles duplicates and capacity atomically.
- [ ] Donations route to the verified organization account.
- [ ] Staff permissions and sensitive inquiry access are tested.
- [ ] Navigation, sitemap, image assets and metadata work.
- [ ] Production runtime is supported at launch; upgrades have named ownership.
- [ ] New-application recovery and maintenance procedures are documented and tested.

## 6. Decisions needed during kickoff

These do not block using this plan; they must be resolved before the affected implementation starts.

| Decision | Default until confirmed |
| --- | --- |
| Fresh database name | `maausa` if unused; otherwise `maausa_new`; independent database per environment |
| Hosting/runtime upgrades | Laravel 12 compatibility; upgrade runtime before support expiry |
| Administration framework | Custom Blade/Livewire CMS |
| Donation integration | Existing verified hosted provider link |
| Event registrations | Free registrations; payments are separate scope |
| Event timezone | Store UTC; display explicit event timezone, default America/New_York subject to confirmation |
| Data retention and inquiry access | Restricted staff access; retention policy agreed before launch |
| Resource/event copy | Only reviewed real content; hide empty sections gracefully |

## 7. Sources

Checked 14 November 2026:

- Laravel release/support policy: https://laravel.com/docs/12.x/releases
- Laravel 13 requirements: https://laravel.com/docs/13.x/releases
- PHP supported versions: https://www.php.net/supported-versions.php
- Existing MAA website: https://maausa.org/

See architecture.md for technical structure, fresh database setup, routes and workflow contracts.

# Skills

## Skill: Add CRUD Endpoint

- Preconditions:
- Identify entity model and existing route namespace (`user` or `admin`).
- Confirm whether IDs are base64-encoded in current UI flow.
- Steps:
- Add/adjust route entries in `routes/web.php` with existing naming style.
- Add controller methods for index/create/store/edit/update/destroy as needed.
- Apply request validation using existing controller style.
- Wrap multi-step persistence in DB transaction.
- Return flash responses via `to_route(...)` or `back()->with(...)`.
- Update Blade list/form links to match route names and ID encoding style.
- Pitfalls in this repo:
- Route method/URL mismatches exist in some flows; avoid introducing new mismatch.
- Keep behavior-compatible with current flash and redirect expectations.
- Done checklist:
- Routes resolve.
- Form submit works.
- Edit/delete links work.
- Success/error flash appears.

## Skill: Add Dashboard Metric or Chart Data

- Preconditions:
- Confirm source model fields and date filter behavior.
- Confirm expected chart payload keys (`labels`, `prices`, optional `expenses`, `incomes`).
- Steps:
- Extend controller aggregation logic.
- Keep response shape stable for Blade/JS chart code.
- If date filtering is needed, use validated `start_date`/`end_date` flow.
- Update Blade chart bindings only if payload shape changes.
- Pitfalls in this repo:
- Existing chart code assumes category-based groupings.
- Keep sorting/grouping consistent to avoid label/data drift.
- Done checklist:
- Endpoint returns valid JSON/data.
- Chart renders without JS errors.
- Date-range filter still works.

## Skill: Add Notification Flow

- Preconditions:
- Decide channel: mail, database, or both.
- Confirm trigger location: controller, job, or command.
- Steps:
- Create/extend notification class (`via`, payload methods).
- For async workload, use queue job and optional command dispatch.
- Send notifications through notifiable user model.
- Wire unread notification display/update in navbar if needed.
- Pitfalls in this repo:
- Navbar read action uses AJAX POST and expects `notification_id`.
- Preserve existing unread badge behavior.
- Done checklist:
- Notification record/email generated as expected.
- Unread count updates correctly.
- Mark-as-read flow works.

## Skill: Add File Attachment Workflow

- Preconditions:
- Confirm accepted MIME list and storage target.
- Determine create/update/delete lifecycle requirements.
- Steps:
- Validate file input and MIME types.
- Store file consistently with existing naming approach.
- Persist attachment row and foreign key link.
- On replacement/deletion, clean old file and related attachment record safely.
- Wrap multi-step operations in transaction.
- Pitfalls in this repo:
- Existing code uses `public/invoices` file movement pattern.
- Ensure attachment null checks before delete/unlink.
- Done checklist:
- Upload works.
- Replace works.
- Delete cleans file and DB references.

## Skill: Add Invoice/PDF Flow

- Preconditions:
- Confirm invoice number strategy and bill linkage.
- Confirm output storage disk/path behavior.
- Steps:
- Create invoice record.
- Build QR payload.
- Render PDF from Blade template.
- Store file on `public` disk and persist `pdf_path`.
- Return consistent user feedback via flash response.
- Pitfalls in this repo:
- Current flow mixes generated invoice data and static placeholders; avoid breaking existing behavior.
- Keep storage path format compatible with current retrieval logic.
- Done checklist:
- Invoice row created.
- PDF generated and stored.
- `pdf_path` persisted.
- User sees success or safe error.

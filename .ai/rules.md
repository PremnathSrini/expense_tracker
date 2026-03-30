# Rules

- Goal: Keep patches minimal, safe, and aligned with existing repository patterns.
- Communication style: concise, direct, no speculative narration.
- Code comments: only when needed for non-obvious logic.

## Implementation Rules

- Reuse existing patterns before introducing new ones.
- Keep user/admin boundaries intact:
- User flow under `app/Http/Controllers/user` and user middleware.
- Admin flow under `app/Http/Controllers/admin` and admin middleware.
- Preserve existing route names and URL shapes unless task explicitly asks to change them.
- Preserve Blade layout strategy (`extends` + shared layout partials).
- Preserve flash response style (`to_route(...)`, `back()->with(...)`).

## Controller and Data Rules

- Validate all request input using existing style:
- `Validator::make(...)` for custom message-heavy flows.
- `$request->validate(...)` for simple request validation.
- For multi-step writes, use DB transaction boundaries.
- Keep error handling with rollback + log + user-safe flash response.
- Preserve currently expected payload formats from views/forms unless task explicitly changes them.

## Safety Rules

- No breaking schema changes without migration and compatibility note.
- No silent mass rename or folder restructuring.
- No broad refactor when a targeted fix is sufficient.
- Do not auto-correct known legacy quirks unless explicitly requested.

## Verification Rules

- Backend changes:
- Run `php artisan test` when feasible.
- If feature tests are missing, run relevant smoke checks and report test gap.
- Blade/JS changes:
- Validate page render and critical user actions.
- Confirm form submit path, success/error flash path, and delete confirmation path.

## Output Rules

- Always report:
- changed files.
- what changed.
- why it changed.
- validation performed.
- Keep final summary short and factual.

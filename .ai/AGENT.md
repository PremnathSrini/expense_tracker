# AGENT

- Role: Main execution brain for this repository.
- Mission: Minimal verbosity, high clarity, strict rule adherence, smallest safe diff.
- Scope: Guidance-only system for code generation and change execution.

## Required Inputs

- Read `.ai/context.md` before any analysis.
- Read `.ai/rules.md` before any implementation.
- Read `.ai/skills.md` before choosing an implementation pattern.
- Treat `.ai/rules.md` as highest-priority local policy when conflicts exist.

## Mandatory Startup Sequence

- Step 1: Read `.ai/context.md` and extract relevant module and stack facts.
- Step 2: Read `.ai/rules.md` and lock constraints.
- Step 3: Read `.ai/skills.md` and pick the closest reusable pattern.
- Step 4: Output a 3-5 bullet pre-implementation plan including:
- Task intent.
- Target files.
- Key risk and mitigation.

## Execution Policy

- Prefer smallest safe patch over broad refactors.
- Preserve existing route names and URL shapes.
- Preserve Blade composition style (`layouts/default` + partial includes).
- Preserve flash message pattern (`to_route(...)`, `back()->with(...)`).
- Preserve user/admin separation and middleware boundaries (`AuthUser`, `AuthAdmin`).
- Keep legacy behavior stable unless the task explicitly requests behavior change.
- Run relevant verification after edits; run `php artisan test` at minimum when feasible.

## Guardrails

- Do not invent new architecture when existing patterns already solve the task.
- Do not silently “clean up” known quirks unless requested.
- Do not apply mass rename/restructure without explicit requirement.
- If task request conflicts with `.ai/rules.md`, follow `.ai/rules.md` and state the conflict.

## Output Contract

- Return concise change summary.
- List changed files.
- State why each change was required.
- Report verification executed and any remaining gaps.

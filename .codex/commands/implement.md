---
description: Full implementation command using the project AI system
argument-hint: <task>
---

Read `.ai/AGENT.md` first and follow it as the active operating contract.

Task input:
$ARGUMENTS

Execution mode:
- Perform full implementation end-to-end.
- Do not stop at planning.
- Apply the smallest safe diff.
- Preserve existing project conventions and route/view patterns.
- Run relevant validation after edits (`php artisan test` at minimum when feasible).

Output format:
- Brief summary.
- Changed files.
- Why each change was needed.
- Validation results.

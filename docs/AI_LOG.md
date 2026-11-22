## AI Tools Used

ChatGPT: As a part-time student, I used ChatGPT to help me go through lectures and lab materials, understand topics I missed, and catch up with the course. It also helped me understand the milestone requirements, plan my project structure, review code and prepare documentation

GitHub Copilot (Agent Mode): I used GitHub Copilot in VS Code to help me organize and refactor my frontend code, separate HTML views from JavaScript, and improve the project structure

The main requests I used included:
1. Help me understand the Milestone 1 requirements for my CareerPath project.
2. Help me organize the frontend into separate HTML views and JavaScript files.
3. Review my SPA routing and explain how it works.
5. Help me write a README, AGENTS.md and AI_LOG for my project.

## Milestone 3

### Key prompts

```text
Complete the OpenAPI documentation for CareerPath Milestone 3 using the
attached Week 06 lab examples as the reference.

Inspect backend/index.php and every registered route in backend/rest/routes/.
Read the services and validation rules to confirm the real inputs, response
bodies and HTTP status codes.

Follow our Lab 6 structure in backend/public/v1/docs/:
- Put the API info, server definition and reusable schemas in doc_setup.php.
- Create one *Paths.php class per route file in paths/. Use one empty method
  per operation with PHP 8 attributes from OpenApi\Attributes, as in ClubPaths.php.
- Document all 80 CRUD operations for the 16 entities and GET /learning-videos.
  Check backend/index.php for any additional registered API endpoints.
- Use {id} for path parameters, document query parameters and JSON request
  bodies where applicable, and reuse schemas with $ref. Match the actual
  validation rules, response bodies and status codes.
- For GET /learning-videos, verify the rules for q and document the actual
  successful array response and the 400 and 503 error responses.
- Use the existing Swagger generator and its dynamic API base URL. Keep the
  work scoped to documentation files. Keep secrets out of examples and schemas.

Run PHP lint on the documentation files, generate the OpenAPI JSON, and
compare its HTTP method and path pairs against the registered API routes.
Report any missing or extra operations. Leave the changes uncommitted so
I can review them and test Swagger UI locally.
```

## AI Mistake 1 — Frontend Code Organization
What was wrong: As I initially implemented the frontend, the app.js file became too long over time, with too much HTML and JavaScript in one place. This made the code difficult to maintain

How I noticed it: As I continued developing the application, I noticed that the file was getting harder to read, understand, and navigate.

How I fixed it: I used GitHub Copilot to refactor the frontend code by separating the HTML pages into frontend/views/ and moving the routing logic into router.js. After refactoring, I tested the application to make sure the pages and navigation still worked
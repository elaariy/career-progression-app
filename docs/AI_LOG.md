## AI Tools Used

ChatGPT: As a part-time student, I used ChatGPT to help me go through lectures and lab materials, understand topics I missed, and catch up with the course. It also helped me understand the milestone requirements, plan my project structure, review code and prepare documentation

GitHub Copilot (Agent Mode): I used GitHub Copilot in VS Code to help me organize and refactor my frontend code, separate HTML views from JavaScript, and improve the project structure

The main requests I used included:
1. Help me understand the Milestone 1 requirements for my CareerPath project.
2. Help me organize the frontend into separate HTML views and JavaScript files.
3. Review my SPA routing and explain how it works.
5. Help me write a README, AGENTS.md and AI_LOG for my project.

## AI Mistake 1 — Frontend Code Organization
What was wrong: As I initially implemented the frontend, the app.js file became too long over time, with too much HTML and JavaScript in one place. This made the code difficult to maintain

How I noticed it: As I continued developing the application, I noticed that the file was getting harder to read, understand, and navigate.

How I fixed it: I used GitHub Copilot to refactor the frontend code by separating the HTML pages into frontend/views/ and moving the routing logic into router.js. After refactoring, I tested the application to make sure the pages and navigation still worked
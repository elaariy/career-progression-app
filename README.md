# CareerPath — Career Progression App

## Project Description

CareerPath is a web application designed for IT companies and their employees to manage and track professional development within an organization.The application aims to help employees monitor their career levels, develop technical and professional skills, set career goals, access learning resources, and track their progress toward career advancement.

It also provides IT companies with a structured way to manage employee career paths, define progression requirements, track professional development, and review employee requests for advancement.

**Milestone 1 status:** The project structure, responsive static frontend, and draft database ERD are prepared. The frontend is a vanilla HTML/CSS/JavaScript SPA using Bootstrap. git Demo interactions are frontend-only and do not persist data.

## Current Frontend

Implemented static pages:
- Dashboard
- Career Path
- Career Goals
- My Skills
- Learning Resources
- My Profile
- Log in and Register

The current forms are demonstrations only

## Database Plan
Entities shown in the ERD:
`roles`, `users`, `career_types`, `positions`, `levels`, `level_positions`, `skills`, `level_skills`, `user_skills`, `resources`, `user_resources`, `projects`, `project_users`, `goals`, `goal_updates`, `progression_requests`, `career_progressions`, and `progression_comments`.

The CareerPath database is designed to support employee career development and progression within IT companies.

Employees can belong to different career types, such as Frontend Development, Backend Development, Full-Stack Development, DevOps, Quality Assurance (QA), UI/UX Design, Data Science, Cybersecurity, System Administration, and Project Management.These career types are planned to be introduced and implemented in future milestones as the application's backend and database functionality are developed

Career paths are organized into positions and career levels (FR1–FR4), with specific skills required for each level and position. Employees can track their acquired skills, career goals, learning resources, and assigned projects.

Employees can also submit career progression requests to advance to a higher level. These requests can be reviewed by admin, while career progression records and comments track advancement history and feedback.

The ERD illustrates these relationships and serves as the database design for future milestones.

## Roles

The ERD includes a `roles` entity and a `users.role_id` reference, but role names and permissions have not been specified.

- Planned role names and permissions: Admin or User (Employee)

## External API

The Learning Resources page is the planned location for an external API feature that will provide learning resources. No API provider, endpoint, credentials, or integration is currently defined. The resources currently displayed are static demo content.

## Run the Frontend Locally

PHP is required to use its built-in development server. From the project root, run:

```sh
php -S 127.0.0.1:8000 -t frontend
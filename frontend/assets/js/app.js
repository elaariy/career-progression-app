import { initRouter } from "./router.js";

const app = document.getElementById("app");
const pageTitle = document.getElementById("page-title");
const navLinks = document.querySelectorAll("[data-page]");

const careerLevels = [
    {
        code: "FR1",
        name: "Frontend Engineer 1",
        status: "completed",
        skills: ["HTML fundamentals", "CSS fundamentals", "Git basics"]
    },
    {
        code: "FR2",
        name: "Frontend Engineer 2",
        status: "completed",
        skills: ["Responsive design", "JavaScript fundamentals", "Bootstrap"]
    },
    {
        code: "FR3",
        name: "Frontend Engineer 3",
        status: "active",
        skills: ["Advanced JavaScript", "API integration", "Testing"]
    },
    {
        code: "FR4",
        name: "Frontend Engineer 4",
        status: "locked",
        skills: [
            "Application architecture",
            "Performance optimization",
            "Mentoring"
        ]
    }
];

const completedSkills = [
    "HTML fundamentals",
    "CSS fundamentals",
    "Git basics",
    "Responsive design",
    "JavaScript fundamentals",
    "Bootstrap"
];

const profile = {
    firstName: "Arijela",
    lastName: "Dervisevic",
    email: "arijela.dervisevic@stu.ibu.edu.ba",
    role: "Backend Developer (FR3)",
    experience: "0 years",
    project: "No active project",
    initials: "AD",
    skills: ["HTML", "CSS", "JavaScript", "Bootstrap", "Git", "PHP"]
};

const goals = [
    {
        title: "Learn web development",
        description: "Build confidence with HTML, CSS, JavaScript, and PHP.",
        progress: 65,
        target: "December 2026",
        color: "progress-purple"
    },
    {
        title: "Strengthen communication",
        description: "Practice presenting ideas and collaborating with others.",
        progress: 40,
        target: "January 2027",
        color: "bg-success"
    }
];

const skills = [
    {
        name: "HTML & CSS",
        progress: 70,
        level: "Intermediate",
        color: "progress-purple"
    },
    {
        name: "JavaScript",
        progress: 40,
        level: "Beginner",
        color: "bg-success"
    },
    {
        name: "PHP",
        progress: 25,
        level: "Beginner",
        color: "bg-warning"
    },
    {
        name: "Communication",
        progress: 60,
        level: "Intermediate",
        color: "bg-info"
    }
];

const resources = [
    {
        category: "Development",
        badge: "resource-badge",
        title: "Learn Laravel With: Laracasts",
        description: "A new era of web development is here. Laravel, AI, agents... we gotcha!",
        url: "https://laracasts.com/path"
    },
    {
        category: "PHP",
        badge: "text-bg-success",
        title: "FlightPHP",
        description: "Learn FlightPHP from its official documentation.",
        url: "https://docs.flightphp.com/en/v3/"
    },
    {
        category: "Design",
        badge: "text-bg-warning",
        title: "Bootstrap Docs",
        description: "Learn responsive layouts and reusable interface components.",
        url: "https://getbootstrap.com/docs/"
    }
];

function getLevelBadge(status) {
    if (status === "completed") {
        return '<span class="badge text-bg-success">Completed</span>';
    }

    if (status === "active") {
        return '<span class="badge bg-primary">Active</span>';
    }

    return '<span class="badge text-bg-secondary">Locked</span>';
}

function getProgressBar(value, color, label = "Progress") {
    return `
        <div class="progress"
             role="progressbar"
             aria-label="${label}"
             aria-valuenow="${value}"
             aria-valuemin="0"
             aria-valuemax="100">
            <div class="progress-bar progress-${value} ${color}"></div>
        </div>
    `;
}

function getCareerLevelCards(showSkills = false) {
    return careerLevels.map((level) => {
        const isCurrent = level.status === "active";

        const skillsHTML = level.skills.map((skill) => {
            const isCompleted = completedSkills.includes(skill);

            return `
                <li class="d-flex align-items-start gap-2 mb-2">
                    <i class="bi ${
                        isCompleted
                            ? "bi-check-circle-fill text-success"
                            : "bi-circle text-secondary"
                    }"></i>
                    <span class="${isCompleted ? "" : "text-secondary"}">
                        ${skill}
                    </span>
                </li>
            `;
        }).join("");

        return `
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card rounded-4 shadow-sm h-100
                            career-level-card ${isCurrent ? "current-level" : ""}">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between
                                    align-items-start mb-2">
                            <h4 class="fw-bold mb-0 career-level-title">
                                ${level.code}
                            </h4>

                            ${isCurrent
                                ? '<i class="bi bi-star-fill current-level-icon"></i>'
                                : ""}
                        </div>

                        <p class="text-secondary small mb-3">
                            ${level.name}
                        </p>

                        ${getLevelBadge(level.status)}

                        ${isCurrent
                            ? `<p class="small fw-semibold mt-2 mb-0
                                        current-level-label">Current Level</p>`
                            : ""}

                        ${showSkills ? `
                            <hr class="my-3">
                            <p class="small fw-bold text-uppercase mb-3">
                                Skills
                            </p>
                            <ul class="list-unstyled small mb-0">
                                ${skillsHTML}
                            </ul>
                        ` : ""}
                    </div>
                </div>
            </div>
        `;
    }).join("");
}

function getGoalCards() {
    return goals.map((goal) => `
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">
                    <span class="badge text-bg-primary mb-3">
                        In progress
                    </span>

                    <h5 class="fw-bold">${goal.title}</h5>
                    <p class="text-secondary">${goal.description}</p>

                    <div class="d-flex justify-content-between small mb-2">
                        <span>Progress</span>
                        <span>${goal.progress}%</span>
                    </div>

                    <div class="mb-3">
                        ${getProgressBar(
                            goal.progress,
                            goal.color,
                            goal.title + " progress"
                        )}
                    </div>

                    <p class="small text-secondary mb-0">
                        Target: ${goal.target}
                    </p>
                </div>
            </div>
        </div>
    `).join("");
}

function getSkillCards() {
    return skills.map((skill) => `
        <div class="col-12 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold mb-0">${skill.name}</h5>
                        <span class="text-secondary">${skill.progress}%</span>
                    </div>

                    ${getProgressBar(
                        skill.progress,
                        skill.color,
                        skill.name + " progress"
                    )}

                    <p class="small text-secondary mt-3 mb-0">
                        Current level: ${skill.level}
                    </p>
                </div>
            </div>
        </div>
    `).join("");
}

function getResourceCards() {
    return resources.map((resource) => `
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">
                    <span class="badge mb-3 ${resource.badge}">
                        ${resource.category}
                    </span>

                    <h5 class="fw-bold">${resource.title}</h5>

                    <p class="text-secondary">
                        ${resource.description}
                    </p>

                    <a href="${resource.url}"
                       target="_blank"
                       rel="noopener noreferrer">
                        Explore resource ↗
                    </a>
                </div>
            </div>
        </div>
    `).join("");
}

function getProfileFields() {
    const fields = [
        ["First Name", profile.firstName],
        ["Last Name", profile.lastName],
        ["Email", profile.email],
        ["Current Role", profile.role],
        ["Experience", profile.experience],
        ["Active Project", profile.project]
    ];

    return fields.map(([label, value]) => `
        <div class="col-12 col-md-6">
            <p class="text-secondary small mb-1">${label}</p>
            <p class="fw-semibold mb-0 text-break">${value}</p>
        </div>
    `).join("");
}

function initializePage(currentPage) {
    if (currentPage === "dashboard") {
        document.getElementById("dashboard-career-levels").innerHTML =
            getCareerLevelCards();
        document.getElementById("dashboard-web-progress").innerHTML =
            getProgressBar(65, "progress-purple", "Web development goal progress");
        document.getElementById("dashboard-communication-progress").innerHTML =
            getProgressBar(40, "progress-green", "Communication goal progress");
    }

    if (currentPage === "career-path") {
        document.getElementById("career-levels").innerHTML =
            getCareerLevelCards(true);
        document.getElementById("request-progression-button")
            ?.addEventListener("click", showProgressionForm);
        document.getElementById("review-form")
            ?.addEventListener("submit", handleReviewSubmit);
    }

    if (currentPage === "goals") {
        document.getElementById("goals-list").innerHTML = getGoalCards();
        document.getElementById("add-goal-button")
            ?.addEventListener("click", showGoalForm);
    }

    if (currentPage === "skills") {
        document.getElementById("skills-list").innerHTML = getSkillCards();
    }

    if (currentPage === "resources") {
        document.getElementById("resources-list").innerHTML = getResourceCards();
    }

    if (currentPage === "profile") {
        document.getElementById("profile-fields").innerHTML = getProfileFields();
        document.getElementById("profile-initials").textContent = profile.initials;
        document.getElementById("profile-name").textContent =
            `${profile.firstName} ${profile.lastName}`;
        document.getElementById("profile-skills").innerHTML = profile.skills.map((skill) => `
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="rounded-3 p-3 text-center profile-skill">
                    <span class="fw-semibold">${skill}</span>
                </div>
            </div>
        `).join("");
    }

    document.getElementById("login-form")
        ?.addEventListener("submit", handleLoginSubmit);
    document.getElementById("register-form")
        ?.addEventListener("submit", handleRegisterSubmit);
}

function showProgressionForm() {
    const container = document.getElementById("progression-form-container");

    container.innerHTML = `
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">
                    Progression Request
                </h4>

                <form id="progression-form">
                    <div class="mb-3">
                        <label for="from-level" class="form-label">
                            From Level Position
                        </label>
                        <select id="from-level"
                                class="form-select"
                                required>
                            <option value="">
                                Choose starting level
                            </option>
                            <option value="FR1">
                                FR1 — Frontend Engineer 1
                            </option>
                            <option value="FR2">
                                FR2 — Frontend Engineer 2
                            </option>
                            <option value="FR3" selected>
                                FR3 — Frontend Engineer 3
                            </option>
                            <option value="FR4">
                                FR4 — Frontend Engineer 4
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="to-level" class="form-label">
                            To Level Position
                        </label>
                        <select id="to-level"
                                class="form-select"
                                required>
                            <option value="">
                                Choose target level
                            </option>
                            <option value="FR1">
                                FR1 — Frontend Engineer 1
                            </option>
                            <option value="FR2">
                                FR2 — Frontend Engineer 2
                            </option>
                            <option value="FR3">
                                FR3 — Frontend Engineer 3
                            </option>
                            <option value="FR4">
                                FR4 — Frontend Engineer 4
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="progression-reason"
                               class="form-label">
                            Reason
                        </label>
                        <textarea id="progression-reason"
                                  class="form-control"
                                  rows="4"
                                  required></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                                class="btn btn-primary">
                            Submit
                        </button>

                        <button type="button"
                                id="cancel-progression-button"
                                class="btn btn-outline-secondary">
                            Cancel
                        </button>
                    </div>

                    <p id="progression-message"
                       class="small mt-3 mb-0"
                       aria-live="polite"></p>
                </form>
            </div>
        </div>
    `;

    document.getElementById("progression-form")
        .addEventListener("submit", (event) => {
            event.preventDefault();

            const fromLevel = document.getElementById("from-level").value;
            const toLevel = document.getElementById("to-level").value;
            const message = document.getElementById("progression-message");

            if (fromLevel === toLevel) {
                message.className = "small mt-3 mb-0 text-danger";
                message.textContent =
                    "Please choose a different target level.";
                return;
            }

            message.className = "small mt-3 mb-0 text-secondary";
            message.textContent =
                "Demo only: progression requests will be saved in a later milestone.";
        });

    document.getElementById("cancel-progression-button")
        .addEventListener("click", () => {
            container.innerHTML = "";
        });
}

function handleReviewSubmit(event) {
    event.preventDefault();

    document.getElementById("review-message").textContent =
        "Demo only: comments will be saved in a later milestone.";
}

function showGoalForm() {
    const container = document.getElementById("goal-form-container");

    container.innerHTML = `
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">
                    Add a career goal
                </h3>

                <form id="new-goal-form">
                    <div class="mb-3">
                        <label for="goal-title" class="form-label">
                            Goal title
                        </label>
                        <input id="goal-title"
                               class="form-control"
                               placeholder="e.g. Learn SQL"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="goal-description"
                               class="form-label">
                            Description
                        </label>
                        <textarea id="goal-description"
                                  class="form-control"
                                  rows="2"
                                  placeholder="What do you want to achieve?"></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary"
                                type="submit">
                            Add goal
                        </button>

                        <button class="btn btn-outline-secondary"
                                id="cancel-goal-button"
                                type="button">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    document.getElementById("new-goal-form")
        .addEventListener("submit", (event) => {
            event.preventDefault();

            const title = document.getElementById("goal-title").value.trim();
            const description = document.getElementById("goal-description").value.trim();

            if (!title) return;

            const goalCard = document.createElement("div");
            goalCard.className = "col-12 col-lg-6";

            const card = document.createElement("div");
            card.className = "card border-0 rounded-4 shadow-sm h-100";

            const body = document.createElement("div");
            body.className = "card-body p-4";

            const badge = document.createElement("span");
            badge.className = "badge text-bg-secondary mb-3";
            badge.textContent = "New goal";

            const heading = document.createElement("h5");
            heading.className = "fw-bold";
            heading.textContent = title;

            const paragraph = document.createElement("p");
            paragraph.className = "text-secondary";
            paragraph.textContent = description || "No description added yet.";

            body.append(badge, heading, paragraph);
            card.append(body);
            goalCard.append(card);

            document.getElementById("goals-list").append(goalCard);

            container.innerHTML = "";
        });

    document.getElementById("cancel-goal-button")
        .addEventListener("click", () => {
            container.innerHTML = "";
        });
}

function handleLoginSubmit(event) {
    event.preventDefault();

    document.getElementById("login-message").textContent =
        "Authentication will be implemented with the backend in a later milestone.";
}

function handleRegisterSubmit(event) {
    event.preventDefault();

    document.getElementById("register-message").textContent =
        "Registration will be connected to the backend in a later milestone.";
}

document.getElementById("logout-button")
    ?.addEventListener("click", () => {
        window.location.hash = "#login";
    });

initRouter({ app, pageTitle, navLinks, onPageLoaded: initializePage });

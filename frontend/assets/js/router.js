const routes = {
    dashboard: { title: "Dashboard", view: "dashboard.html" },
    "career-path": { title: "Career Path", view: "career-path.html" },
    goals: { title: "Career Goals", view: "goals.html" },
    skills: { title: "My Skills", view: "skills.html" },
    resources: { title: "Learning Resources", view: "resources.html" },
    profile: { title: "My Profile", view: "profile.html" },
    login: { title: "Log in", view: "login.html" },
};

export function initRouter({ app, pageTitle, navLinks, onPageLoaded }) {
    let renderId = 0;

    async function renderPage() {
        const requestedPage = window.location.hash.slice(1) || "dashboard";
        const currentPage = routes[requestedPage] ? requestedPage : "dashboard";
        const route = routes[currentPage];
        const currentRenderId = ++renderId;

        const isAuthPage = currentPage === "login";
        document.body.classList.toggle("auth-page", isAuthPage);

        pageTitle.textContent = route.title;
        navLinks.forEach((link) => {
            link.classList.toggle("active", link.dataset.page === currentPage);
        });

        try {
            const viewUrl = new URL(`../../views/${route.view}`, import.meta.url);
            const response = await fetch(viewUrl);

            if (!response.ok) {
                throw new Error(`Could not load ${route.view}: ${response.status}`);
            }

            const view = await response.text();
            if (currentRenderId !== renderId) return;

            app.innerHTML = view;
            onPageLoaded(currentPage);
        } catch (error) {
            if (currentRenderId !== renderId) return;

            console.error(error);
            app.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    This page could not be loaded. Please try again.
                </div>
            `;
        }
    }

    window.addEventListener("hashchange", renderPage);
    renderPage();
}
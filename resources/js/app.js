import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Skill Progress Bar Animation on Scroll
    const skillProgressBars = document.querySelectorAll('.skill-progress');
    
    if (skillProgressBars.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const skillObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const level = progressBar.getAttribute('data-level');
                    progressBar.style.width = `${level}%`;
                    skillObserver.unobserve(progressBar);
                }
            });
        }, observerOptions);

        skillProgressBars.forEach(bar => {
            skillObserver.observe(bar);
        });
    }

    // 2. Project scroll reveal
    const projectRevealItems = document.querySelectorAll('.project-reveal');

    if (projectRevealItems.length > 0) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (prefersReducedMotion) {
            projectRevealItems.forEach(item => item.classList.add('is-visible'));
        } else {
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                rootMargin: '0px 0px -8% 0px',
                threshold: 0.12,
            });

            projectRevealItems.forEach(item => revealObserver.observe(item));
        }
    }

    // 3. Navigation Link Active Tracking on Scroll
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    if (sections.length > 0 && navLinks.length > 0) {
        window.addEventListener('scroll', () => {
            let currentSectionId = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    currentSectionId = section.getAttribute('id');
                }
            });

            if (currentSectionId) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${currentSectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }

    // 4. Alert Autofade
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});

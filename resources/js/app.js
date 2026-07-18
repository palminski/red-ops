import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

if ('serviceWorker' in navigator && !import.meta.env.DEV) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js');
    });
}

// Fake "loading" transition between page navigations: fade to black, cycle
// some hacker-ish status lines, then actually navigate. Laravel does a real
// full-page reload per link, so the outro (here) and the intro (on the next
// page's own copy of this script) are stitched together via a sessionStorage
// flag rather than being one continuous animation.
(function () {
    const overlay = document.getElementById('page-transition');
    const textEl = document.getElementById('page-transition-text');
    if (!overlay || !textEl) return;

    const OUTRO_MS = 650;
    const INTRO_MS = 380;
    const LINES = [
        'ESTABLISHING SECURE LINK...',
        'BYPASSING FIREWALL...',
        'DECRYPTING PAYLOAD...',
        'REROUTING TRAFFIC...',
        'INJECTING PACKET...',
        'ACCESS GRANTED',
    ];

    function runHackerText(duration) {
        let i = 0;
        textEl.textContent = LINES[0];
        const interval = setInterval(() => {
            i = (i + 1) % LINES.length;
            textEl.textContent = LINES[i] + (Math.random() > 0.5 ? ' _' : '');
        }, 160);
        setTimeout(() => clearInterval(interval), duration);
    }

    function playIntro() {
        if (!document.documentElement.classList.contains('pt-active')) return;
        runHackerText(INTRO_MS);
        setTimeout(() => {
            document.documentElement.classList.remove('pt-active');
        }, INTRO_MS);
    }

    document.addEventListener('DOMContentLoaded', playIntro);
    window.addEventListener('pageshow', (e) => {
        if (e.persisted) playIntro();
    });

    document.addEventListener('click', (e) => {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        const link = e.target.closest('a[href]');
        if (!link || link.target === '_blank' || link.hasAttribute('download')) return;

        let url;
        try {
            url = new URL(link.href, window.location.href);
        } catch (err) {
            return;
        }
        if (url.origin !== window.location.origin) return;
        // Pure in-page anchor jump — nothing actually navigates, skip the transition.
        if (url.hash && url.pathname === window.location.pathname && url.search === window.location.search) return;

        e.preventDefault();
        document.documentElement.classList.add('pt-active');
        runHackerText(OUTRO_MS);
        sessionStorage.setItem('pt-intro', '1');
        setTimeout(() => {
            window.location.href = link.href;
        }, OUTRO_MS);
    });
})();

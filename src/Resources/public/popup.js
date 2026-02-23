(function () {
  function getCookie(name) {
    const key = encodeURIComponent(name) + "=";
    const parts = document.cookie.split("; ").filter(Boolean);
    for (const p of parts) {
      if (p.startsWith(key)) return decodeURIComponent(p.slice(key.length));
    }
    return null;
  }

  function setCookie(name, value, days) {
    const d = Math.max(0, parseInt(days || 0, 10));
    const maxAge = d * 86400;
    document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}; Max-Age=${maxAge}; Path=/; SameSite=Lax`;
  }

  function supportsDialog(dialog) {
    return (
      dialog &&
      typeof dialog.showModal === "function" &&
      typeof dialog.close === "function"
    );
  }

  function open(dialog) {
    if (supportsDialog(dialog)) {
      if (!dialog.open) dialog.showModal();
    } else {
      dialog.setAttribute("open", "open");
      dialog.classList.add("is-open");
    }
  }

  function close(dialog) {
    if (supportsDialog(dialog)) {
      if (dialog.open) dialog.close();
    } else {
      dialog.removeAttribute("open");
      dialog.classList.remove("is-open");
    }
  }

  function init(dialog) {
    const delay = parseInt(dialog.getAttribute("data-delay") || "0", 10);
    const cookieName = dialog.getAttribute("data-cookie") || "ml_popup_seen";
    const cookieDays = parseInt(
      dialog.getAttribute("data-cookie-days") || "30",
      10,
    );

    if (getCookie(cookieName)) return;

    const markSeenAndClose = () => {
      close(dialog);
      setCookie(cookieName, "1", cookieDays);
    };

    const closeBtn = dialog.querySelector("[data-ml-popup-close]");
    if (closeBtn) closeBtn.addEventListener("click", markSeenAndClose);

    // Klick auf Backdrop (nur wenn direkt <dialog> getroffen)
    dialog.addEventListener("click", (ev) => {
      if (ev.target === dialog) markSeenAndClose();
    });

    // ESC (Fallback; native dialog macht es teils selbst)
    dialog.addEventListener("keydown", (ev) => {
      if (ev.key === "Escape") {
        ev.preventDefault();
        markSeenAndClose();
      }
    });

    window.setTimeout(() => open(dialog), Math.max(0, delay) * 1000);
  }

  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-ml-popup]").forEach(init);
  });
})();

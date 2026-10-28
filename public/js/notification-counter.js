/**
 * Système de compteur de notifications en temps réel
 * Met à jour le badge de notifications non lues dans la navbar
 */

/**
 * Met à jour le compteur de notifications non lues
 */
const updateNotificationBadge = () => {
    fetch('/notifications/unread-count')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count > 9 ? '9+' : data.count;
                    badge.style.display = 'block';
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération du compteur de notifications:', error);
        });
};

/**
 * Initialise le système de notifications
 */
const initNotificationCounter = () => {
    // Mettre à jour le compteur au chargement
    updateNotificationBadge();

    // Mettre à jour le compteur toutes les 30 secondes
    setInterval(updateNotificationBadge, 30000);

    // Mettre à jour le compteur après chaque action utilisateur
    document.addEventListener('click', (event) => {
        // Si l'utilisateur clique sur le bouton de marquer comme lu
        if (event.target.closest('form[action*="notifications"]')) {
            setTimeout(updateNotificationBadge, 500);
        }
    });
};

// Initialiser au chargement du DOM
document.addEventListener('DOMContentLoaded', initNotificationCounter);

/**
 * Système de notifications SweetAlert2 centralisé
 * Gère tous les types de notifications (succès, erreur, avertissement, confirmation)
 */

// Configuration par défaut pour SweetAlert2
const defaultSwalConfig = {
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
        denyButton: 'btn btn-warning',
    },
    showClass: {
        popup: 'animate__animated animate__fadeInDown',
        icon: 'animate__animated animate__heartBeat'
    },
    hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
    }
};

/**
 * Affiche une notification de succès
 * @param {string} title - Titre de la notification
 * @param {string} message - Message détaillé (optionnel)
 * @param {number} timer - Durée d'affichage en ms (null pour affichage permanent)
 */
const showSuccess = (title, message = '', timer = 3000) => {
    const config = {
        ...defaultSwalConfig,
        icon: 'success',
        title: title,
        text: message,
        timer: timer,
        timerProgressBar: timer !== null,
        toast: true,
        position: 'top-end',
        showConfirmButton: timer === null,
    };

    return Swal.fire(config);
};

/**
 * Affiche une notification d'erreur
 * @param {string} title - Titre de l'erreur
 * @param {string} message - Message détaillé (optionnel)
 * @param {number} timer - Durée d'affichage en ms (null pour affichage permanent)
 */
const showError = (title, message = '', timer = 5000) => {
    const config = {
        ...defaultSwalConfig,
        icon: 'error',
        title: title,
        text: message,
        timer: timer,
        timerProgressBar: timer !== null,
        toast: true,
        position: 'top-end',
        showConfirmButton: timer === null,
    };

    return Swal.fire(config);
};

/**
 * Affiche un avertissement
 * @param {string} title - Titre de l'avertissement
 * @param {string} message - Message détaillé (optionnel)
 * @param {number} timer - Durée d'affichage en ms (null pour affichage permanent)
 */
const showWarning = (title, message = '', timer = 4000) => {
    const config = {
        ...defaultSwalConfig,
        icon: 'warning',
        title: title,
        text: message,
        timer: timer,
        timerProgressBar: timer !== null,
        toast: true,
        position: 'top-end',
        showConfirmButton: timer === null,
    };

    return Swal.fire(config);
};

/**
 * Affiche une notification d'information
 * @param {string} title - Titre de l'information
 * @param {string} message - Message détaillé (optionnel)
 * @param {number} timer - Durée d'affichage en ms (null pour affichage permanent)
 */
const showInfo = (title, message = '', timer = 3000) => {
    const config = {
        ...defaultSwalConfig,
        icon: 'info',
        title: title,
        text: message,
        timer: timer,
        timerProgressBar: timer !== null,
        toast: true,
        position: 'top-end',
        showConfirmButton: timer === null,
    };

    return Swal.fire(config);
};

/**
 * Affiche une boîte de confirmation
 * @param {string} title - Titre de la confirmation
 * @param {string} message - Message détaillé
 * @param {string} confirmText - Texte du bouton de confirmation
 * @param {string} cancelText - Texte du bouton d'annulation
 * @returns {Promise<boolean>} - true si confirmé, false sinon
 */
const showConfirm = async (title, message, confirmText = 'Confirmer', cancelText = 'Annuler') => {
    const result = await Swal.fire({
        ...defaultSwalConfig,
        icon: 'question',
        title: title,
        text: message,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: '#17324D',
        cancelButtonColor: '#dc3545',
        reverseButtons: true,
    });

    return result.isConfirmed;
};

/**
 * Affiche les erreurs de validation d'un formulaire
 * @param {Object} errors - Objet des erreurs de validation
 */
const showValidationErrors = (errors) => {
    const errorMessages = Object.values(errors).flat();
    const message = errorMessages.join('\n');

    showError('Erreurs de validation', message, null);
};

/**
 * Affiche les notifications de session Laravel (success, error, message)
 */
const showSessionNotifications = () => {
    // Récupérer les données de session depuis les balises meta ou depuis le DOM
    const successMessage = document.querySelector('meta[name="session-success"]')?.content;
    const errorMessage = document.querySelector('meta[name="session-error"]')?.content;
    const warningMessage = document.querySelector('meta[name="session-warning"]')?.content;
    const infoMessage = document.querySelector('meta[name="session-info"]')?.content;

    if (successMessage) {
        showSuccess('Succès', successMessage);
    }

    if (errorMessage) {
        showError('Erreur', errorMessage);
    }

    if (warningMessage) {
        showWarning('Attention', warningMessage);
    }

    if (infoMessage) {
        showInfo('Information', infoMessage);
    }
};

/**
 * Initialise le système de notifications au chargement de la page
 */
const initNotifications = () => {
    // Attendre que SweetAlert2 soit chargé
    if (typeof Swal !== 'undefined') {
        showSessionNotifications();
    } else {
        console.error('SweetAlert2 n\'est pas chargé');
    }
};

// Exporter les fonctions pour une utilisation globale
window.showSuccess = showSuccess;
window.showError = showError;
window.showWarning = showWarning;
window.showInfo = showInfo;
window.showConfirm = showConfirm;
window.showValidationErrors = showValidationErrors;
window.initNotifications = initNotifications;

// Initialiser automatiquement au chargement du DOM
document.addEventListener('DOMContentLoaded', initNotifications);

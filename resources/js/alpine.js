import Alpine from 'alpinejs';
import otpComponent from './components/input/otp';

// Registo do componente
Alpine.data('otpComponent', otpComponent);

// Expor para Debugging no Browser
window.Alpine = Alpine;

// Iniciar Alpine
Alpine.start();

import Alpine from 'alpinejs';
import otpComponent from './components/input/otp';
import comboboxComponent from './components/input/combobox';
import autocompleteComponent from './components/input/autocomplete';
import passwordStrengthComponent from './components/input/password-strength';

Alpine.data('otpComponent', otpComponent);
Alpine.data('comboboxComponent', comboboxComponent);
Alpine.data('autocompleteComponent', autocompleteComponent);
Alpine.data('passwordStrength', passwordStrengthComponent);

window.Alpine = Alpine;

Alpine.start();

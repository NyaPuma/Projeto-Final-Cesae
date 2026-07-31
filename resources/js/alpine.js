import Alpine from 'alpinejs';
import otpComponent from './components/input/otp';
import comboboxComponent from './components/input/combobox';
import autocompleteComponent from './components/input/autocomplete';

Alpine.data('otpComponent', otpComponent);
Alpine.data('comboboxComponent', comboboxComponent);
Alpine.data('autocompleteComponent', autocompleteComponent);

window.Alpine = Alpine;

Alpine.start();

import { bindFileUploadLabel } from './ticket-create/file-upload.js';
import { bindTicketCreateForm } from './ticket-create/form.js';
import { bindPrioritySelection } from './ticket-create/priority.js';
import { initAutocomplete } from './ticket-create/autocomplete.js';

function init() {
    bindTicketCreateForm();
    bindPrioritySelection();
    bindFileUploadLabel();
    initAutocomplete();
}

export { init };

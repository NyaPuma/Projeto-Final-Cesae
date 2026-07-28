import { bindFileUploadLabel } from './ticket-create/file-upload.js';
import { bindTicketCreateForm } from './ticket-create/form.js';
import { bindPrioritySelection } from './ticket-create/priority.js';

function init() {
    bindTicketCreateForm();
    bindPrioritySelection();
    bindFileUploadLabel();
}

export { init };

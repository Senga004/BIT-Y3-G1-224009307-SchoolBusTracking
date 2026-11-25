// Native browser validation is enabled on all forms. This file provides a small confirmation for destructive actions.
document.querySelectorAll('form[onsubmit]').forEach(form=>form.addEventListener('submit',event=>{if(!confirm('Are you sure you want to continue?'))event.preventDefault();}));

// This may also be shorthand for $( document ).ready()
// https://learn.jquery.com/using-jquery-core/document-ready/
;( function( utilities, $, window, document, axios, undefined ) {

    // This allows for javascript that should work pretty consistently across browsers and platforms.
    'use strict';

    const userIsDeceasedSelect = document.querySelector('#userIsDeceased');

    if (userIsDeceasedSelect) {
        userIsDeceasedSelect.addEventListener('change', (event) => {
            // hide and clear the box
            const deceasedSomeoneElseDiv = document.querySelector('.demographics-someone-else-name');
            deceasedSomeoneElseDiv.classList.add('d-none');

            if (event.target.value == '0') {
                deceasedSomeoneElseDiv.classList.remove('d-none');
            }
        });
    }

// confirms whether the user is sure if they want to complete the given action
} )( window.utilities = window.utilities || {},
    window.jQuery,
    window,
    document,
    window.axios
  );

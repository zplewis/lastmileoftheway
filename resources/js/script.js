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

    // When going through the guide, add the code that highlights the selected service type
    const serviceTypeSelectors = document.querySelectorAll('.service-type-selector input[type="radio"]');

    // Listener function that responds to the radio button click
    function serviceTypeSelectorListener() {
        // Reset all card-headers
        const cards = document.querySelectorAll('.service-type-selector .card');

        for (let card of cards) {
            // Reset the card-header
            const cardHeader = card.querySelector('.card-header');

            // Is there a selected radio button? If so, then set the card header class differently
            const selectedButton = card.querySelector('input[type="radio"]:checked');

            // Button text
            const radioLabel = card.querySelector('label');

            if (radioLabel) {
                radioLabel.textContent = 'Select this service';
            }

            let newClass = 'card-header py-3';
            if (selectedButton) {
                newClass += ' text-white bg-primary border-primary';

                if (radioLabel) {
                    radioLabel.textContent = 'Service selected';
                }
            }

            cardHeader.className = newClass;
        }
    }

    if (serviceTypeSelectors) {
        for (let i = 0; i < serviceTypeSelectors.length; i++) {
            serviceTypeSelectors[i].addEventListener('change', serviceTypeSelectorListener);
        }
    }

    const songTypes = document.querySelectorAll('select[id^="songType"]');

    function songTypeSelectorListener() {
        // Clear the next-page hidden input
        const nextPage = document.getElementById('next-page');
        const guideForm = document.getElementById('guide-form');

        if (nextPage) {
            nextPage.value = null;
        }

        if (guideForm) {
            guideForm.submit();
        }
    }

    if (songTypes) {
        for (let songType of songTypes) {
            songType.addEventListener('change', songTypeSelectorListener);
        }
    }

    const requestApptInput = document.getElementById('request-appt');

    if (requestApptInput) {
        requestApptInput.addEventListener('change', function(event) {
            const apptTypeDiv = document.getElementById('div-appointment-type');
            const contactApptType = document.getElementById('contactApptType');

            // Default to invisible
            let className = event.target.checked ? 'col-12' : 'col-12 d-none';
            apptTypeDiv.className = className;

            if (!event.target.checked) {
                // The empty string is different from null as a value
                contactApptType.value = '';
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

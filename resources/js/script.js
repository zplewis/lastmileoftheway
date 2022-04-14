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
            const deceasedPreferredNameLabel = document.querySelector('label[for="deceasedPreferredName"]');
            const deceasedIsSelf = event.target.options[event.target.selectedIndex].text.indexOf('self') !== -1;

            // Hide this div by default
            deceasedSomeoneElseDiv.classList.add('d-none');

            if (deceasedPreferredNameLabel) {
                deceasedPreferredNameLabel.textContent = 'Preferred Name';
            }

            // Get the text of the selected index. If the text does NOT include the word "self,"
            // then show the other fields
            if (!deceasedIsSelf) {
                deceasedSomeoneElseDiv.classList.remove('d-none');
                if (deceasedPreferredNameLabel) {
                    deceasedPreferredNameLabel.textContent = 'Deceased Preferred Name';
                }
            }

            // Set the hidden deceased first and last name fields to required if applicable
            deceasedSomeoneElseDiv.querySelectorAll('input').forEach((element) => {
                console.log('deceasedIsSelf: ' + deceasedIsSelf);
                element.required = !deceasedIsSelf;
            });

            console.log('userIsDeceased select changed');
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

            // The form for the current question
            const guideForm = document.getElementById('guide-form');

            // Hidden input that determines whether the guide advances forward or stays on the
            // current page on submit
            const nextPage = document.getElementById('next-page');

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

            // Go ahead and select the service, which should change the left-hand side automatically
            if (selectedButton && guideForm) {
                // Make the form refresh the page instead of move forward so the user can select
                // the service and see how the items on the left-hand side change
                if (nextPage) {
                    nextPage.value = '';
                }

                guideForm.submit();
            }
        }
    }

    if (serviceTypeSelectors) {
        for (let i = 0; i < serviceTypeSelectors.length; i++) {
            serviceTypeSelectors[i].addEventListener('change', serviceTypeSelectorListener);

            // Set custom browser accessible meessages that appear in Chrome/Brave
            serviceTypeSelectors[i].setCustomValidity('Please select a service to continue.');
        }
    }

    const songSelects = document.querySelectorAll('select[id^="song"]');

    // Used to submit current inputs to the session and refresh the page without advancing forward.
    function submitAndRefresh() {

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

    // We submit and refresh so that the selected song is saved; yes, it is possible to set the src
    // property of the iframe without refreshing, but then the user would have to click save &
    // continue to save their selection
    if (songSelects) {
        for (let songSelect of songSelects) {
            songSelect.addEventListener('change', submitAndRefresh);
        }
    }

    // Save and load the selected scripture upon selection
    const scriptureSelects = document.querySelectorAll('select[id$="TestamentReading"]');

    if (scriptureSelects) {
        for (let scriptureSelect of scriptureSelects) {
            scriptureSelect.addEventListener('change', submitAndRefresh);
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

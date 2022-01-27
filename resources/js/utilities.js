;( function( utilities, $, window, document, axios, undefined ) {

    // This allows for javascript that should work pretty consistently across browsers and platforms.
    'use strict';

    // Register the CSRF token as a common header for jQuery and Axios so that
    // all outgoing HTTP AJAX requests automatically have it attached.
    // This is just a simple convenience so that we don't have to attach every
    // token manually.
    var token = document.head.querySelector( 'meta[name="csrf-token"]' );

    if ( token ) {
        // https://github.com/axios/axios
        if ( axios ) {
            window.axios.defaults.headers.common[ 'X-CSRF-TOKEN' ] = token.content;
        }
        // jQuery
        if ( $ ) {
            // https://api.jquery.com/jquery.ajaxprefilter/
            $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
                jqXHR.setRequestHeader( 'X-CSRF-Token', token );
            });
        }
    }

    // polyfill for NodeList.prototype.forEach()
    // https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach
    if ( window.NodeList && !NodeList.prototype.forEach ) {
        NodeList.prototype.forEach = function( callback, thisArg ) {
            thisArg = thisArg || window;
            for ( var i = 0; i < this.length; i++ ) {
                callback.call( thisArg, this[ i ], i, this );
            }
        };
    }

    // polyfill for String.prototype.padStart()
    // https://github.com/uxitten/polyfill/blob/master/string.polyfill.js
    // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/padStart
    if ( !String.prototype.padStart ) {
        String.prototype.padStart = function padStart( targetLength, padString ) {

            // truncate if number or convert non-number to 0;
            targetLength = targetLength >> 0;
            padString = String( ( typeof padString !== 'undefined' ? padString : ' ' ) );
            if ( this.length > targetLength ) {
                return String( this );
            }

            targetLength = targetLength - this.length;
            if ( targetLength > padString.length ) {

                //append to original to ensure we are longer than needed
                padString += padString.repeat( targetLength / padString.length );
            }
            return padString.slice( 0, targetLength ) + String( this );
        };
    }

    /**
     * Returns the string representation of the object type.
     * @param obj object
     * @return string
     * I think this came from jQuery's library.
     */
    utilities.class2Type = function( obj ) {

        // if null or undefined, return an empty string for the type
        if ( obj === null || obj === undefined ) {
            return '';
        }
        var type = typeof obj;
        if ( typeof obj !== 'object' && typeof obj !== 'function' ) {
            return type;
        }
        return type.replace( /\[object /, '' ).replace( /\]/, '' ).toLowerCase();
    };

    /**
     * Returns true if an object is undefined, an empty string, or null.
     * @param x An object.
     * @return bool
     */
    utilities.isNullOrEmpty = function( x ) {

        return x === undefined || x === '' || x === null;
    };

    /**
     * Returns true if an object is undefined, an empty string, null, or a string with
     * empty space. Inspired by C#.
     * @param x An object.
     * @return bool
     */
    utilities.isNullOrEmptySpace = function( x ) {

        return utilities.isNullOrEmpty( x ) ||
        typeof x.trim === 'function' &&
        utilities.isNullOrEmpty( x.trim().replace( / /g, '' ) );
    };

    /**
     * Returns true if the specified property exists in the specified object.
     * @param obj An object.
     * @param prop A property name, property has to be a string.
     * @return bool
     */
    utilities.hasProperty = function( obj, prop ) {

        return utilities.isNullOrEmpty( obj ) === false &&
        utilities.isNullOrEmptySpace( prop ) === false &&
        (
            Object.prototype.hasOwnProperty.call( obj, prop ) ||
            obj.hasOwnProperty( prop ) ||
            obj.prop !== undefined ||
            'undefined' !== typeof obj[ prop ]
        );
    };

    /**
     * Returns true if the specified object has no properties.
     * @param obj An object.
     * @return bool
     */
    utilities.isEmptyObject = function( obj ) {

        // empty objects have no properties
        if ( obj === null || obj === undefined ) {
            console.log( 'isEmptyObject(): object is null or undefined.' );
            return true;
        }

        // ECMAScript5 method of counting properties
        if ( Object && utilities.hasProperty( Object, 'getOwnPropertyNames' ) ) {
            var length = Object.getOwnPropertyNames( obj ).length;
            console.log( 'isEmptyObject(): getOwnPropertyNames revealed ' +
            length + ' properties in this object.' );
            return Object.getOwnPropertyNames( obj ).length === 0;
        }

        if ( obj.length > 0 ) {
            console.log( 'isEmptyObject(): object has a length property greater than 0' );
            return false;
        }

        for ( var key in obj ) {
            if ( hasOwnProperty.call( obj, key ) ) {
                console.log( 'isEmptyObject(): hasOwnProperty found at least one property.' );
                return false;
            }
        }

        // default value
        console.log( 'isEmptyObject(): failed to prove at least one property exists.' );
        return true;
    };

    // Slightly more concise and improved version based on http://www.jquery4u.com/snippets/url-parameters-jquery/
    // from https://gist.github.com/1771618
    // apparently, 'unescape' is now deprecated for security reasons.
    // it will be used as a fall back instead of the primary way to get an answer.
    // window.location.search gets you the query string of the current URL
    utilities.getUrlVar = function( key ) {
        var queryString = utilities.getQueryString();

        // empty cases
        if ( utilities.isNullOrEmptySpace( key ) ||
        utilities.isNullOrEmptySpace( queryString ) ) {
            return '';
        }

        var result = new RegExp( key + '=([^&]*)', 'i' ).exec( queryString );
        return result && decodeURIComponent( result[ 1 ] ) || '';
    };

    /**
     * Retrieves the query string from the address bar.
     * @return {[type]} [description]
     */
    utilities.getQueryString = function() {
        return !utilities.isNullOrEmpty( window ) &&
        !utilities.isNullOrEmpty( window.location ) &&
        !utilities.isNullOrEmptySpace( window.location.search ) ?
        window.location.search :
        '';
    };

    /**
    * Returns True if the "test" url parameter exists and is non-empty.
    */
    utilities.debugMode = function() {

         return !utilities.isNullOrEmptySpace( utilities.getUrlVar( 'test' ) );

    };

    /**
     * Finds the nearest ancestor Node element with the specified tag and/or
     * class. Probably could be done better with jQuery but it's fine.
     * @param  {[type]} obj       [description]
     * @param  {[type]} tag       [description]
     * @param  {[type]} className [description]
     * @return {[type]}           [description]
     */
    utilities.findParent = function( child, tag, className ) {

        var hasTag = utilities.isNullOrEmptySpace( tag ) === false;
        var hasClassName = utilities.isNullOrEmptySpace( className ) === false;

        // empty case: missing child or both tag and className
        if ( utilities.isNullOrEmptySpace( child ) ||
        ( hasTag === false && hasClassName === false ) ) {
            utilities.log( 'findParent(); missing child or both tag and className' );
            return null;
        }

        while ( child.parentNode ) {

            // make the parent the child
            child = child.parentNode;

            var sameTag = hasTag === false ||
            ( utilities.isNullOrEmptySpace( child.tagName ) === false &&
            child.tagName.toLowerCase() === ( tag + '' ).toLowerCase() );
            var sameClassName = hasClassName === false ||
            ( child.classList.contains( className ) );

            if ( sameTag === true && sameClassName === true ) {
                return child;
            }
        } // end of while loop

        return null;
    };

    /**
     * Logs to whatever console is available if debugMode = true. However, if an
     * error occurs, that is logged event if debug mode is not enabled (?test=1).
     * @param  {[string|object|array]} text  [description]
     * @param  {[type]} error [description]
     * @return {[type]}       [description]
     */
    utilities.log = function( text, error ) {

        // empty case
        if ( utilities.isNullOrEmptySpace( text ) ||
        ( utilities.debugMode() === false && error !== true ) ) {
            return '';
        }

        // 2015.03.04 - if the parameter is not a string, then break down what it is
        // if ( !isValidStringObject( text ) ) { text = JSON.stringify( text ); }

        if ( window.console ) {

            if ( error === true && window.console.error ) {
              window.console.error( text );
            } else if ( window.console.log ) {
              window.console.log( text );
            }

        } else if ( document.console ) {

            if ( error === true && document.console.error ) {
              document.console.error( text );
            } else if ( document.console.log ) {
              document.console.log( text );
            }

        }
    };

    /**
     * Return a function, that, as long as it continues to be invoked, will
     not be triggered. The function will be called after it stops being
     called for `wait` milliseconds. If `immediate` is passed, trigger the
     function on the leading edge, instead of the trailing.
     * @param  {[type]} func      [description]
     * @param  {[int]} wait      [description]
     * @param  {[boolean]} immediate [description]
     * @return {[type]}           [description]
     * @link https://john-dugan.com/javascript-debounce/
     * @link https://davidwalsh.name/function-debounce
     */
    utilities.debounce = function( func, wait, immediate ) {

        /*
            Declare a variable named `timeout` variable that we will later use
            to store the *timeout ID returned by the `setTimeout` function.

            *When setTimeout is called, it retuns a numeric ID. This unique ID
            can be used in conjunction with JavaScript's `clearTimeout` method
            to prevent the code passed in the first argument of the `setTimout`
            function from being called. Note, this prevention will only occur
            if `clearTimeout` is called before the specified number of
            milliseconds passed in the second argument of setTimeout have been
            met.
        */
        var timeout;

        /*
            Return an anomymous function that has access to the `func`
            argument of our `debounce` method through the process of closure.
        */
        return function() {

            /*
                1) Assign `this` to a variable named `context` so that the
                   `func` argument passed to our `debounce` method can be
                   called in the proper context.

                2) Assign all *arugments passed in the `func` argument of our
                   `debounce` method to a variable named `args`.

                *JavaScript natively makes all arguments passed to a function
                accessible inside of the function in an array-like variable
                named `arguments`. Assinging `arguments` to `args` combines
                all arguments passed in the `func` argument of our `debounce`
                method in a single variable.
            */
            var context = this,   /* 1 */
                args = arguments; /* 2 */

            /*
                Assign an anonymous function to a variable named `later`.
                This function will be passed in the first argument of the
                `setTimeout` function below.
            */
            var later = function() {

                /*
                    When the `later` function is called, remove the numeric ID
                    that was assigned to it by the `setTimeout` function.

                    Note, by the time the `later` function is called, the
                    `setTimeout` function will have returned a numeric ID to
                    the `timeout` variable. That numeric ID is removed by
                    assiging `null` to `timeout`.
                */
                timeout = null;

                /*
                    If the boolean value passed in the `immediate` argument
                    of our `debounce` method is falsy, then invoke the
                    function passed in the `func` argument of our `debouce`
                    method using JavaScript's *`apply` method.

                    *The `apply` method allows you to call a function in an
                    explicit context. The first argument defines what `this`
                    should be. The second argument is passed as an array
                    containing all the arguments that should be passed to
                    `func` when it is called. Previously, we assigned `this`
                    to the `context` variable, and we assigned all arguments
                    passed in `func` to the `args` variable.
                */
                if ( !immediate ) {
                    func.apply( context, args );
                }
            };

            /*
                If the value passed in the `immediate` argument of our
                `debounce` method is truthy and the value assigned to `timeout`
                is falsy, then assign `true` to the `callNow` variable.
                Otherwise, assign `false` to the `callNow` variable.
            */
            var callNow = immediate && !timeout;

            /*
                As long as the event that our `debounce` method is bound to is
                still firing within the `wait` period, remove the numerical ID
                (returned to the `timeout` vaiable by `setTimeout`) from
                JavaScript's execution queue. This prevents the function passed
                in the `setTimeout` function from being invoked.

                Remember, the `debounce` method is intended for use on events
                that rapidly fire, ie: a window resize or scroll. The *first*
                time the event fires, the `timeout` variable has been declared,
                but no value has been assigned to it - it is `undefined`.
                Therefore, nothing is removed from JavaScript's execution queue
                because nothing has been placed in the queue - there is nothing
                to clear.

                Below, the `timeout` variable is assigned the numerical ID
                returned by the `setTimeout` function. So long as *subsequent*
                events are fired before the `wait` is met, `timeout` will be
                cleared, resulting in the function passed in the `setTimeout`
                function being removed from the execution queue. As soon as the
                `wait` is met, the function passed in the `setTimeout` function
                will execute.
            */
            clearTimeout( timeout );

            /*
                Assign a `setTimout` function to the `timeout` variable we
                previously declared. Pass the function assigned to the `later`
                variable to the `setTimeout` function, along with the numerical
                value assigned to the `wait` argument in our `debounce` method.
                If no value is passed to the `wait` argument in our `debounce`
                method, pass a value of 200 milliseconds to the `setTimeout`
                function.
            */
            timeout = setTimeout( later, wait || 200 );

            /*
                Typically, you want the function passed in the `func` argument
                of our `debounce` method to execute once *after* the `wait`
                period has been met for the event that our `debounce` method is
                bound to (the trailing side). However, if you want the function
                to execute once *before* the event has finished (on the leading
                side), you can pass `true` in the `immediate` argument of our
                `debounce` method.

                If `true` is passed in the `immediate` argument of our
                `debounce` method, the value assigned to the `callNow` variable
                declared above will be `true` only after the *first* time the
                event that our `debounce` method is bound to has fired.

                After the first time the event is fired, the `timeout` variable
                will contain a falsey value. Therfore, the result of the
                expression that gets assigned to the `callNow` variable is
                `true` and the function passed in the `func` argument of our
                `debounce` method is exected in the line of code below.

                Every subsequent time the event that our `debounce` method is
                bound to fires within the `wait` period, the `timeout` variable
                holds the numerical ID returned from the `setTimout` function
                assigned to it when the previous event was fired, and the
                `debounce` method was executed.

                This means that for all subsequent events within the `wait`
                period, the `timeout` variable holds a truthy value, and the
                result of the expression that gets assigned to the `callNow`
                variable is `false`. Therefore, the function passed in the
                `func` argument of our `debounce` method will not be executed.

                Lastly, when the `wait` period is met and the `later` function
                that is passed in the `setTimeout` function executes, the
                result is that it just assigns `null` to the `timeout`
                variable. The `func` argument passed in our `debounce` method
                will not be executed because the `if` condition inside the
                `later` function fails.
            */
            if ( callNow ) {
                func.apply( context, args );
            }
        };
    };

    /**
     * Sets the loading text for the specified button or restores its original
     * text (depending if on === true)
     * @param  {HTMLElement} element [description]
     * @param  {boolean} on      [description]
     * @return {boolean}         [description]
     */
    utilities.btnLoading = function( element, on ) {

        // empty case: button does not exist
        if ( element === null || utilities.isNullOrEmptySpace( element.tagName ) ) {
            return false;
        }

        // set the original text by default
        // if on === true, set the loading text
        var loadingText = element.hasAttribute( 'data-loading-text' ) === true ?
        element.getAttribute( 'data-loading-text' ) :
        'Working...';

        var originalText = element.hasAttribute( 'data-original-text' ) === true ?
        element.getAttribute( 'data-original-text' ) :
        'Submit';

        // set the text for the button and enable it
        element.textContent = originalText;
        element.disabled = false;

        if ( on !== true ) {
            return true;
        }

        // add the spinning icon from Font Awesome 4.7.0
        element.innerHTML = '<i class="fa fa-refresh fa-spin fa-fw"></i>';

        // add the button text to indicate what's happening
        element.innerHTML += loadingText;

        // disable the button while it is loading
        element.disabled = true;

        return true;
    };

    /**
       * Returns true if the response from an AXIOS request is not null and
       * the response.data object is not null or undefined.
       * @param  {object}    response [description]
       * @return {boolean}          [description]
       */
      utilities.validAxiosResponse = function( response ) {
          return utilities.isNullOrEmptySpace( response ) === false &&
          utilities.isNullOrEmptySpace( response.data ) === false;
      };

    // confirms whether the user is sure if they want to complete the given action
    } )( window.utilities = window.utilities || {},
      window.jQuery,
      window,
      document,
      window.axios
    );

    // Down here is the code the defines the parameters used at the top of this
    // self-executing function. undefined is not defined so it is undefined. LOL
